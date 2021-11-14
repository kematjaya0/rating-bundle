<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Kematjaya\RatingBundle\Type;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of RatingType
 *
 * @author guest
 */
class RatingType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $maxValue = 5;
        $choices = array_combine(
            array_reverse(range(1, $maxValue)), 
            array_reverse(range(1, $maxValue))
        );
        
        $resolver->setDefaults([
            'choices' => $choices,
            'max_value' => $maxValue,
            'choices_as_values' => true,
            'expanded' => true,
            'multiple' => false
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rating';
    }
    
    public function getParent()
    {
        return ChoiceType::class;
    }
}
