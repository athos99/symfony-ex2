<?php
namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;


class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->addChild('Home', array('route' => 'homepage'));
        $menu->addChild('Admin', array('route' => 'admin_homepage'));
        if ( $this->container->get('kernel')->getEnvironment() == 'dev') {
            $menu['Admin']->addChild('charge excel cfc', array('route' => 'admin_xcl_cfc'));
            $menu['Admin']->addChild('charge excel projet', array('route' => 'admin_xcl_projet'));
            $menu['Admin']->addChild('charge excel tache', array('route' => 'admin_xcl_tache'));
            $menu['Admin']->addChild('Test forme', array('route' => 'admin_test_form'));

        }
        $menu['Admin']->addChild('Recherche projet', array('route' => 'admin_recherche_projet'));
        return $menu;
    }
}