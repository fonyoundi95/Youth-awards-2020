<?php

namespace App\Controller\Admin;

use App\Repository\AutorRepository;
use App\Repository\AwardRepository;
use App\Repository\CathegoriRepository;
use App\Repository\CommentRepository;
use App\Repository\MantorRepository;
use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="dashboard_admin")
     */
    public function index( AwardRepository $award, AutorRepository $autor, CommentRepository $comment,
    
    MantorRepository $mantor, CathegoriRepository $cathegori, RoleRepository $role): Response
    {

      $awards =  count( $award->findAll());
      $autors = count($autor->findAll());
      $comments = count($comment->findAll());
      $mantors = count($mantor->findAll());
      $cathegoris = count($cathegori->findAll());
      $roles = count($role->findAll());
       


        return $this->render('admin/dashboard/dashboard.html.twig',[
          'stats' => compact('awards', 'autors', 'comments', 'mantors', 'cathegoris', 'roles')
            
        ]);
    }
}
