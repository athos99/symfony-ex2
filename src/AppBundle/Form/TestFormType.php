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
            ->add('name',TextType::class, ['query'=>'url','attr'=>['class'=>'typehead']])
            ->add('ref',TextType::class)
            ->add('ouiNon')
            ->add('recherche', SubmitType::class)
            ->add('button1', ButtonType::class)
            ->add('succes', ButtonType::class,['attr'=>['class'=>'btn-success']])
            ->add('danger', ButtonType::class,['attr'=>['class'=>'btn-danger']])
        ;
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
