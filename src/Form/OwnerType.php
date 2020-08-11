<?php 

namespace App\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class OwnerType extends AbstractType{


	public function buildForm(FormBuilderInterface $builder,array $options){

			$builder->add('name',TextType::class,array(
				'label' => 'Name'
			))

			->add('surname',TextType::class,array(
				'label' => 'Surname'
			))
			->add('telephone',TextType::class,array(
				'label'=> "Telephone"
			))
			->add('address',TextType::class,array(
				'label' => 'Address'
			))
			->add('email',TextType::class,array(
				'label' => 'Email'
			))

			->add('submit',SubmitType::class,array(
				'label' => 'New Pet Owner'
			));
	}
}


