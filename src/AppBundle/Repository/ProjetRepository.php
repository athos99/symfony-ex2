<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Projet;

/**
 * ProjetRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjetRepository extends \Doctrine\ORM\EntityRepository
{
    public function saveData($data)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('DELETE FROM AppBundle:Projet');
        $query->execute();
        foreach ($data as $elem) {
            $projet = new Projet();
            $projet->setName(isset($elem['name']) ? $elem['name'] : null);
            $projet->setDescription(isset($elem['description']) ? $elem['description'] : null);
            $projet->setRef(isset($elem['ref']) ? $elem['ref'] : null);
            $em->persist($projet);
        }
        $em->flush();
    }

    public function AllIdByRefs()
    {
        return $this->getEntityManager()->createQuery(
            '
SELECT p
FROM AppBundle:Projet p
INDEX BY p.ref'
        )->execute();
    }

}
