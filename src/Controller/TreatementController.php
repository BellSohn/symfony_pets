<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Treatement;
use App\Entity\Animal;

use App\Form\TreatementType;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Animal\AnimalInterface;

class TreatementController extends AbstractController
{
    
    public function index()
    {

    	//Treatements output
    		$treatement_repo = $this->getDoctrine()->getRepository(Treatement::class);
    		$treatments = $treatement_repo->findAll();



        return $this->render('treatement/index.html.twig', [
            'controller_name' => 'TreatementController',
            'treatments' => $treatments,
        ]);
    }



    public function registerTreatement(Request $request,UserInterface $user, Animal $animal){
    	
            $newTreat = new Treatement();
            $form = $this->createForm(TreatementType::class,$newTreat);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){

                 $newTreat->setCreatedAt(new \DateTime('now'));
                 $newTreat->setUser($user);

                 $newTreat->setAnimal($animal);

                 $em = $this->getDoctrine()->getManager();
                 $em->persist($newTreat);
                 $em->flush();

                 return $this->redirectToRoute('treatement');   
            }



            return $this->render('treatement/registerTreatement.html.twig',[
                    'form' => $form->createView(),
            ]);
           



    }


}
