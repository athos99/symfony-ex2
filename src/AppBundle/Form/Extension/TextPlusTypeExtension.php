<?php


namespace AppBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\ButtonBuilder;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;


/**
 * Class TextPlusTypeExtension
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
 *     'prefetch'  prefetch route
 *     'display'   depuis le json nom de la propriété a afficher
 *     'key'       depuis le json nom de la propriété de la reference
 *     'input_key' nom d'un autre champ du formulaire pour enregistrer la reference
 *     'highlight' boolean, enlumine le mot de recherche
 *     'minLength' nombre  de caracteres a saisir avant d'afficher des suggestions
 *     'limit'     nombre max de suggestions
 *     'templates' template
 *     'hint'      boolean  hint
 *     'ttl'       seconds, duree de vie des datas prefetche
 *
 */
class TextPlusTypeExtension extends AbstractTypeExtension
{

    /**
     * @var array
     */
    protected $buttons = array();


    public function getExtendedType()
    {
        return TextType::class;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(array('autocomplete','input_group'));
    }


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (isset($options['input_group']['button_prepend'])) {
            $this->storeButton(
                $this->addButton(
                    $builder,
                    $options['input_group']['button_prepend']
                ),
                $builder,
                'prepend'
            );
        }

        if (isset($options['input_group']['button_append'])) {
            $this->storeButton(
                $this->addButton(
                    $builder,
                    $options['input_group']['button_append']
                ),
                $builder,
                'append'
            );
        }
    }

    /**
     * Adds a button
     *
     * @param FormBuilderInterface $builder
     * @param array $config
     *
     * @return ButtonBuilder
     */
    protected function addButton(FormBuilderInterface $builder, $config)
    {

        $options = (isset($config['options'])) ? $config['options'] : array();

        return $builder->create($config['name'], $config['type'], $options);
    }

    /**
     * Stores a button for later rendering
     *
     * @param ButtonBuilder $buttonBuilder
     * @param FormBuilderInterface $form
     * @param string $position
     */
    protected function storeButton(ButtonBuilder $buttonBuilder, FormBuilderInterface $form, $position)
    {

        if (!isset($this->buttons[$form->getName()])) {
            $this->buttons[$form->getName()] = array();
        }

        $this->buttons[$form->getName()][$position] = $buttonBuilder;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (array_key_exists('autocomplete', $options)) {
            $view->vars['autocomplete'] = $options['autocomplete'];
            $view->vars['attr']['class'] = (isset($view->vars['attr']['class']) ? $view->vars['attr']['class'] : '') . ' typeahead';
        }

        if (isset($this->buttons[$form->getName()])) {

            $storedButtons = $this->buttons[$form->getName()];

            if (isset($storedButtons['prepend']))  {
                $view->vars['input_group']['button_prepend'] = $storedButtons['prepend']->getForm()->createView();
            }

            if (isset($storedButtons['append'])) {
                $view->vars['input_group']['button_append'] = $storedButtons['append']->getForm()->createView();
            }

        }
    }


}