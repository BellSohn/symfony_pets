<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextAreaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TreatementType extends AbstractType{

	public function buildForm(FormBuilderInterface $builder,array $options){

			$builder->add('title',TextType::class,array(
				'label' => 'title'	
			))
			->add('begin',DateTimeType::class,array(
				'label' => 'Treatement begin'
			))
			->add('end',DateTimeType::class,array(
				'label' => 'Treatement end'
			))
			->add('comments',TextAreaType::class,array(
				'label' => 'relevant Comments'
			))

			->add('submit',SubmitType::class,array(
				'label' => 'create a new Treatement'
			));

	}

}