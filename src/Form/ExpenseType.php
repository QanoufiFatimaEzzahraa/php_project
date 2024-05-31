<?php

namespace App\Form;

use App\Entity\Expense;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('amount', MoneyType::class, [
            ])
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Office Supplies' => 'office_supplies',
                    'Travel' => 'travel',
                    'Meals and Entertainment' => 'meals_entertainment',
                    'Utilities' => 'utilities',
                    'Other' => 'other',
                ],
                'placeholder' => 'Choose a category',
            ])
            ->add('receipt', FileType::class, [
                'required' => false,
                'label' => 'Receipt File',
            ])
            ->add('save', SubmitType::class, ['label' => 'Save Expense']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Expense::class,
        ]);
    }
}
