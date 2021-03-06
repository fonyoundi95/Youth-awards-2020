<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminAcountController extends AbstractController
{
    /**
     * controller qui gere la connexion et deconnexion des administrateurs du systeme.
     * 
     * @Route("/admin/login", name="admin_account_login")
     */
    public function login(AuthenticationUtils $utils): Response
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();
      
        return $this->render('admin/admin_acount/login.html.twig',[

            'hasError' => $error !== null,
            'username' => $username
        ]);
    }
    
    /**
     * permet de se deconnecter au systeme
     * @Route("/admin/logout", name="admin_acount_logout")
     */
    public function logout()
    {
       
    }


}
