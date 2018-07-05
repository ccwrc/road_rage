<?php

declare(strict_types=1);

namespace TruckBundle\Form\Note;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{
    ChoiceType, DateTimeType, TextareaType
};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use TruckBundle\Entity\Note;

class NoteEditType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'private' => Note::$statusPrivate,
                    'PUBLIC' => Note::$statusPublic
                ],
                'choices_as_values' => true,
                'label' => 'Note status: '
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Note content: '
            ])
            ->add('timePublication', DateTimeType::class, [
                'label' => 'Time of publication: '
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => 'TruckBundle\Entity\Note'
        ]);
    }
}
