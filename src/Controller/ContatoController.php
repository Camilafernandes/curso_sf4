<?php

namespace App\Controller;

use App\Entity\Contato;
use App\Form\ContatoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContatoController extends AbstractController
{
    /**
     * @Route("/contato", name="contato")
     */
    public function index(Request $request)
    {
        $contato = new  Contato();

        $form = $this->createForm(ContatoType::class, $contato);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){

            $em =  $this->getDoctrine()->getManager();
            $em->persist($contato);
            $em->flush();

            return $this->redirectToRoute('contato');
        }

        return $this->render('contato/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/contato/list", name="contato_list")
     */
    public function list()
    {
        $em = $this->getDoctrine()->getManager();

        $contatos = $em->getRepository(Contato::class)->findAll();

        return $this->render('contato/list.html.twig', [
            'contatos' => $contatos
        ]);
    }

    /**
     * @Route("contato/view/{id}", name="visualizar_contato")
     */
    public function view(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $contato = $em->getRepository(Contato::class)->find($id);

        return $this->render('contato/view.html.twig', [
            'contato' => $contato
        ]);
    }

    /**
     * @Route("contato/editar/{id}", name="editar_contato")
     */

     public function update(Request $request, $id)
     {
        $em = $this->getDoctrine()->getManager();

        $contato = $em->getRepository(Contato::class)->find($id);
        
        $form = $this->createForm(ContatoType::class, $contato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($contato);
            $em->flush();

            $this->addFlash('success', 'Contato alterado com sucesso!');
            return $this->redirectToRoute('contato_list');
        }

        return $this->render('contato/update.html.twig', [
            'form' => $form->createView(),
            'contato' => $contato
        ]);

     }

     /**
      * @Route("contato/delete/{id}", name="apagar_contato")
      */
    public function delete(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $contato = $em->getRepository(Contato::class)->find($id);

        if ($contato) {
            $em->remove($contato);
            $em->flush();

            $this->addFlash("success", "Contato removido com sucesso!");    
            return $this->redirectToRoute('contato_list');
        }

        $this->addFlash("error", "Contato não encontrado!");    
        return $this->redirectToRoute('contato_list');

    }
}
