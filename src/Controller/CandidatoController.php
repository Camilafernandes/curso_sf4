<?php

namespace App\Controller;

use App\Entity\Candidato;
use App\Form\CandidatoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CandidatoController extends AbstractController
{
    /**
     * @Route("/candidato", name="candidato")
     */
    public function index(Request $request)
    {
        $candidato = new Candidato();

        $form = $this->createForm(CandidatoType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $files = $request->files->get('candidato')['foto'];
            $newName = md5($files->getClientOriginalName()) . uniqid() . time() . '.' . $files->guessExtension();
            $files->move(
                $this->getParameter('foto'), 
                $newName
            );

            $em = $this->getDoctrine()->getManager();
            $candidato->setFoto($newName);
            $em->persist($candidato);
            $em->flush();

            return $this->redirectToRoute('candidato');
        }

        return $this->render('candidato/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
