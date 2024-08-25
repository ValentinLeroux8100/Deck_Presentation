<?php

namespace App\Entity;

use App\Repository\DeckRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeckRepository::class)]
class Deck
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank()]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[Assert\NotBlank()]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $deckList = null;

    #[ORM\Column(length: 200)]
    private ?string $cover = null;

    #[ORM\ManyToOne(inversedBy: 'decks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $colors = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDeckList(): ?string
    {
        return $this->deckList;
    }

    public function setDeckList(string $deckList): static
    {
        $cardInfos = explode('\n', $deckList);

        $deckListFinal = array_map(function ($cardInfo) {
            $splitedCardInfos = explode(' ', $cardInfo);

            return implode("$", $splitedCardInfos);
        }, $cardInfos);


        $this->deckList = implode("\n", $deckListFinal);

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): static
    {
        $this->cover = $cover;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getColors(): ?string
    {
        return $this->colors;
    }

    public function setColors(?string $colors): static
    {
        $this->colors = $colors;

        return $this;
    }
}
