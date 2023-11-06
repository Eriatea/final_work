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
     * @param Article $article
     * @return void
     */
    public function create(Article $article): void
    {
        $this->em->persist($article);
        $this->em->flush();
    }
}