<?php

namespace App\Controller;

use App\Entity\Award;
use App\Entity\Mantor;
use App\Form\PasswordType;
use App\Entity\Updatepassword;
use App\Repository\AwardRepository;
use App\Repository\MantorRepository;
use App\Repository\CathegoriRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UtilsController extends AbstractController
{
    /**
     * @Route("/mantorindex", name="mantor_all")
     */
    public function indexmantors(MantorRepository $mantorRepository): Response
    {
        $mantors = $mantorRepository->findAll();
        return $this->render('utils/indexmantor.html.twig', [
            'mantors' =>  $mantors
        ]);
    }

    /**
     * @Route("/cathegorieindex", name="cathegorie_all")
     */
    public function indcathegorie(CathegoriRepository $mantorRepository): Response
    {
        $cathegories = $mantorRepository->findAll();
        return $this->render('utils/index_cathegorie.html.twig', [
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
        return $this->render('utils/index.html.twig', [
            'awards' => $awards,
            'mantors' => $mantors
        ]);
    }


    /**
     * @Route("/", name="awards")
     * 
     */
  //  public function indexq()
   // {
        
  //      return $this->render('admin.html.twig');
  //  }









    /**
     * @Route("/voirwaward/{id}", name="voir_award", methods={"GET"})
     */
    public function voirAward($id, AwardRepository $ripo)
    {
        $award = $ripo->findOneById($id);
        return $this->render('utils/show_award.html.twig', [
            'award' => $award
        ]);
    }

    /**
     * @Route("/showmantor/{id}", name="voir_mantor", methods={"GET"})
     */
    public function voirMantor($id, MantorRepository $ripo)
    { 
        $mantor = $ripo->findOneById($id);
        return $this->render('utils/show_mantors.html.twig', [
            'mantor' => $mantor
        ]);
    }


    /**
     * @Route("/showcathegorie/{id}", name="voir_cathegorie", methods={"GET"})
     */
    public function showCathegorie($id, CathegoriRepository $ripo)
    {
        $cathegorie = $ripo->findOneById($id);
        return $this->render('utils/show_cathegorie.html.twig', [
            'cathegorie' => $cathegorie
        ]);
    }



    
}
