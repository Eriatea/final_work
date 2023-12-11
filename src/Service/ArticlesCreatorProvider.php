<?php

namespace App\Service;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\ArticleContentProvider;
use App\Service\FileUploader;

class ArticlesCreatorProvider
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var ArticleContentProvider
     */
    private $articleContent;
    /**
     * @var FileUploader
     */
    private $articleFileUploader;

    /**
     * @param EntityManagerInterface $em
     * @param ArticleContentProvider $articleContent
     * @param FileUploader $articleFileUploader
     */
    public function __construct(EntityManagerInterface $em, ArticleContentProvider $articleContent, FileUploader $articleFileUploader)
    {
        $this->em = $em;
        $this->ArticleContent = $articleContent;
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
        $body = $this->ArticleContent->generate_text($plural, $genitive, $keywords, $sizeFrom, $sizeTo, $theme);

        $article
            ->setDescription('Статья о ' . $keywords)
            ->setBody($body)
            ->setAuthor($user)
            ->setPublishedAt(new \DateTime())
            ->setImageFilename($this->articleFileUploader->uploadFile($image, $article->getImageFilename()));

        $this->em->persist($article);
        $this->em->flush();
    }
}