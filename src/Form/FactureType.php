<?php

namespace App\Form;

use App\Entity\Facture;
use App\Entity\Compteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero_facture')
            ->add('date_facture')
            ->add('date_limite')
            ->add('montant_facture')
            ->add('compteur', EntityType::class, [
                               'class'=>Compteur::class,  'choice_label' => 'numero_compteur'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
