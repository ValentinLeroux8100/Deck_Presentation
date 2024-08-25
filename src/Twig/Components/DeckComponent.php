<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class DeckComponent
{
  public string $id;

  public string $name;

  public string $author;

  public string $colorString;
}
