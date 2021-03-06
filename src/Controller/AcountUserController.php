<?php

namespace App\Controller;


use App\Entity\Autor;
use App\Form\AutorType;
use App\Form\ProfileType;
use App\Entity\Updatepassword;
use App\Form\PassewordUpdateType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AcountUserController extends AbstractController
{
    /**
     * permet de se connecter au systeme
     * @Route("/login", name="acount_login")
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();
        return $this->render('acount_user/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username

        ]);
    }


    /**
     * permet de se deconnecter au systeme
     * @Route("/logout", name="acount_logout")
     */
    public function logout()
    {
      
    }

    

    /**
     * permet de gerer le formulaire d'inscription
     * @Route("/registration" , name="acount_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $autor = new Autor;
        $form = $this->createForm(AutorType::class, $autor);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $haspassword = $encoder->encodePassword($autor, $autor->getPasseword());
            $autor->setPasseword($haspassword);
            $manager->persist($autor);
            $manager->flush();
            $this->addFlash(
                'success',
                "Votre compte a ete bien cree, bien vouloir vous connectez !"
            );

            return  $this->redirectToRoute('acount_login');
        }

        return $this->render('acount_user/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * permet de modifier le profile de l'utilisateur
     * @Route("/profile" , name="acount_rprofile")
     * @IsGranted("ROLE_USER")
     */
    public function profile(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $autor = $this->getUser();

        $form = $this->createForm(ProfileType::class, $autor);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $haspassword = $encoder->encodePassword($autor, $autor->getPasseword());
            $autor->setPasseword($haspassword);
            $manager->persist($autor);
            $manager->flush();
            $this->addFlash(
                'success',
                "Votre compte a ete bien modifier !"
            );

            return  $this->redirectToRoute('acount_login');
        }

        return $this->render('acount_user/profile.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * permet de modifier le password de l'utilisateur
     * @Route("/passwordupdate", name="password_update")
     * @IsGranted("ROLE_USER")
     * @return reponse 
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encodeur)
    {
        $updatepassword = new Updatepassword;

        $user = $this->getUser();

        $form = $this->createForm(PassewordUpdateType::class, $updatepassword);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!password_verify($updatepassword->getPasseword(), $user->getPasseword())) {
            $form->get('passeword')->addError(new FormError('Vous n\'avez pas tapez votre ancien mot de passe !'));
            } else {
                $passwordhas = $updatepassword->getNewPassword();
                $passwordhas = $encodeur->encodePassword($user, $passwordhas);
                $user->setPasseword($passwordhas);
                $manageer = $this->getDoctrine()->getManager();
                $manageer->persist($user);
                $manageer->flush();
                $this->addFlash(
                    'success',
                    'Votre Mot de passe a ete bien modifier !'
                );

               return $this->redirectToRoute('awards');
            }
        }

        return $this->render('acount_user/passwordupdate.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
