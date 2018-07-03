<?php

declare(strict_types=1);

namespace TruckBundle\Form\Monitoring;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{
    ChoiceType, NumberType, TextareaType, TextType
};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use TruckBundle\Entity\Dealer;
use TruckBundle\Entity\Monitoring;
use TruckBundle\Repository\DealerRepository;

class MonitoringRoType extends AbstractType
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
            ->add('outComment', TextareaType::class, [
                'label' => 'Comment for repair dealer: ',
                'required' => false
            ])
            ->add('optionalMails', TextareaType::class, [
                'label' => 'Optional mails to send the document: ',
                'required' => false
            ])
            ->add('repairDealer', EntityType::class, [
                'class' => 'TruckBundle:Dealer',
                'query_builder' => function (DealerRepository $dr) {
                    return $dr->createQueryBuilder('dealer')
                        ->where('dealer.isActive = :active')
                        ->orderBy('dealer.name', 'ASC')
                        ->setParameter('active', Dealer::$dealerIsActive);
                },
                'choice_label' => 'name',
                'label' => 'Repair dealer: '
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => 'TruckBundle\Entity\Monitoring'
        ]);
    }
}
