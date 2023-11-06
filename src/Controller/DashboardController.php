<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use App\Service\ArticlesCreatorProvider;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/dashboard/article_detail/{slug}", name="app_dashboard_article_detail")
     */
    public function article_detail(Article $article): Response
    {
        return $this->render('dashboard/dashboard_article_detail.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/dashboard/create_article", name="app_dashboard_create_article")
     */
    public function create_article(ArticlesCreatorProvider $articlesCreatorProvider, Request $request): Response
    {
        $form = $this->createForm(ArticleFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $article
                ->setDescription('Краткое описание статьи')
                ->setBody('Краткое описание статьи')
                ->setAuthor($this->getUser())
                ->setPublishedAt(new \DateTime())
                ->setImageFilename('test.jpg');

            $articlesCreatorProvider->create($article);

            $this->addFlash('flash_message', 'Статья успешно создана');
        }

        return $this->render('dashboard/dashboard_create_article.html.twig', [
            'articleForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/dashboard/history", name="app_dashboard_history")
     */
    public function history(ArticleRepository $articleRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $articleRepository->latest(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('dashboard/dashboard_history.html.twig', [
            'pagination' => $pagination,
        ]);
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