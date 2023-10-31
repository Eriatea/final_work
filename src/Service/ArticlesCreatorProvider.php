<?php

namespace App\Service;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class ArticlesCreatorProvider
{
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param ArticleContentProvider $articleContentProvider
     * @return Article
     */
    public function create(ArticleContentProvider $articleContentProvider): Article
    {
        $article = new Article();

        $article
            ->setTitle('Есть ли жизнь после девятой жизни?')
            ->setDescription('Краткое описание статьи')
            ->setBody($articleContentProvider->start())
            ->setTheme('ключ')
            ->setKeywords('ключ')
        ->setKeyword('ключи');

        $article
            ->setImageFilename('bg-showcase-1.jpg');

        $this->em->persist($article);
        $this->em->flush();

        return $article;
    }
}