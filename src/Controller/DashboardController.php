<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("IS_AUTHENTICATED_REMEMBERED")
 * @method User|null getUser()
 * @method Article|null
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function homepage(): Response
    {
        return $this->render('dashboard/dashboard.html.twig', []);
    }

    /**
     * @Route("/dashboard/article_detail", name="app_dashboard_article_detail")
     */
    public function article_detail(): Response
    {
        return $this->render('dashboard/dashboard_article_detail.html.twig', []);
    }

    /**
     * @Route("/dashboard/create_article", name="app_dashboard_create_article")
     */
    public function create_article(): Response
    {
        return $this->render('dashboard/dashboard_create_article.html.twig', []);
    }

    /**
     * @Route("/dashboard/history", name="app_dashboard_history")
     */
    public function history(): Response
    {
        return $this->render('dashboard/dashboard_history.html.twig', []);
    }

    /**
     * @Route("/dashboard/modules", name="app_dashboard_modules")
     */
    public function modules(): Response
    {
        return $this->render('dashboard/dashboard_modules.html.twig', []);
    }

    /**
     * @Route("/dashboard/profile", name="app_dashboard_profile")
     */
    public function profile(): Response
    {
        return $this->render('dashboard/dashboard_profile.html.twig', []);
    }

    /**
     * @Route("/dashboard/subscription", name="app_dashboard_subscription")
     */
    public function subscription(): Response
    {
        return $this->render('dashboard/dashboard_subscription.html.twig', []);
    }
}