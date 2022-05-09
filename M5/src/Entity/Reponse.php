<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse", indexes={@ORM\Index(name="recid", columns={"rec_id"}), @ORM\Index(name="rec_reference", columns={"rec_reference"}), @ORM\Index(name="user_id", columns={"rec_id"})})
 * @ORM\Entity
 */
class Reponse
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="datecreation", type="date", nullable=false)
     */
    private DateTime $datecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255, nullable=false)
     */
    private string $message;

    /**
     * @var Reclamation
     *
     * @ORM\ManyToOne(targetEntity="Reclamation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rec_reference", referencedColumnName="rec_reference")
     * })
     */
    private Reclamation $recReference;

    /**
     * @var Reclamation
     *
     * @ORM\ManyToOne(targetEntity="Reclamation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rec_id", referencedColumnName="id")
     * })
     */
    private Reclamation $rec;


}
