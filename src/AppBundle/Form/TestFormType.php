<?php

namespace AppBundle\Form;

use AppBundle\Entity\TestForm;
use AppBundle\Form\Extension\AutocompleteTypeExtension;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\Form\Tests\Extension\Core\Type\ChoiceTypeTest;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ref', TextType::class, [
                'label' => 'autocomplete 1)',
                'autocomplete' => ['route' => 'ajax_autocomplete', 'search' => 'q', 'display' => 'name']
            ])
            ->add('myId', TextType::class,
                ['label' => 'autocomplete2 id (readonly)', 'attr' => ['readonly' => 'readonly']])
            ->add('name', TextType::class, [
                'label' => 'autocomplete2',
                'autocomplete' => [
                    'route' => 'ajax_autocomplete',
                    'search' => 'q',
                    'display' => 'name',
                    'key' => 'id',
                    'input_key' => 'test_form[myId]',
                    'highlight' => false,
                    'limit' => 12,
                    'minLength'=>1
                ],
                'attr' => ['class' => 'zzzz']
            ])
            ->add('ouiNon')
            ->add('recherche', SubmitType::class)
            ->add('button1', ButtonType::class)
            ->add('succes', ButtonType::class, ['attr' => ['class' => 'btn-success']])
            ->add('danger', ButtonType::class, ['attr' => ['class' => 'btn-danger']]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => TestForm::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ));
    }
}
