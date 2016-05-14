<?php

namespace AppBundle\Entity;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rubrique
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="rubrique")
 * use repository for handy tree functions
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository") *
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
     * @var \AppBundle\Entity\Rubrique
     *
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Rubrique")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $root;

    /**
     * @var \AppBundle\Entity\Rubrique
     *
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Rubrique", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @var integer
     *
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer", nullable=false)
     */
    private $lft;

    /**
     * @var integer
     *
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer", nullable=false)
     */
    private $rgt;

    /**
     * @var integer
     *
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer", nullable=false)
     */
    private $lvl;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Rubrique", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;



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

