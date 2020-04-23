<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FieldRepository")
 */
class Field
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @ORM\Column(type="smallint")
     */
    private $typeQuestion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $aide;

    /**
     * @ORM\Column(type="boolean")
     */
    private $obligatoire;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $borneInf;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $borneSup;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $choix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getTypeQuestion(): ?int
    {
        return $this->typeQuestion;
    }

    public function setTypeQuestion(int $typeQuestion): self
    {
        $this->typeQuestion = $typeQuestion;

        return $this;
    }

    public function getAide(): ?string
    {
        return $this->aide;
    }

    public function setAide(?string $aide): self
    {
        $this->aide = $aide;

        return $this;
    }

    public function getObligatoire(): ?bool
    {
        return $this->obligatoire;
    }

    public function setObligatoire(bool $obligatoire): self
    {
        $this->obligatoire = $obligatoire;

        return $this;
    }

    public function getBorneInf(): ?int
    {
        return $this->borneInf;
    }

    public function setBorneInf(?int $borneInf): self
    {
        $this->borneInf = $borneInf;

        return $this;
    }

    public function getBorneSup(): ?int
    {
        return $this->borneSup;
    }

    public function setBorneSup(?int $borneSup): self
    {
        $this->borneSup = $borneSup;

        return $this;
    }

    public function getChoix(): ?array
    {
        return $this->choix;
    }

    public function setChoix(?array $choix): self
    {
        $this->choix = $choix;

        return $this;
    }
}
