<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ff
 *
 * @ORM\Table(name="ff")
 * @ORM\Entity
 */
class Ff
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}
