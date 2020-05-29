<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReponseLongueRepository")
 */
class ReponseLongue
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ReponseLongue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReponseLongue(): ?string
    {
        return $this->ReponseLongue;
    }

    public function setReponseLongue(string $reponse): self
    {
        $this->ReponseLongue = $reponse;

        return $this;
    }
}
