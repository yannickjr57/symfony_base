<?php

namespace App\Entity;

use App\Repository\PainRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PainRepository::class)]
class Pain
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Burger::class, mappedBy: "pains")]
    private $burgers;

    

    public function getBurgers(): ?Burger
    {
        return $this->burgers;
    }

    public function setBurgers(Burger $burgers): static
    {
        $this->burgers = $burgers;
        return $this;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    


}
