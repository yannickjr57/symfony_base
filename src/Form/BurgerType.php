<?php

namespace App\Form;
use App\Entity\Burger;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Entity\Sauce;
use App\Entity\Oignon;
use App\Entity\Pain;
class BurgerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du burger',
            ])
            ->add('price', IntegerType::class, [
                'label' => 'prix du burger',
            ])

            ->add("sauces", EntityType::class, [
                "label" => "Sauces",
                "class" => Sauce::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => true,
                'by_reference' => false
            ])
            ->add("oignons", EntityType::class, [
                "label" => "Oignons",
                "class" => Oignon::class,
                'choice_label' => 'name',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => true,
                'by_reference' => false
            ])
            
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ])
            ;
   }

   public function configureOptions(OptionsResolver $resolver): void
   {
       $resolver->setDefaults([
           'data_class' => Burger::class,
       ]);
   }
}
