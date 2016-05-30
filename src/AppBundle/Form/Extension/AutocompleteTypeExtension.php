<?php


namespace AppBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;

class AutocompleteTypeExtension extends AbstractTypeExtension
{
    public function getExtendedType()
    {
        return TextType::class;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(array('autocomplete'));
    }


    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (array_key_exists('autocomplete', $options)) {
            $view->vars['autocomplete'] = $options['autocomplete'];
            
        }
    }


}