<?php

declare(strict_types=1);

namespace TruckBundle\Form\AccidentCase;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccidentCaseType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('damageDescription', TextareaType::class, [
                'label' => 'Damage/fault description: '
            ])
            ->add('location', TextareaType::class, [
                'label' => 'Truck location: '
            ])
            ->add('driverContact', TextType::class, [
                'label' => 'Driver/dispatcher name & phone: '
            ])
            ->add('infoSms', TextType::class, [
                'label' => 'SMS info (optional - phone): ',
                'required' => false
            ])
            ->add('infoMail', TextType::class, [
                'label' => 'Mail info (optional - mail): ',
                'required' => false
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Other comments: '
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => 'TruckBundle\Entity\AccidentCase'
        ]);
    }
}
