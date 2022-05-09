<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlanPlace
 *
 * @ORM\Table(name="plan_place", indexes={@ORM\Index(name="idplace", columns={"idplace"}), @ORM\Index(name="idplan", columns={"idplan"})})
 * @ORM\Entity
 */
class PlanPlace
{
    /**
     * @var int
     *
     * @ORM\Column(name="ref", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ref;

    /**
     * @var \Place
     *
     * @ORM\ManyToOne(targetEntity="Place")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idplace", referencedColumnName="id")
     * })
     */
    private $idplace;

    /**
     * @var \Plan
     *
     * @ORM\ManyToOne(targetEntity="Plan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idplan", referencedColumnName="id")
     * })
     */
    private $idplan;

    public function getRef(): ?int
    {
        return $this->ref;
    }

    public function getIdplace(): ?Place
    {
        return $this->idplace;
    }

    public function setIdplace(?Place $idplace): self
    {
        $this->idplace = $idplace;

        return $this;
    }

    public function getIdplan(): ?Plan
    {
        return $this->idplan;
    }

    public function setIdplan(?Plan $idplan): self
    {
        $this->idplan = $idplan;

        return $this;
    }


}
