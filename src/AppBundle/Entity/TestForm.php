<?php


namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

class TestForm
{
    protected $name;
    protected $ref;
    protected $active;
    protected $hidden;


    protected $url='/';

    /**
     * @Assert\Choice(
     *     choices = { "oui", "non", "-" },
     *     message = "Répondre par oui ou non"
     * )
     */
    protected $ouiNon;


  
    
    public function getOuiNon()
    {
        return $this->ouiNon;
    }

    public function setOuiNon($str)
    {
        $this->ouiNon = $str;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getRef()
    {
        return $this->ref;
    }

    public function setRef($ref)
    {
        $this->ref = $ref;
        return $this;
    }

    public function setHidden($hidden) {
        $this->hidden = $hidden;
        return $this;
    }

    public function getHidden() {
        return $this->hidden;
    }
}
