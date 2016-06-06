<?php


namespace AppBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\ButtonBuilder;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;


/**
 * Class ButtonsPlusTypeExtension
 *
 * @package AppBundle\Form\Extension
 *
 *
 * Ajoute un icon a un type button
 *
 *   Option au field :
 *     'icon'  array valeur = nom de l'icon
 *
 *
 */
class ButtonPlusTypeExtension extends AbstractTypeExtension
{



    public function getExtendedType()
    {
        return ButtonType::class;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(array('icon'));
    }



    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (array_key_exists('icon', $options)) {
            $view->vars['icon'] = $options['icon'];
        }

    }


}