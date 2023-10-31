<?php

namespace App\Service;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;

class ArticleProvider
{
    private $articleRepository;
    private $em;

    /**
     * @param ArticleRepository $articleRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(ArticleRepository $articleRepository, EntityManagerInterface $em)
    {
        $this->articleRepository = $articleRepository;
        $this->em = $em;
    }

    /**
     * @return array
     */
    public function getLatestPublishedArticles(): array
    {
        return $this->articleRepository->findLatestPublished();
    }

    /**
     * @param Article $article
     * @return array
     */
    public function getArticleComments(Article $article): array
    {
        return [
            'Tabes ridetiss, tanquam noster pars.',
            'Nunquam contactus galatae.',
            'Sunt acipenseres anhelare audax, nobilis impositioes.'
        ];
    }
}