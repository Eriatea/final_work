<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainPageController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(): Response
    {
        return $this->render('homepage/homepage.html.twig', []);
    }

    /**
     * @Route("/try", name="app_article_show")
     */
    public function try(): Response
    {
        return $this->render('homepage/try.html.twig', []);
    }
}