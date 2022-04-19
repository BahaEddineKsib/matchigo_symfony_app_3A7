<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity
 */
class Commentaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="idComm", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcomm;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nomu", type="string", length=255, nullable=true)
     */
    private $nomu;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenomu", type="string", length=255, nullable=true)
     */
    private $prenomu;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contenu", type="string", length=255, nullable=true)
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="commentaires" )
     */
    private $idclient;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datePost;

    /**
     * @ORM\ManyToOne(targetEntity=Plan::class, inversedBy="commentaires")
     */
    private $plan;





    /**
     * @return int
     */
    public function getIdcomm(): int
    {
        return $this->idcomm;
    }
// Register Magic Method to Print the name of the State e.g California
    public function __toString() {
        return $this->idclient;
    }
    /**
     * @param int $idcomm
     */
    public function setIdcomm(int $idcomm): void
    {
        $this->idcomm = $idcomm;
    }

    /**
     * @return string|null
     */
    public function getNomu(): ?string
    {
        return $this->nomu;
    }

    /**
     * @param string|null $nomu
     */
    public function setNomu(?string $nomu): void
    {
        $this->nomu = $nomu;
    }

    /**
     * @return string|null
     */
    public function getPrenomu(): ?string
    {
        return $this->prenomu;
    }

    /**
     * @param string|null $prenomu
     */
    public function setPrenomu(?string $prenomu): void
    {
        $this->prenomu = $prenomu;
    }

    /**
     * @return string|null
     */
    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    /**
     * @param string|null $contenu
     */
    public function setContenu(?string $contenu): void
    {
        $this->contenu = $contenu;
    }

    public function getIdclient(): ?Utilisateur
    {
        return $this->idclient;
    }

    public function setIdclient(?Utilisateur $idclient): self
    {
        $this->idclient = $idclient;

        return $this;
    }

    public function getDatePost(): ?\DateTimeInterface
    {
        return $this-> datePost;
    }

    public function setDatePost(?\DateTimeInterface $datePost): self
    {
        $this->datePost = $datePost;

        return $this;
    }

    public function getPlan(): ?Plan
    {
        return $this->plan;
    }

    public function setPlan(?Plan $plan): self
    {
        $this->plan = $plan;

        return $this;
    }






}
