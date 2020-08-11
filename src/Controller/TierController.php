<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Animal;
use App\Entity\Owner;

class TierController extends AbstractController
{
    
    public function index()
    {

    		//all animals output
    	$animals_repo = $this->getDoctrine()->getRepository(Animal::class);
    	$allAnimals = $animals_repo->findAll();





        return $this->render('tier/index.html.twig', [
            'controller_name' => 'TierController',
            'allAnimals' => $allAnimals,
        ]);
    }


        public function ownerDetail($id){

            $owner_repo = $this->getDoctrine()->getRepository(Owner::class);

            $owner = $owner_repo->findOneBy(['id'=>$id]);
            if($owner){

                return $this->render('tier/ownerDetail.html.twig',[
                    'owner' => $owner
                ]);


            }else{

                return $this->redirectToRoute('tier');

            }


        }


}
