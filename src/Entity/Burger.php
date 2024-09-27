<?php

namespace App\Entity;

use App\Repository\BurgerRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

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
    private Collection $oignons;

   

    #[ORM\ManyToMany(targetEntity: Sauce::class, inversedBy: 'burgers')]

    private Collection $sauces;
    

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Image $image;

 // #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'burgers')]
//    private Collection $commentaires;

    public function __construct()
    {
        $this->oignons = new ArrayCollection(); // Initialize the collection
        $this->sauces = new ArrayCollection();
      
    }
    public function getPain(): ?Pain
    {
        return $this->pain;
    }

    public function setPain(?Pain $pain): static
    {
        $this->pain = $pain;
        return $this;
    }

    public function getOignons(): Collection

    {
        return $this->oignons;
    }

    public function setOignons(Oignon $oignon): static
    {
        if (!$this->oignons->contains($oignon)) {
            $this->oignons->add($oignon);
        }
    
        return $this;
    }

    public function getSauces(): Collection
    {
        return $this->sauces;
    }

    public function setSauces(?Sauce $sauces): static
    {
        if (!$this->sauces->contains($sauces)) {
            $this->sauces->add($sauces);
        }
    
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

    //public function getCommentaires(): ?Commentaire
    //{
        //return $this->commentaires;
    //}

    //public function setCommentaires(?Commentaire $commentaires): static
    //{
       // $this->commentaires = $commentaires;
       // return $this;
    //}
    

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
