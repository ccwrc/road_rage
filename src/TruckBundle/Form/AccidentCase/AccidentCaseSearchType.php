<?php

declare(strict_types=1);

namespace TruckBundle\Form\AccidentCase;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccidentCaseSearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('caseId', NumberType::class, [
                'label' => 'by case number: ',
                'required' => false
            ])
            ->add('companyName', TextType::class, [
                'label' => 'or company name: ',
                'required' => false
            ])
            ->add('damageDescription', TextType::class, [
                'label' => 'or damage description: ',
                'required' => false
            ])
            ->add('truckLocation', TextType::class, [
                'label' => 'or truck location: ',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array(
            'data_class' => 'TruckBundle\Presenter\AccidentCaseSearchPresenter'
        ));
    }
}
