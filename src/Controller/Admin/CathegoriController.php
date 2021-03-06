<?php

namespace App\Controller\Admin;

use App\Entity\Cathegori;
use App\Form\CathegoriType;
use App\Repository\CathegoriRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/cathegori")
 */
class CathegoriController extends AbstractController
{
    /**
     * @Route("/", name="cathegori_index", methods={"GET"})
     */
    public function index(CathegoriRepository $cathegoriRepository): Response
    {
        return $this->render('admin/cathegori/index.html.twig', [
            'cathegoris' => $cathegoriRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cathegori_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cathegori = new Cathegori();
        $form = $this->createForm(CathegoriType::class, $cathegori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cathegori);
            $entityManager->flush();
            $this->addFlash(
                'success',
                " <strong> Votre Cathegorie a ete bien Enregistre</strong>"
            );

            return $this->redirectToRoute('cathegori_index');
        }

        return $this->render('admin/cathegori/new.html.twig', [
            'cathegori' => $cathegori,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cathegori_show", methods={"GET"})
     */
    public function show(Cathegori $cathegori): Response
    {
        return $this->render('admin/cathegori/show.html.twig', [
            'cathegori' => $cathegori,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cathegori_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cathegori $cathegori): Response
    {
        $form = $this->createForm(CathegoriType::class, $cathegori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                " <strong> Votre Cathegorie a ete bien modifier</strong>"
            );

            return $this->redirectToRoute('cathegori_index');
        }

        return $this->render('admin/cathegori/edit.html.twig', [
            'cathegori' => $cathegori,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cathegori_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cathegori $cathegori): Response
    {
        if ($this->isCsrfTokenValid('delete' . $cathegori->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cathegori);
            $entityManager->flush();

            $this->addFlash(
                'success',
                " <strong> Votre Cathegorie a ete bien supprimer</strong>"
            );
        }

        return $this->redirectToRoute('cathegori_index');
    }

   
}
