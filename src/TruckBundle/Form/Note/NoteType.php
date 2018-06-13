<?php

namespace TruckBundle\Form\Note;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use DateTime;

class NoteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add("status", "choice", [
                    "choices" => [
                        "private" => "private",
                        "PUBLIC" => "public"
                    ],
                    "choices_as_values" => true, "label" => "Note status: "])
                ->add("content", "textarea", ["label" => "Note content: "])
                ->add("timePublication", "datetime", ["label" => "Time of publication: "]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "TruckBundle\Entity\Note"
        ]);
    }

}
