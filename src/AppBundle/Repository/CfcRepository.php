<?php

namespace AppBundle\Repository;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use AppBundle\Entity\Cfc;


Class CfcRepository extends NestedTreeRepository
{
    public function saveDataTree($tree)
    {
       $em = $this->getEntityManager();
       $query = $em->createQuery('DELETE FROM AppBundle:Cfc');
       $query->execute();
       $cfc = new Cfc();
       $cfc->setName('root');
       $cfc->setDescription('root');
       $cfc->setRef(null);
       $em->persist($cfc);
//       $em->flush();
       $this->persistTree($tree, $cfc, $em);
   }


    protected function persistTree( $tree, $parent,$em) {
        foreach( $tree as &$elem) {
            $cfc = new Cfc();
            $cfc->setName(isset($elem['name']) ? $elem['name'] : null);
            $cfc->setDescription(isset($elem['description']) ? $elem['description'] : null);
            $cfc->setRef(isset($elem['ref']) ? $elem['ref'] : null);
            $cfc->setParent($parent);
            $em->persist($cfc);
            if (!empty($elem['children'])) {
                $this->persistTree($elem['children'], $cfc,$em);
            }
        }
        $em->flush();
    }


}