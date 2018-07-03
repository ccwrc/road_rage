<?php

declare(strict_types=1);

namespace TruckBundle\Form\Monitoring;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{
    ChoiceType, NumberType, TextareaType, TextType
};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use TruckBundle\Entity\Monitoring;

class MonitoringCpgType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', NumberType::class, [
                'label' => 'Amount: '
            ])
            ->add('currency', ChoiceType::class, [
                'choices' => [
                    'PLN' => Monitoring::$currencyPln,
                    'USD' => Monitoring::$currencyUsd,
                    'EUR' => Monitoring::$currencyEur
                ],
                'choices_as_values' => true,
                'label' => 'Currency: '
            ])
            ->add('contactThrough', TextType::class, [
                'label' => 'Contact through: '
            ])
            ->add('comments', TextareaType::class, [
                'label' => 'Comments: '
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => 'TruckBundle\Entity\Monitoring'
        ]);
    }
}
