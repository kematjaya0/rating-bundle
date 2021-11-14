<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Kematjaya\RatingBundle\Type;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of RatingType
 *
 * @author guest
 */
class RatingType extends AbstractType implements DataTransformerInterface
{
    /**
    * {@inheritdoc}
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this);
    }
    
    /**
    * {@inheritdoc}
    */
    public function transform($data = null)
    {
        return (float) $data;
    }

    /**
    * {@inheritdoc}
    */
    public function reverseTransform($data)
    {
        return (float) $data;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $maxValue = 5;
        $choice = array_reverse(range(0, $maxValue));
        $choices = array_combine(
            $choice, 
            $choice
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
