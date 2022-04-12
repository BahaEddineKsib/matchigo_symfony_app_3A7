<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plan
 *
 * @ORM\Table(name="plan")
 * @ORM\Entity
 */
class Plan
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
     * @ORM\Column(name="idGuide", type="integer", nullable=false)
     */
    private $idguide;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=300, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=5000, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="nmbrPlacesMax", type="integer", nullable=false)
     */
    private $nmbrplacesmax;

    /**
     * @var int
     *
     * @ORM\Column(name="nmbrPlacesReste", type="integer", nullable=false)
     */
    private $nmbrplacesreste;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date", nullable=false)
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date", nullable=false)
     */
    private $datefin;

    /**
     * @var string
     *
     * @ORM\Column(name="pointDepart", type="string", length=300, nullable=false)
     */
    private $pointdepart;

    /**
     * @var float
     *
     * @ORM\Column(name="note", type="float", precision=10, scale=0, nullable=false)
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdguide(): ?int
    {
        return $this->idguide;
    }

    public function setIdguide(int $idguide): self
    {
        $this->idguide = $idguide;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNmbrplacesmax(): ?int
    {
        return $this->nmbrplacesmax;
    }

    public function setNmbrplacesmax(int $nmbrplacesmax): self
    {
        $this->nmbrplacesmax = $nmbrplacesmax;

        return $this;
    }

    public function getNmbrplacesreste(): ?int
    {
        return $this->nmbrplacesreste;
    }

    public function setNmbrplacesreste(int $nmbrplacesreste): self
    {
        $this->nmbrplacesreste = $nmbrplacesreste;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getPointdepart(): ?string
    {
        return $this->pointdepart;
    }

    public function setPointdepart(string $pointdepart): self
    {
        $this->pointdepart = $pointdepart;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): self
    {
        $this->note = $note;

        return $this;
    }


}
