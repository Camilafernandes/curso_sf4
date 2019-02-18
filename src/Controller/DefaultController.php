<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}