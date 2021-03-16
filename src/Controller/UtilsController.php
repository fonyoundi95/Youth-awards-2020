<?php

namespace App\Controller;

use App\Entity\Award;
use App\Entity\Mantor;
use App\Entity\Comment;
use App\Form\ComentaireType;
use App\Repository\AwardRepository;
use App\Repository\MantorRepository;
use App\Repository\CathegoriRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class UtilsController extends AbstractController
{
    /**
     * @Route("/mantorindex", name="mantor_all")
     */
    public function indexmantors(MantorRepository $mantorRepository): Response
    {
        $mantors = $mantorRepository->findAll();
        return $this->render('frontend/mantors.html.twig', [
            'mantors' =>  $mantors
        ]);
    }

    /**
     * @Route("/cathegorieindex", name="cathegorie_all")
     */
    public function indcathegorie(CathegoriRepository $CathegoriesRepository): Response
    {
        $cathegories = $CathegoriesRepository->findAll();
        return $this->render('frontend/cathegory.html.twig', [
            'Cathegories' => $cathegories
        ]);
    }
  

    /**
     * @Route("/", name="awards")
     * 
     */
    public function index(): Response
    {
        $ripo = $this->getDoctrine()->getRepository(Award::class);
        $awards = $ripo->findAll();
         $ripo= $this->getDoctrine()->getRepository(Mantor::class);
         $mantors = $ripo->findAll();
        return $this->render('frontend/index.html.twig', [
            'awards' => $awards,
            'mantors' => $mantors
        ]);
    }


    /**
     * @Route("/awardsfrontend", name="awards_frontend")
     * 
     */
    public function indexAwards( )
   {
        $ripo = $this->getDoctrine()->getRepository(Award::class);
        $awards = $ripo->findAll();
      return $this->render('frontend/awards.html.twig',
    [
        'awards'=> $awards
    ]);
    }


    /**
     * @Route("/voirwaward/{id}", name="voir_award", methods={"GET"})
     */
    public function voirAward($id, AwardRepository $ripo)
    {
        $award = $ripo->findOneById($id);
   
        return $this->render('frontend/showAwards.html.twig', [
            'award' => $award
        ]);
    }

    /**
     * @Route("/showmantor/{id}", name="voir_mantor", methods={"GET"})
     */
    public function voirMantor($id, MantorRepository $ripo)
    { 
        $mantor = $ripo->findOneById($id);
        return $this->render('frontend/showMantors.html.twig', [
            'mantor' => $mantor
        ]);
    }

    /**
     * @Route("/showcathegorie/{id}", name="voir_cathegorie", methods={"GET"})
     */
    public function showCathegorie($id, CathegoriRepository $ripo)
    {
        $cathegorie = $ripo->findOneById($id);
        return $this->render('frontend/show_cathegorie.html.twig', [
            'cathegorie' => $cathegorie
        ]);
    }


    /**
     * permet de d'enregidtrer les commentaires des utilisateurs
     * @Route("/newcomment/{id}", name="laisser_comment")
     */
    public function newcomment( Award $award, Request $request):Response
    {
        $comment = new Comment();
        $form = $this->createForm(ComentaireType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
             $comment->setAwards($award);
             $comment->setAutors($this->getUser());
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($comment);
             $entityManager->flush();
             $this->addFlash(
                'success',
                'Votre vote a ete bien prit en compte!'
            );
            return  $this->redirectToRoute('voir_award', ['id', $award->getId()]);
    
         }

        return $this->render('frontend/showAwards.html.twig', [
        'form' => $form->createView(),
        'award'=> $award
        ]);
    }


    /**
     * @Route("/contact", name="contact_us")
     */
    public function contactUs()
    {
       return $this->render('frontend/contact-us.html.twig');
    }
    /**
     * 
     * @Route("/about", name="about_us")
     */
    public function aboutUs()
    {
        return $this->render('frontend/about-us.html.twig');
    }

    
}
