<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlanPlace
 *
 * @ORM\Table(name="plan_place", indexes={@ORM\Index(name="idplan", columns={"idplan"}), @ORM\Index(name="idplace", columns={"idplace"})})
 * @ORM\Entity
 */
class PlanPlace
{
    /**
     * @var \Plan
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Plan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idplan", referencedColumnName="id")
     * })
     */
    private $idplan;

    /**
     * @var \Place
     *
     * @ORM\ManyToOne(targetEntity="Place")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idplace", referencedColumnName="id")
     * })
     */
    private $idplace;


}
