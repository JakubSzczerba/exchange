<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace Exchange\Application\Form\List;

use Exchange\Application\Provider\TimeRangeProvider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MinMaxRateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('currency', ChoiceType::class, [
                'label' => 'Currency',
                'choices' => [
                    'PLN' => 'PLN',
                    'EUR' => 'EUR',
                    'USD' => 'USD',
                ],
            ])
            ->add('timeRange', ChoiceType::class, [
                'label' => 'Time Range',
                'choices' => [
                    'Quarter' => TimeRangeProvider::getQuarterChoices(),
                    'Month' => TimeRangeProvider::getMonthChoices(),
                    'Week' => TimeRangeProvider::getWeekChoices()
                ],
                'required' => true
            ])
            ->add('search', SubmitType::class, [
                'label' => 'Search',
                'attr' => ['class' => 'btn btn-primary']
            ]);
    }
}