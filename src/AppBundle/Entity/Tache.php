<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tache
 *
 * @ORM\Table(name="tache", indexes={@ORM\Index(name="tache_id", columns={"tache_id"}), @ORM\Index(name="projet_id", columns={"projet_id"})})
 * @ORM\Entity
 */
class Tache
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=256, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \AppBundle\Entity\Projet
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Projet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="projet_id", referencedColumnName="id")
     * })
     */
    private $projet;

    /**
     * @var \AppBundle\Entity\Projet
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Projet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tache_id", referencedColumnName="id")
     * })
     */
    private $tache;


}

