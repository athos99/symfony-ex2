<?php
namespace AppBundle\Model;

use AppBundle\Repository\ProjetRepository;
use Doctrine\ORM\EntityManager;


class Projet extends Base
{
    /**
     * @var ProjetRepository
     */
   public $projetRepo;

   public function __construct(EntityManager $em)
   {
       parent::__construct($em);
       $this->projetRepo = $this->em->getRepository('AppBundle:Projet');
   }

    public function loadProjet($id)
    {
        /** @var \AppBundle\Entity\Projet $projet */
        $projet = $this->projetRepo->find($id);
        $taches = $projet->getTaches();
        foreach( $taches as $tache) {
            $x= $tache;
        }

        $projet = $this->projetRepo->findOneByIdJoinedToTache($id);

    }
}