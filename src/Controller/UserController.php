<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class UserController extends AbstractController
{
   
    public function register(Request $request,UserPasswordEncoderInterface $encoder)
    {
    	$user = new User();
    	$form = $this->createForm(RegisterType::class,$user);

    	//fill the object
    	$form->handleRequest($request);

    	//receive data from form
    	if($form->isSubmitted() && $form->isValid()){    		
    		
    		$user->setCreatedAt(new \DateTime('now'));

    		//encode the password
    	$encoded = $encoder->encodePassword($user,$user->getPassword());
    	$user->setPassword($encoded);

    		//store the new User
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($user);
    		$em->flush();

    		return $this->redirectToRoute('register');

    	}

        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }


    	public function login(AuthenticationUtils $AuthenticationUtils){

                    $error = $AuthenticationUtils->getLastAuthenticationError();

                    $lastUserName = $AuthenticationUtils->getLastUserName();



            return $this->render('user/login.html.twig',array(
                    "error" => $error,
                    'last_username'=> $lastUserName,
            ));
    		
    	}


}
