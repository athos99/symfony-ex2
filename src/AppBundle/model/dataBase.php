<?php

namespace AppBundle\Model;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;

class DataBase
{

    /**
     * @var  Registry
     */
    public $registry;

    /**
     * @var EntityManager
     */
    public $em;

    /** @var  DataBase */
    protected static $instance = null;

    public function __construct(Registry $registry)
    {
        $this->$registry = $registry;
        $this->em = $registry->getManager();
    }

    public static function instance(Registry $registry)
    {
        if (!self::$instance) {
            self::$instance = new DataBase($registry);
        }
    }

}