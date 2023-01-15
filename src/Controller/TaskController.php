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

        //here we show all areas
        $task_repo = $this->getDoctrine()->getRepository(Task::class);
        $allTask = $task_repo->findAll();           

    	
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

                   /*if we pass the edit as true,we are in edition modus*/
                   return $this->render('task/registerTask.html.twig',[
                        'edit' => true,
                        'form' => $form->createView()
                   ]);   


            }



}
