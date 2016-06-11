<?php
namespace AppBundle\Helper;


class Application
{

    /**
     * @return \AppKernel
     */
    static public function getKernel()
    {
        return $GLOBALS['kernel'];
    }

    /**
     * Gets a container service by its id.
     *
     * @param string $id The service id
     *
     * @return object The service
     */
    static public function get($name)
    {
        return $GLOBALS['kernel']->getContainer()->get($name);
    }


    /**
     * Gets the logger for the application.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    static public function getLogger()
    {
        return self::get('monolog.logger.application');
    }

}



