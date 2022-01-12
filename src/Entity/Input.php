<?php

namespace App\Entity;

use App\Repository\InputRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InputRepository::class)]
class Input
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $inputText;

    #[ORM\Column(type: 'string', length: 255)]
    private $transformation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInputText(): ?string
    {
        return $this->inputText;
    }

    public function setInputText(string $inputText): self
    {
        $this->inputText = $inputText;

        return $this;
    }

    public function getTransformation(): ?string
    {
        return $this->transformation;
    }

    public function setTransformation(string $transformation): self
    {
        $this->transformation = $transformation;

        return $this;
    }
}
