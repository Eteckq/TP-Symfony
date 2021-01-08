<?php

namespace App\Entity;

use App\Repository\CommandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandRepository::class)
 */
class Command
{

    const STATUS = [
        0 => "En attente",
        1 => "Validée"
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commands")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_command;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\OneToMany(targetEntity=CommandLine::class, mappedBy="id_command", orphanRemoval=true)
     */
    private $commandLines;

    public function __construct()
    {
        $this->commandLines = new ArrayCollection();
        $this->date_command = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getDateCommand(): ?\DateTimeInterface
    {
        return $this->date_command;
    }

    public function setDateCommand(\DateTimeInterface $date_command): self
    {
        $this->date_command = $date_command;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|CommandLine[]
     */
    public function getCommandLines(): Collection
    {
        return $this->commandLines;
    }

    public function addCommandLine(CommandLine $commandLine): self
    {
        if (!$this->commandLines->contains($commandLine)) {
            $this->commandLines[] = $commandLine;
            $commandLine->setIdCommand($this);
        }

        return $this;
    }

    public function removeCommandLine(CommandLine $commandLine): self
    {
        if ($this->commandLines->removeElement($commandLine)) {
            // set the owning side to null (unless already changed)
            if ($commandLine->getIdCommand() === $this) {
                $commandLine->setIdCommand(null);
            }
        }

        return $this;
    }

    // CUSTOMS

    public function getTotalPrice(){
        $amount = 0;
        foreach ($this->getCommandLines() as $commandLine) {
            $amount += $commandLine->getPrix();
        }
        return $amount;
    }

    public function getTotalProducts(){
        $amount = 0;
        foreach ($this->getCommandLines() as $commandLine) {
            $amount += $commandLine->getQuantite();
        }
        return $amount;
    }
}
