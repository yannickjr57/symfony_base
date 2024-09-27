<?php

namespace App\Entity;

use App\Repository\BurgerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
class Burger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\ManyToOne(targetEntity: Pain::class, inversedBy: 'burgers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pain $pain = null;

    #[ORM\ManyToMany(targetEntity: Oignon::class, inversedBy: 'burgers')]

    private ?Oignon $oignons;

    #[ORM\ManyToMany(targetEntity: Sauce::class, inversedBy: 'burgers')]

    private ?Sauce $sauces;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Image $image;

  #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'burgers')]
    private ?Commentaire $commentaires;


    public function getPain(): ?Pain
    {
        return $this->pain;
    }

    public function setPain(?Pain $pain): static
    {
        $this->pain = $pain;
        return $this;
    }

    public function getOignons(): ?Oignon
    {
        return $this->oignons;
    }

    public function setOignons(?Oignon $oignons): static
    {
        $this->oignons = $oignons;
        return $this;
    }

    public function getSauces(): ?Sauce
    {
        return $this->sauces;
    }

    public function setSauces(?Sauce $sauces): static
    {
        $this->sauces = $sauces;
        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;
        return $this;
    }

    public function getCommentaires(): ?Commentaire
    {
        return $this->commentaires;
    }

    public function setCommentaires(?Commentaire $commentaires): static
    {
        $this->commentaires = $commentaires;
        return $this;
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }
   
}
