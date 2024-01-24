<?php

namespace App\Service;

use App\Entity\Article;
use App\Entity\SourceTexts;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\FileUploader;

class ArticleService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var FileUploader
     */
    private $articleFileUploader;

    /**
     * @param EntityManagerInterface $em
     * @param FileUploader $articleFileUploader
     */
    public function __construct(EntityManagerInterface $em, FileUploader $articleFileUploader)
    {
        $this->em = $em;
        $this->articleFileUploader = $articleFileUploader;
    }

    /**
     * @param Article $article
     * @param $image
     * @param $plural
     * @param $genitive
     * @param $keywords
     * @param $sizeFrom
     * @param $sizeTo
     * @param $theme
     * @param $user
     * @return void
     */
    public function create(Article $article, $image, $plural, $genitive, $keywords, $sizeFrom, $sizeTo, $theme, $user): void
    {
        $body = $this->generate_text($plural, $genitive, $keywords, $sizeFrom, $sizeTo, $theme);

        $article
            ->setDescription('Статья о ' . $keywords)
            ->setBody($body)
            ->setAuthor($user)
            ->setPublishedAt(new \DateTime())
            ->setImageFilename($this->articleFileUploader->uploadFile($image, $article->getImageFilename()));

        $this->em->persist($article);
        $this->em->flush();
    }

    /**
     * @param $plural
     * @param $genitive
     * @param $keywords
     * @param $sizeFrom
     * @param $sizeTo
     * @param $theme
     * @return string
     */
    function generate_text($plural, $genitive, $keywords, $sizeFrom, $sizeTo, $theme): string
    {
        $repository = $this->em->getRepository(SourceTexts::class);

        $intro_phrases = $repository->findBy(['type' => 'intro_phrases']);
        $conclusion_phrases = $repository->findBy(['type' => 'conclusion_phrases']);
        $sentences = $repository->findBy(['type' => 'sentences']);
        $transitions = $repository->findBy(['type' => 'transitions']);
        $topics = $repository->findBy(['type' => 'topics']);
        $paragraphs = $repository->findBy(['type' => 'paragraphs']);

        function random_int($min, $max)
        {
            return mt_rand($min, $max);
        }

        function random_element($array)
        {
            return $array[array_rand($array)]->getData();
        }

        function replace($plural, $genitive, $data)
        {
            $data = str_replace('$plural', $plural, $data);
            $data = str_replace('$genitive', $genitive, $data);
            return $data;
        }

        function generate_paragraph($topic, $keyword, $genitive, $plural, $sentences)
        {
            $text = "";

            $sentences_count = random_int(3, 5);

            for ($i = 0; $i < $sentences_count; $i++) {
                $sentence = random_element($sentences);
                $sentence = str_replace('$plural', $plural, $sentence);
                $sentence = str_replace('$genitive', $genitive, $sentence);
                $text .= $sentence . " ";
                unset($sentences[array_search($sentence, $sentences)]);
            }

            return $text;
        }

        $paragraphs_count = random_int($sizeFrom, $sizeTo);

        for ($j = 0; $j < $paragraphs_count; $j++) {
            if ($j == 0) {
                $paragraph = random_element($intro_phrases) . " ";
            } elseif ($j == $paragraphs_count - 1) {
                $paragraph = random_element($conclusion_phrases) . " ";
            } else {
                $paragraph = random_element($transitions) . " ";
            }

            $topic = random_element($topics);

            $paragraph .= generate_paragraph($topic, $keywords, $genitive, $plural, $sentences);

            array_push($paragraphs, $paragraph);

            unset($topics[array_search($topic, $topics)]);
        }

        $text = implode("\n\n", $paragraphs);
        $text = replace($plural, $genitive, $text);

        return $text;
    }
}