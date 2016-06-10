<?php
namespace AppBundle\Model;


use Doctrine\ORM\EntityManager;

class Base {
    /**
     * @var EntityManager
     */
    public $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

}