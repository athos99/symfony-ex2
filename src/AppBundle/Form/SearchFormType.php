<?php

namespace AppBundle\Form;

use AppBundle\Entity\SearchForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', HiddenType::class)
            ->add('query',
                TextType::class,
                [
                    'label'=>false,
                    'autocomplete' => [
                        'route' => 'ajax_autocomplete',
                        'search' => 'q',
                        'display' => 'name',
                        'key' => 'id',
                        'input_key' => 'search_form[myId]',
                        'highlight' => true,
                        'limit' => 5,
                        'minLength' => 1,
                    ],
                    'input_group' => [
                        'button_append' => ['name' => 'search', 'type' => SubmitType::class,  'options'=>['icon' => 'search', 'label'=>false]]

                    ],
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => SearchForm::class,
                'csrf_protection' => true,
                'csrf_field_name' => '_token',
            )
        );
    }
}
