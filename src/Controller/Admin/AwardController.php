<?php

namespace App\Controller\Admin;

use App\Entity\Award;
use App\Form\AwardType;
use App\Repository\AwardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/award")
 */
class AwardController extends AbstractController
{
    /**
     * @Route("/{page<\d+>?1}", name="award_index", methods={"GET"})
     */
    public function index($page): Response
    {
         $limite = 5;
         $start = $page * $limite - $limite;
          
         $ripo = $this->getDoctrine()->getRepository(Award::class);
         $awards = $ripo->findBy([], [], $limite, $start);
         $totals = count( $ripo->findAll());
         $pages = ceil($totals/ $limite);
         return $this->render('admin/award/index.html.twig', [
         'awards'=> $awards,
         'pages'=> $pages,
         'page'=> $page
        ]);

    }

    /**
     * @Route("/new", name="award_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $award = new Award();
        $form = $this->createForm(AwardType::class, $award);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($award);
            $entityManager->flush();

            $this->addFlash(
                'success',
                " <strong> Votre Award a ete bien enregistre</strong>"
            );
            return $this->redirectToRoute('award_index');
        }

        return $this->render('admin/award/new.html.twig', [
            'award' => $award,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="award_show", methods={"GET"})
     */
    public function show(Award $award): Response
    {
        return $this->render('admin/award/show.html.twig', [
            'award' => $award,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="award_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Award $award): Response
    {
        $form = $this->createForm(AwardType::class, $award);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                " <strong> Votre Award a ete bien modifier</strong>"
            );

            return $this->redirectToRoute('award_index');
        }

        return $this->render('admin/award/edit.html.twig', [
            'award' => $award,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="award_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Award $award): Response
    {
        if ($this->isCsrfTokenValid('delete' . $award->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($award);
            $entityManager->flush();
            $this->addFlash(
                'success',
                " <strong> Votre Award a ete bien supprimer </strong>"
            );
        }

        return $this->redirectToRoute('award_index');
    }


    
}
