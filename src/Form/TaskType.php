<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TaskType extends AbstractType{


		public function buildForm(FormBuilderInterface $builder,array $options){

			$builder->add('title',TextType::class,array(
				'label' => 'title'
			))
			->add('content',TextType::class,array(
				'label'=>'Content'
			))
			->add('priority',TextType::class,array(
				'label'=>'Priority'
			))
			->add('date',DateTimeType::class,array(
				'label'=>'Begin Date'
			))
			->add('deadline',DateTimeType::class,array(
				'label' => 'Deadline'
			))
			->add('submit',SubmitType::class,array(
				'label' => 'create a new Task'
			));





		}



}