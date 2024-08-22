<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class deckComponent
{
  public string $id;

  public string $name;

  public string $author;
}
