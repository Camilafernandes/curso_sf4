<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CandidatoRepository")
 * @ORM\Table(name="candidato")
 */
class Candidato
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $nome;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(min="0", max="120")
     */
    private $idade;

    /**
     * @ORM\Column(type="string", length=1)
     * @Assert\NotBlank()
     */
    private $sexo;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $data_nascimento;

    /**
     * @ORM\Column(type="decimal", precision=2, length=10)
     * @Assert\NotBlank()
     * @Assert\Range(min="0", max="10000000")
     */
    private $pretensao_salarial;

    /**
     * @ORM\Column(type="string")
     * @Assert\File(mimeTypes={"image/png", "image/jpg"})
     */
    private $foto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cargo")
     * @Assert\NotBlank()
     */
    private $cargo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Endereco", cascade={"persist"})
     * @Assert\Valid()
     */
    private $endereco;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Historico", mappedBy="candidato")
     * @Assert\Valid()
     */
    private $historico;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tecnologias", inversedBy="candidatos")
     * @ORM\JoinTable(name="candidatos_tecnologias")
     */
    private $tecnologias;

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getIdade()
    {
        return $this->idade;
    }

    public function setIdade($idade)
    {
        $this->idade = $idade;
        return $this;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
        return $this;
    }

    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento($data_nascimento)
    {
        $this->data_nascimento = $data_nascimento;
        return $this;
    }

    public function getPretensaoSalarial()
    {
        return $this->pretensao_salarial;
    }

    public function setPretensaoSalarial($pretensao_salarial)
    {
        $this->pretensao_salarial = $pretensao_salarial;
        return $this;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
        return $this;
    }

    public function getCargo()
    {
        return $this->cargo;
    }

    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
        return $this;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }

    public function getHistorico()
    {
        return $this->historico;
    }

    public function setHistorico($historico)
    {
        $this->historico = $historico;
        return $this;
    }

    public function getTecnologias()
    {
        return $this->tecnologias;
    }

    public function setTecnologias($tecnologias)
    {
        $this->tecnologias = $tecnologias;
        return $this;
    }
}
