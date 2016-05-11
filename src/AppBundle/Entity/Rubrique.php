<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rubrique
 *
 * @ORM\Table(name="rubrique", indexes={@ORM\Index(name="IDX_BAAB7A1079066886", columns={"root_id"}), @ORM\Index(name="IDX_BAAB7A10727ACA70", columns={"parent_id"})})
 * @ORM\Entity
 */
class Rubrique
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
     * @var integer
     *
     * @ORM\Column(name="root_id", type="integer", nullable=true)
     */
    private $rootId;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=true)
     */
    private $parentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="lft", type="integer", nullable=false)
     */
    private $lft;

    /**
     * @var integer
     *
     * @ORM\Column(name="rgt", type="integer", nullable=false)
     */
    private $rgt;

    /**
     * @var integer
     *
     * @ORM\Column(name="lvl", type="integer", nullable=false)
     */
    private $lvl;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=true)
     */
    private $name;

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
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;


}

