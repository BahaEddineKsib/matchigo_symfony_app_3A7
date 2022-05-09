<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Match
 *
 * @ORM\Table(name="match")
 * @ORM\Entity
 */
class Match
{
    /**
     * @var int
     *
     * @ORM\Column(name="ref_match", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $refMatch;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="id_client", type="date", nullable=false)
     */
    private DateTime $idClient;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_match", type="date", nullable=false)
     */
    private DateTime $dateMatch;


}
