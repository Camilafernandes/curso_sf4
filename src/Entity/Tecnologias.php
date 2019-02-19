<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TecnologiasRepository")
 */
class Tecnologias
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
    private $nome;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Candidato", mappedBy="tecnologias")
     */
    private $candidatos;

    public function __construct()
    {
        $this->candidatos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return Collection|Candidato[]
     */
    public function getCandidatos(): Collection
    {
        return $this->candidatos;
    }

    public function addCandidato(Candidato $candidato): self
    {
        if (!$this->candidatos->contains($candidato)) {
            $this->candidatos[] = $candidato;
            $candidato->addTecnologia($this);
        }

        return $this;
    }

    public function removeCandidato(Candidato $candidato): self
    {
        if ($this->candidatos->contains($candidato)) {
            $this->candidatos->removeElement($candidato);
            $candidato->removeTecnologia($this);
        }

        return $this;
    }
}
