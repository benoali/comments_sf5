<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_default")
     */
    public function index(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_article');
        }

        return $this->render('default/index.html.twig', [
            'google_connect_link' => '/connect/google',
            'facebook_connect_link' => '/connect/facebook',
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(): Response
    {
        return $this->redirectToRoute('app_default');
    }
}
