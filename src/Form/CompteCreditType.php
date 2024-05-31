<?php

namespace App\Form;

use App\Entity\CompteCredit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteCreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', TextType::class, [
                'label' => 'Type de carte de crédit',
                'attr' => [
                    'placeholder' => 'Visa, Mastercard, etc.'
                ]
            ])
            ->add('nomBanque', TextType::class, [
                'label' => 'Nom de la banque'
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom du titulaire'
            ])
            ->add('expirationDate', DateType::class, [
                'label' => 'Date d\'expiration',
                 'widget' => 'single_text',
            ])
            ->add('cvv', IntegerType::class, [
                'label' => 'Code de sécurité'
            ])
            ->add('creditLimit', NumberType::class, [
                'label' => 'Limite de crédit'
            ])
            ->add('availableCredit', NumberType::class, [
                'label' => 'Crédit disponible'
            ])
            ->add('minimumPayment', NumberType::class, [
                'label' => 'Paiement minimum'
            ])
            ->add('interestRate', NumberType::class, [
                'label' => 'Taux d\'intérêt (%)'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CompteCredit::class,
        ]);
    }
}
