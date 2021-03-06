<?php

namespace App\Controller\Admin;

use App\Entity\Mantor;
use App\Form\MantorType;
use App\Repository\MantorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/mantor")
 */
class MantorController extends AbstractController
{
    /**
     * @Route("/", name="mantor_index", methods={"GET"})
     */
    public function index(MantorRepository $mantorRepository): Response
    {
        $mantors = $mantorRepository->findAll();
        return $this->render('admin/mantor/index.html.twig', [
            'mantors' =>  $mantors
        ]);
    }

    /**
     * @Route("/new", name="mantor_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mantor = new Mantor();
        $form = $this->createForm(MantorType::class, $mantor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mantor);
            $entityManager->flush();
            $this->addFlash(
                'success',
                " <strong> Votre Mantor a ete bien enregistre</strong>"
            );

            return $this->redirectToRoute('mantor_index');
        }

        return $this->render('admin/mantor/new.html.twig', [
            'mantor' => $mantor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mantor_show", methods={"GET"})
     */
    public function show(Mantor $mantor): Response
    {
        return $this->render('admin/mantor/show.html.twig', [
            'mantor' => $mantor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mantor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mantor $mantor): Response
    {
        $form = $this->createForm(MantorType::class, $mantor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                " <strong> Votre Mantor a ete bien modifier</strong>"
            );
            return $this->redirectToRoute('mantor_index');
        }

        return $this->render('admin/mantor/edit.html.twig', [
            'mantor' => $mantor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mantor_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Mantor $mantor): Response
    {
        if ($this->isCsrfTokenValid('delete' . $mantor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mantor);
            $entityManager->flush();
            $this->addFlash(
                'success',
                " <strong> Votre Mantor a ete bien supprimer </strong>"
            );
        }

        return $this->redirectToRoute('mantor_index');
    }
}
