<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text')
            ->add('email', 'email')
            ->add('name', 'text')
            ->add('surname', 'text')
            ->add('birthday', 'date')
            ->add('password', 'repeated', array(
                    'type' => 'password',
                    'first_options'  => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
                )
            )
            ->add('hobbi', 'choice', array(
                'choices'  => array(
                    'Baseball' => 'Baseball',
                    'Arts' => 'Arts',
                    'Astrology' => 'Astrology',
                    'Bicycling' => 'Bicycling',
                    'Blogging' => 'Blogging',
                    'Boating' => 'Boating',
                    'Bowling' => 'Bowling',
                    'Chess' => 'Chess',
                ),
                // *this line is important*
                'choices_as_values' => true,
//                'multiple' => true,
            ));
    }

    public function getName()
    {
        return 'user';
    }
}