<?php

namespace App\Controller;

use App\Entity\Aluno;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class FosApiController extends FOSRestController
{
    /**
     *@Rest\Get("/alunos", name="get_alunos") 
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $alunos = $em->getRepository(Aluno::class)->findAll();

        return $this->json(['data' => $alunos]);
    }

    /**
     *@Rest\Get("/alunos/{id}", name="get_aluno") 
     */
    public function getAlunosId($id)
    {
        $em = $this->getDoctrine()->getManager();

        $alunos = $em->getRepository(Aluno::class)->find($id);

        return $this->json(['data' => $alunos]);
    }

    /**
     * @Rest\Post("/alunos/create", name="create_alunos") 
     * @param Request $request
     */
    public function create(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $alunos = new Aluno($request);
        $alunos->setNome($request->get('nome'));
        $alunos->setEmail($request->get('email'));

        $em->persist($alunos);
        $em->flush();

        return $this->json(['data' => $alunos]);
    }
}
