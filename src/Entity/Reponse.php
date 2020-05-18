<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReponseRepository")
 */
class Reponse
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
    private $Reponse;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getReponse(): ?string
    {
        return $this->Reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->Reponse = $reponse;

        return $this;
    }
}
