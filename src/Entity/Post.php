<?php

namespace App\Entity;

use App\Entity\Category;
use Doctrine\ORM\Mapping as ORM;
use Sonata\MediaBundle\Model\Media;
use Sonata\MediaBundle\Model\Gallery;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
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
    private $titulo;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $marking = [];

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SonataMediaMedia", cascade={"persist"})
     */
    private $imagem;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SonataMediaGallery", cascade={"persist"})
     */
    private $galeria;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(?string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getMarking(): ?array
    {
        return $this->marking;
    }

    public function setMarking(?array $marking): self
    {
        $this->marking = $marking;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

        return $this;
    }

    /**
     * @return Media
     */
    public function getImagem(): ?Media
    {
        return $this->imagem;
    }
    /**
     * @param Media $imagem
     * @return Post
     */
    public function setImagem(Media $imagem): Post
    {
        $this->imagem = $imagem;
        return $this;
    }
    /**
     * @return Gallery
     */
    public function getGaleria(): ?Gallery
    {
        return $this->galeria;
    }
    /**
     * @param Gallery $galeria
     * @return Post
     */
    public function setGaleria(Gallery $galeria): Post
    {
        $this->galeria = $galeria;
        return $this;
    }
}
