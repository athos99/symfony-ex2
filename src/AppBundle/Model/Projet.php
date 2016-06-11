<?php
namespace AppBundle\Model;

use AppBundle\Repository\ProjetRepository;
use Doctrine\ORM\EntityManager;


class Projet extends Base
{

   public function __construct(EntityManager $em)
   {
       parent::__construct($em);
   }

    /**
     * @param $id
     * @return \AppBundle\Entity\Projet
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function loadProjet($id)
    {
        return $this->em->createQuery('
        SELECT p,t,c FROM AppBundle:Projet p
        LEFT JOIN p.taches t 
        LEFT JOIN t.cfc c
        WHERE p.id = :id
            ')->setParameter(':id',$id)
            ->getSingleResult();
    }
}