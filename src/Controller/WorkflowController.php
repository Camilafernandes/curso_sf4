<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Workflow\Exception\ExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WorkflowController extends AbstractController
{
    /**
     * @Route("/workflow", name="workflow")
     */
    public function index()
    {
        return $this->render('workflow/index.html.twig', [
            'posts' => $this->getDoctrine()->getManager()
                ->getRepository('App:Post')->findAll(),
        ]);
    }

    /**
     * @Route("create", methods={"POST"}, name="post_create")
     */
    public function create(Request $request)
    {
        $post = new Post();
        $post->setTitulo($request->request->get('titulo'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return $this->redirect(
            $this->generateUrl('post_show', ['id' => $post->getId()])
        );
    }

    /**
     * @Route("/show/{id}", name="post_show")
     */
    public function show(Post $post)
    {
        return $this->render('workflow/show.html.twig',[
            'post' => $post
        ]);
    }

    /**
     * @Route("apply-transaction/{id}", name="post_apply_transition")
     */
    public function applyTransaction(
        Request $request, 
        Post $post, 
        Registry $workflows
    )
    {
        try{
            
            $work = $workflows->get($post);
            $work->apply($post, $request->request->get('transition'));
    
            $this->getDoctrine()->getManager()->flush();

        } catch( ExceptionInterface $e) {
            $this->get('session')->getFlashBag()
            ->add('danger', $e->getMessage());
        }

        return $this->redirect(
            $this->generateUrl('post_show', ['id' => $post->getId()])
        );
        
    }


    /**
     * @Route("reset-workflow/{id}", methods={"POST"}, name="post_reset_workflow")
     */
    public function resetMarkingAction(Post $post)
    {   

        $post->setMarking(null);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirect(
            $this->generateUrl('post_show', ['id' => $post->getId()])
        );
        
    }
}
