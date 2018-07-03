<?php

declare(strict_types=1);

namespace TruckBundle\Form\Monitoring;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{
    DateTimeType, TextareaType, TextType
};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonitoringEndType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contactThrough', TextType::class, [
                'label' => 'Contact through: '
            ])
            ->add('comments', TextareaType::class, [
                'label' => 'Comments: '
            ])
            ->add('timeSet', DateTimeType::class, [
                'label' => 'End of repair: '
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => 'TruckBundle\Entity\Monitoring'
        ]);
    }
}
