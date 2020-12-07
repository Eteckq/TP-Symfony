<?php

namespace App\Entity;

use App\Repository\CommandLineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandLineRepository::class)
 */
class CommandLine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Command::class, inversedBy="commandLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_command;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="commandLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_article;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCommand(): ?Command
    {
        return $this->id_command;
    }

    public function setIdCommand(?Command $id_command): self
    {
        $this->id_command = $id_command;

        return $this;
    }

    public function getIdArticle(): ?Article
    {
        return $this->id_article;
    }

    public function setIdArticle(?Article $id_article): self
    {
        $this->id_article = $id_article;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
