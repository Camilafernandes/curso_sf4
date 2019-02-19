<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HistoricoRepository")
 */
class Historico
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
     * @ORM\Column(type="string", length=255)
     */
    private $empresa;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data_entrada;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data_saida;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $emprego_atual;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $atribuicoes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Candidato", inversedBy="historico")
     */
    private $candidato;

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

    public function getEmpresa(): ?string
    {
        return $this->empresa;
    }

    public function setEmpresa(string $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }

    public function getDataEntrada(): ?\DateTimeInterface
    {
        return $this->data_entrada;
    }

    public function setDataEntrada(\DateTimeInterface $data_entrada): self
    {
        $this->data_entrada = $data_entrada;

        return $this;
    }

    public function getDataSaida(): ?\DateTimeInterface
    {
        return $this->data_saida;
    }

    public function setDataSaida(\DateTimeInterface $data_saida): self
    {
        $this->data_saida = $data_saida;

        return $this;
    }

    public function getEmpregoAtual(): ?bool
    {
        return $this->emprego_atual;
    }

    public function setEmpregoAtual(?bool $emprego_atual): self
    {
        $this->emprego_atual = $emprego_atual;

        return $this;
    }

    public function getAtribuicoes(): ?string
    {
        return $this->atribuicoes;
    }

    public function setAtribuicoes(?string $atribuicoes): self
    {
        $this->atribuicoes = $atribuicoes;

        return $this;
    }

    public function getCandidato(): ?Candidato
    {
        return $this->candidato;
    }

    public function setCandidato(?Candidato $candidato): self
    {
        $this->candidato = $candidato;

        return $this;
    }
}
