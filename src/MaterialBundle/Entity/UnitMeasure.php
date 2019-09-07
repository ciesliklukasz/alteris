<?php

namespace MaterialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MaterialBundle\Core\Model\WriteModel;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Table(name="unit_measure")
 * @ORM\Entity(repositoryClass="MaterialBundle\Repository\UnitMeasureRepository")
 */
class UnitMeasure implements WriteModel
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
     * @ORM\Column(name="shortName", type="string", length=255, unique=true)
     */
    private $shortName;

    public function __construct()
    {
        $this->uuid = Uuid::uuid4();
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setShortName($shortName): void
    {
        $this->shortName = $shortName;
    }

    public function getShortName(): string
    {
        return $this->shortName;
    }
}

