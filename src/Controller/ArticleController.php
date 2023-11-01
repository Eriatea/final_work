<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/admin/articles/create", name="admin_articles_create")
     */
    public function create(): Response
    {
        return new Response('Здесь будет страница создания статьи');
    }

}