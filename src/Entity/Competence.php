<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 */
class Competence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\OneToMany(targetEntity=Theme::class, mappedBy="competence")
     */
    private $Themes;

    public function __construct()
    {
        $this->Themes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * @return Collection|Theme[]
     */
    public function getThemes(): Collection
    {
        return $this->Themes;
    }

    public function addTheme(Theme $theme): self
    {
        if (!$this->Themes->contains($theme)) {
            $this->Themes[] = $theme;
            $theme->setCompetence($this);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): self
    {
        if ($this->Themes->contains($theme)) {
            $this->Themes->removeElement($theme);
            // set the owning side to null (unless already changed)
            if ($theme->getCompetence() === $this) {
                $theme->setCompetence(null);
            }
        }

        return $this;
    }
}
