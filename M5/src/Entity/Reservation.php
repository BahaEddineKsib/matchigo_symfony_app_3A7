<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="clientFacture", columns={"idClient"}), @ORM\Index(name="id_plan", columns={"idPlan"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="numReservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $numreservation;

    /**
     * @var int
     *
     * @ORM\Column(name="idClient", type="integer", nullable=false)
     */
    private int $idclient;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrPlace", type="integer", nullable=false)
     */
    private int $nbrplace;

    /**
     * @var Plan
     *
     * @ORM\ManyToOne(targetEntity="Plan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPlan", referencedColumnName="id")
     * })
     */
    private Plan $idplan;


}
