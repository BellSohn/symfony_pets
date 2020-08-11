<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\OwnerType;
use App\Entity\Owner;

class OwnerController extends AbstractController
{
    
    public function index()
    {
        return $this->render('owner/index.html.twig', [
            'controller_name' => 'OwnerController',
        ]);
    }



    public function registerOwner(Request $request){

	    	$owner = new Owner();
	    	$form = $this->createForm(OwnerType::class,$owner);

	    	$form->handleRequest($request);

	    	if($form->isSubmitted() && $form->isValid()){

	    			$owner->setCreatedAt(new \DateTime('now'));

	    			$em = $this->getDoctrine()->getManager();
	    			$em->persist($owner);
	    			$em->flush();

	    		return $this->redirectToRoute('tier');	
	    	}



	    	return $this->render('owner/registerOwner.html.twig',[
	    		'controller_name' => 'OwnerController',
	    		'form' => $form->createView(),
	    	]);
    }

}
