<?php

namespace App\Controller;
use App\Entity\Autor;
use App\Entity\Award;
use App\Repository\AutorRepository;
use App\Repository\AwardRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UserController extends AbstractController
{
    /**
     * permet de chauper le profil d'un utilisateur
     * @Route("/user/{id}", name="user_profile")
     * 
     */
    public function userprofile($id, AutorRepository $ripo)
    {
        $id = $ripo->findOneById($id);
         return $this->render('user/userprofile.html.twig', [
        'autor' => $id
         ]);
  
    }

    /**
     * permet d'afficher le profile de l'utilisateur connecter
     * @Route("/mytest", name="my_count")
     * @return reponse
     */
    public function mycount()
    {
        return $this->render('test.html.twig', );
    }
    



     
}
