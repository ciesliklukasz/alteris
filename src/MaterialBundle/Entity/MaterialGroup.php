<?php

namespace MaterialBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use MaterialBundle\Core\Model\WriteModel;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Table(name="material_group")
 * @ORM\Entity(repositoryClass="MaterialBundle\Repository\MaterialGroupRepository")
 */
class MaterialGroup implements WriteModel
{
    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $uuid;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="MaterialGroup", inversedBy="parent")
     * @ORM\JoinTable(name="material_group_connection",
     *      joinColumns={@ORM\JoinColumn(name="from_group", referencedColumnName="uuid")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="to_group", referencedColumnName="uuid")}
     *      )
     */
    private $children;

    /**
     * @ORM\ManyToMany(targetEntity="MaterialGroup", mappedBy="children")
     */
    private $parent;

    public function __construct()
    {
        $this->uuid = Uuid::uuid4();
        $this->children = new ArrayCollection();
        $this->parent = new ArrayCollection();
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param MaterialGroup $children
     */
    public function setChildren(MaterialGroup $children): void
    {
        $this->getChildren()->add($children);
    }

    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param MaterialGroup $parent
     */
    public function setParent(MaterialGroup $parent): void
    {
        $this->getParent()->add($parent);
    }
}

