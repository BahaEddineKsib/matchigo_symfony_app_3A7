<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlanImage
 *
 * @ORM\Table(name="plan_image")
 * @ORM\Entity
 */
class PlanImage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idPlan", type="integer", nullable=false)
     */
    private $idplan;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=400, nullable=false)
     */
    private $path;


}
