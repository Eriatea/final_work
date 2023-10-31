<?php

namespace App\Controller;

use App\Entity\Article;
use App\Service\ArticlesCreatorProvider;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\ArticleContentProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $articleCreator;

    /**
     * @param ArticlesCreatorProvider $articleCreator
     */
    public function __construct(ArticlesCreatorProvider $articleCreator)
    {
        $this->articleCreator = $articleCreator;
    }

    /**
     * @Route("/admin/articles/create", name="app_admin_articles_create")
     */
    public function create(ArticleContentProvider $articleContentProvider): Response
    {
        $article = $this->articleCreator->create($articleContentProvider);

        return new Response(sprintf('Создана статья id: %d',
            $article->getId()));
    }
}