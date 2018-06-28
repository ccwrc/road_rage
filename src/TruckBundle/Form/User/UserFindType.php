<?php

declare(strict_types=1);

namespace TruckBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFindType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pieceOfUsername', TextType::class, [
                'label' => 'by piece of username: ',
                'required' => false,
            ])
            ->add('pieceOfEmail', TextType::class, [
                'label' => 'by piece of email: ',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => 'TruckBundle\Presenter\UserFindPresenter'
        ]);
    }
}
