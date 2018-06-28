<?php

declare(strict_types=1);

namespace TruckBundle\Form\AccidentCase;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use TruckBundle\Entity\AccidentCase;

class AccidentCaseEditEndType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reportLate', NumberType::class, [
                'label' => 'Service car late: '
            ])
            ->add('reportRsTime', NumberType::class, [
                'label' => 'Road service time: '
            ])
            ->add('reportNrsTime', NumberType::class, [
                'label' => 'No road service time: '
            ])
            ->add('reportRepairTotal', NumberType::class, [
                'label' => 'Repair total time: '
            ])
            ->add('reportArrivalTime', NumberType::class, [
                'label' => 'Arrival time: '
            ])
            ->add('reportCaseTotal', NumberType::class, [
                'label' => 'Case total time: '
            ])
            ->add('reportRepairStatus', ChoiceType::class, [
                'choices' => [
                    'completed' => AccidentCase::$reportRepairStatusCompleted,
                    'incompleted' => AccidentCase::$reportRepairStatusIncompleted,
                    'canceled' => AccidentCase::$reportRepairStatusCanceled
                ],
                'choices_as_values' => true,
                'label' => 'Repair status: '
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => 'TruckBundle\Entity\AccidentCase'
        ]);
    }
}
