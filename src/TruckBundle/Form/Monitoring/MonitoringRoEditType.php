<?php

declare(strict_types=1);

namespace TruckBundle\Form\Monitoring;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{
    NumberType, TextareaType, TextType
};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonitoringRoEditType extends AbstractType
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
            ->add('amount', NumberType::class, [
                'label' => 'Amount: ',
                'read_only' => true
            ])
            ->add('currency', TextType::class, [
                'label' => 'Currency: ',
                'read_only' => true
            ])
            ->add('outComment', TextareaType::class, [
                'label' => 'Comment for dealer (the document has already been sent): ',
                'read_only' => true
            ])
            ->add('optionalMails', TextareaType::class, [
                'label' => 'Optional mails to send the document: ',
                'read_only' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => 'TruckBundle\Entity\Monitoring'
        ]);
    }
}
