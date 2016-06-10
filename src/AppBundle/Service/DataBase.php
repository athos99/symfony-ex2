<?php

namespace AppBundle\Service;
use Doctrine\ORM\EntityManager;

class DataBase
{
    /**
     * @var EntityManager
     */
    public $em;

    /** @var  DataBase */
    protected static $instance = null;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


}