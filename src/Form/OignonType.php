<?php

namespace App\Form;

use App\Entity\Burger;
use App\Entity\Oignon;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OignonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'oignon',
// Suggested code may be subject to a license. Learn more: ~LicenseLog:594484492.
                'required' => true,
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Oignon::class,
        ]);
    }
}
