<?php

namespace App\Controller;

use App\Service\Mensagem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ServiceController extends Controller
{
    /**
     * @Route("/service", name="service")
     */
    public function index (SessionInterface $session)
    {
        $session->get('servico', 'Mensagen');
        $mensagem = $this->get('mensagem');

        echo $mensagem->escreverMensagem($session);
        
        exit();
    }

    /**
     * @Route("mail", name="mail")
     */
    public function enviarEmail(
        \Swift_Mailer $mailer, 
        SessionInterface $session
    )
    {
        $session->set('frase', 'Olá eu sou uma sessão');
        $session->set('nome', 'Camila');
        
        $nome = $session->get('nome');

        $message = $this->get('mensagem');
        $texto = $message->escreverMensagem($nome); 
        
        $mensagem = (new \Swift_Message('Primeiro e-mail'))
            ->setFrom('example@gmail.com')
            ->setTo(['camilafernandesdev@gmail.com' => 'Camila'])
            ->setBody(
                $this->renderView('service/index.html.twig', [
                    'controller_name' => 'ServiceController',
                    'mensagem' => $texto
                ]), 
                "text/html"
            )
        ;
        $mensagem->attach(\Swift_Attachment::fromPath('symfony.png'));

        try{
            $mailer->send($mensagem);
            
        } catch(\ErrorException $e){
            return new Response($e);
        }
        
        return new Response('Enviado');
        

    }

}
