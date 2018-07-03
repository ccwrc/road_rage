<?php

declare(strict_types=1);

namespace TruckBundle\Form\Dealer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{
    ChoiceType, TextareaType, TextType
};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use TruckBundle\Entity\Dealer;

class DealerEditType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Dealer name: '
            ])
            ->add('street', TextType::class, [
                'label' => 'Street: '
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'Zip code: '
            ])
            ->add('city', TextType::class, [
                'label' => 'City: '
            ])
            ->add('mainPhone', TextType::class, [
                'label' => 'Main phone: '
            ])
            ->add('mainFax', TextType::class, [
                'label' => 'Main fax: ',
                'required' => false
            ])
            ->add('mainMail', TextType::class, [
                'label' => 'Main mail: '
            ])
            ->add('phone24h', TextType::class, [
                'label' => 'Phone - 24h: ',
                'required' => false
            ])
            ->add('phoneServiceCar', TextType::class, [
                'label' => 'Phone - service car: ',
                'required' => false
            ])
            ->add('altPhone1', TextType::class, [
                'label' => 'Phone - optional 1: ',
                'required' => false
            ])
            ->add('altPhone2', TextType::class, [
                'label' => 'Phone - optional 2: ',
                'required' => false
            ])
            ->add('altMail1', TextType::class, [
                'label' => 'Mail - optional 1: ',
                'required' => false
            ])
            ->add('altMail2', TextType::class, [
                'label' => 'Mail - optional 2: ',
                'required' => false
            ])
            ->add('isActive', ChoiceType::class, [
                'choices' => [
                    'active' => Dealer::$dealerIsActive,
                    'inactive' => Dealer::$dealerIsInactive,
                    'suspended' => Dealer::$dealerIsSuspended
                ],
                'choices_as_values' => true, 'label' => 'Is active: '])
            ->add('otherComments', TextareaType::class, [
                'label' => 'Other comments: ',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => 'TruckBundle\Entity\Dealer'
        ]);
    }
}
