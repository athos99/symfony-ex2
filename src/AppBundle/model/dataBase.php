<?php

namespace AppBundle\Model;


use Doctrine\Bundle\DoctrineBundle\Registry;
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

    public static function instance(EntityManager $em)
    {
        if (!self::$instance) {
            self::$instance = new DataBase($em);
        }
    }

}