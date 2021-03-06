<?php

namespace App\Controller\Admin;

use App\Entity\Autor;
use App\Form\AutorType;
use App\Repository\AutorRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("admin/autor")
 * 
 */
class AutorController extends AbstractController
{
    /**
     * @Route("/", name="autor_index", methods={"GET"})
     */
    public function index(AutorRepository $autorRepository): Response
    {
        return $this->render('admin/autor/index.html.twig', [
            'autors' => $autorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="autor_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $autor = new Autor();
        $form = $this->createForm(AutorType::class, $autor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $has = $encoder->encodePassword($autor, $autor->getPasseword());
            $autor->setPasseword($has);
            $entityManager->persist($autor);
            $entityManager->flush();
            $this->addFlash(
                'success',
                " <strong> Votre auteur a ete bien enregistre</strong>"
            );
            return $this->redirectToRoute('autor_index');
        }

        return $this->render('admin/autor/new.html.twig', [
            'autor' => $autor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="autor_show", methods={"GET"})
     */
    public function show(Autor $autor): Response
    {
        return $this->render('admin/autor/show.html.twig', [
            'autor' => $autor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="autor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Autor $autor): Response
    {
        $form = $this->createForm(AutorType::class, $autor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                " <strong> Votre auteur a ete bien modifier</strong>"
            );
            return $this->redirectToRoute('autor_index');
        }

        return $this->render('admin/autor/edit.html.twig', [
            'autor' => $autor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="autor_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Autor $autor): Response
    {
        if ($this->isCsrfTokenValid('delete' . $autor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($autor);
            $entityManager->flush();
            $this->addFlash(
                'success',
                " <strong> Votre auteur a ete bien supprimer</strong>"
            );
        }

        return $this->redirectToRoute('autor_index');
    }


    


}
