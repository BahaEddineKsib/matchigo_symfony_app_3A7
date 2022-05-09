<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Rdv
 *
 * @ORM\Table(name="rdv")
 * @ORM\Entity
 */
class Rdv
{
    /**
     * @var int
     *
     * @ORM\Column(name="ref_rdv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $refRdv;

    /**
     * @var int
     *
     * @ORM\Column(name="idPlan", type="integer", nullable=false)
     */
    private int $idplan;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_rdv", type="date", nullable=false)
     */
    private DateTime $dateRdv;

    /**
     * @var float
     *
     * @ORM\Column(name="reduction", type="float", precision=10, scale=0, nullable=false)
     */
    private float $reduction;


}
