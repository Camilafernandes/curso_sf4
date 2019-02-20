<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoggerController extends AbstractController
{
    /**
     * @Route("/logger", name="logger")
     */
    public function index(LoggerInterface $logger)
    {
        $logger->info('Sou um erro info');
        $logger->error('sou um erro');
        $logger->critical('Sou um erro critico', [
            'motivo' => 'Ocorrreu um erro'
        ]);

        return new Response('logger');
    }

    /**
     * @Route("/asset", name="logger")
     */
    public function asset(LoggerInterface $logger)
    {
        return $this->render('logger/index.html.twig', [
            'controller_name' => 'Assets'
        ]);
    }
}
