<?php

namespace MaterialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MaterialBundle\Core\Model\WriteModel;
use Ramsey\Uuid\Uuid;

/**
 * Material
 *
 * @ORM\Table(name="material")
 * @ORM\Entity(repositoryClass="MaterialBundle\Repository\MaterialRepository")
 */
class Material implements WriteModel
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(name="uuid", type="string", length=255)
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, unique=true)
     */
    private $code;

    /**
     * @var MaterialGroup
     *
     * @ORM\ManyToOne(targetEntity="MaterialBundle\Entity\MaterialGroup")
     * @ORM\JoinColumn(name="material_group", referencedColumnName="uuid")
     */
    private $materialGroup;

    /**
     * @var UnitMeasure
     *
     * @ORM\ManyToOne(targetEntity="MaterialBundle\Entity\UnitMeasure")
     * @ORM\JoinColumn(name="unit_measure", referencedColumnName="uuid")
     */
    private $unitMeasure;

    public function __construct()
    {
        $this->uuid = Uuid::uuid4();
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function setMaterialGroup(MaterialGroup $materialGroup): void
    {
        $this->materialGroup = $materialGroup;
    }

    public function setUnitMeasure(UnitMeasure $unitMeasure): void
    {
        $this->unitMeasure = $unitMeasure;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getMaterialGroup(): MaterialGroup
    {
        return $this->materialGroup;
    }

    public function getUnitMeasure(): UnitMeasure
    {
        return $this->unitMeasure;
    }
}

