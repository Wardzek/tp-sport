<?php

namespace App\Form;

use App\Entity\Athete;
use App\Entity\Sport;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('shortname')
            ->add('sport', EntityType::class, [
                'class' => Sport::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => false,
                'attr' => [
                    'class' => 'd-flex',
                ]
            ])
            ->add('athetes', EntityType::class, [
                'class' => Athete::class,
                'choice_label' => function(Athete $athete) {
                    return $athete->getFirstname().' '.$athete->getLastname();
                },
                'by_reference' => false,
                'expanded' => true,
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
