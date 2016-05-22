<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class RechercheProjet
{
    protected $name;
    protected $ref;
    protected $active;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getRef()
    {
        return $this->ref;
    }

    public function setRef($ref)
    {
        $this->ref = $ref;
    }
}
