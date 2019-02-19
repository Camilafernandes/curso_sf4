<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionController extends AbstractController
{
    /**
     * @Route("/session", name="session")
     */
    public function index(SessionInterface $session)
    {
        $session->set('frase', 'Olá eu sou uma session');

        exit();

    }
}
