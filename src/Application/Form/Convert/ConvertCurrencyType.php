<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace Exchange\Application\Form\Convert;

use Exchange\Application\Provider\CurrencySymbolsProvider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ConvertCurrencyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount', NumberType::class, [
                'label' => 'amount: ',
            ])
            ->add('from', ChoiceType::class, [
                'label' => 'from: ',
                'choices' => [
                    CurrencySymbolsProvider::getSymbols()
                ],
            ])
            ->add('to', ChoiceType::class, [
                'label' => 'to: ',
                'choices' => [
                    CurrencySymbolsProvider::getSymbols()
                ],
            ])
            ->add('convert', SubmitType::class, [
                'label' => 'Convert',
                'attr' => ['class' => 'btn btn-primary']
            ]);
    }
}