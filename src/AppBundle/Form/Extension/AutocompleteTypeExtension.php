<?php


namespace AppBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;


/**
 * Class AutocompleteTypeExtension
 *
 * @package AppBundle\Form\Extension
 *
 *
 * Ajoute la fonction autocomplete a un type text field du formulaire
 *
 *   Option au field :
 *     'autocomplete'  type : array
 *
 *   Mandatory attributs
 *
 *      'route'     symfony route de la requete ajax
 *      'search'    parametre de recherche de votre route
 *
 *  Optionals
 *     'display'   depuis le json nom de la propriété a afficher
 *     'key'       depuis le json nom de la propriété de la reference
 *     'input_key' nom d'un autre champ du formulaire pour enregistrer la reference
 *     'highlight' boolean, enlumine le mot de recherche
 *     'minLength' nombre  de caracteres a saisir avant d'afficher des suggestions
 *     'limit'     nombre max de suggestions
 *
 */
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
            $view->vars['attr']['class'] = (isset($view->vars['attr']['class']) ? $view->vars['attr']['class'] : '').' typeahead';
        }
    }


}