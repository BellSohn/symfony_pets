<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


use App\Entity\Task;
use App\Entity\User;
use App\Entity\Treatement;
use App\Entity\Owner;
use App\Entity\Animal;

use App\Form\TaskType;

use Symfony\Component\Security\Core\User\UserInterface;


class TaskController extends AbstractController
{
    
    public function index()
    {

        //aqui mostramos todas las tareas
        $task_repo = $this->getDoctrine()->getRepository(Task::class);

        $allTask = $task_repo->findAll();



        
        /*
    	$em = $this->getDoctrine()->getManager();

    	$task_repo = $this->getDoctrine()->getRepository(Task::class);

    	$allTask = $task_repo->findAll();

    	foreach($allTask as $task){
    		echo $task->getTitle()."  |  Usuario email :".$task->getUser()->getEmail()."|   Nombre:".$task->getUser()->getName()."<br/>";
            
    	}

        
        $user_repo = $this->getDoctrine()->getRepository(User::class);
        $all_users = $user_repo->findAll();

        foreach($all_users as $user){
          echo "Nombre de usuario : ".$user->getName()."   ||  apellidos : ".$user->getSurname()."<br/>";

          foreach($user->getTasks() as $task){
            echo "titulo tarea : ".$task->getTitle()." ||    ".$task->getContent()."<br/>";
          }

          foreach($user->getTreatements() as $treatement){
                echo "titulo del tratamiento: ".$treatement->getTitle()."<br/>";
          }

        }


       
        $treatement_repo = $this->getDoctrine()->getRepository(Treatement::class);
        $all_treatements = $treatement_repo->findAll();

        foreach($all_treatements as $treatement){
            echo "<strong>Tratamiento id:</strong> ".$treatement->getId()." || ".$treatement->getAnimal()->getName()."<br>";
            
        }
        echo "<hr/>";
       
        $owners_repo = $this->getdoctrine()->getRepository(Owner::class);
        $all_owners = $owners_repo->findAll();
        foreach($all_owners as $owner){
            echo "nombre usuario :".$owner->getName()." || ".$owner->getSurname()."<br/>";

            foreach($owner->getAnimals() as $animal){
                echo "<strong>animal name</strong>: ".$animal->getName()."  | ".$animal->getType()."<br/>";
            }
        }

       
        $animals_repo = $this->getDoctrine()->getRepository(Animal::class);
        $all_animals = $animals_repo->findAll();
        foreach($all_animals as $animal){
          echo "animal nombre : ".$animal->getName(). "  |  duenio: ".$animal->getOwner()->getName()."<br/>";
            
        }
        */
       

    	
        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
            'allTask' => $allTask,
        ]);
    }



            public function registerTask(Request $request,UserInterface $user){ 

               $task = new Task();
               $form = $this->createForm(TaskType::class,$task);

               $form->handleRequest($request);

               if($form->isSubmitted() && $form->isValid()){
                   $task->setCreatedAt(new \DateTime('now'));
                   $task->setUser($user);

                   $em = $this->getDoctrine()->getManager();
                   $em->persist($task);
                   $em->flush();

                   return $this->redirectToRoute('tasks');
               }



                return $this->render('task/registerTask.html.twig',[
                    //'controller_name' => 'TaskController',
                    'form'=>$form->createView(),

                ]);

            }


            public function detailTask(Task $task){

                    if(!$task){
                        $message = "task doesn´t exists";
                        return $this->redirectToRoute('tasks');

                    }else{


                        return $this->render('task/detailTask.html.twig',[
                                'task'=>$task
                        ]);
                    }



            }    


            //editar tarea para mofificarla

            public function editTask(Request $request,UserInterface $user, Task $task){

                    if(!$user || $user->getId() != $task->getUser()->getId()){

                        return $this->redirectToRoute('task');
                    }

                   $form = $this->createForm(TaskType::class,$task);
                   $form->handleRequest($request);

                   if($form->isSubmitted()  && $form->isValid()){

                        $task->setCreatedAt(new \DateTime('now'));
                        $task->setUser($user);

                        $em = $this->getDoctrine()->getManager();
                        $em->persist($task);
                        $em->flush();

                   return $this->redirect($this->generateUrl('task_detail',['id'=>$task->getId()]));




                   }  

                   /*si pasamos en el array el edit a true,estamos en 'edicion'*/
                   return $this->render('task/registerTask.html.twig',[
                        'edit' => true,
                        'form' => $form->createView()
                   ]);   


            }



}
