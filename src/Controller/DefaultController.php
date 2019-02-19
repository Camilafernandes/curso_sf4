<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DefaultController extends Controller
{
    const NOME = "Curso SF4";

    public function index()
    {
        return $this->render('index.html');
    }

    public function aula1()
    {
        $mensagem = "Olá mundo"; 
        $array = ['1','2', '3'];
     
        return $this->render('aula1_twig.html.twig', [
            'message' => $mensagem,
            'array'=> $array
        ]);
    }
    public function blockExtends()
    {
         return $this->render( 'aula1_block_extends.html.twig');
    }
    
    public function pegarSession(SessionInterface $session){

        //$session->remove('frase');
        $mensagem = $session->get('frase', 'Não possui sessao');

        //$this->get('session')->getFlashBag()->set('error', 'Sou um erro!!');
        //echo $mensagem;
        //die();
       return $this->render( 'session/index.html.twig', [
            'controller_name' => 'Deafult'
        ]);

    }
}