<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReponsesRepository")
 */
class Reponses
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $Id;

    /**
     * @ORM\Column(type="array")
     */
    private $Reponses = [];

    public function getId(): ?int
    {
        return $this->Id;
    }

    public function setId(int $id): self
    {
        $this->Id = $id;

        return $this;
    }

    public function getReponses(): ?array
    {
        return $this->Reponses;
    }

    public function setReponses(array $reponses): self
    {
        $this->Reponses = $reponses;

        return $this;
    }
}
