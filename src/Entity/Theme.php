<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ThemeRepository::class)
 */
class Theme
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
    private $Nom;

    /**
     * @ORM\OneToMany(targetEntity=Soustheme::class, mappedBy="theme", cascade={"persist"})
     */
    private $Sousthemes;

    /**
     * @ORM\ManyToOne(targetEntity=Competence::class, inversedBy="Themes")
     */
    private $competence;

    public function __construct()
    {
        $this->Sousthemes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|Soustheme[]
     */
    public function getSousthemes(): Collection
    {
        return $this->Sousthemes;
    }

    public function addSoustheme(Soustheme $soustheme): self
    {
        if (!$this->Sousthemes->contains($soustheme)) {
            $this->Sousthemes[] = $soustheme;
            $soustheme->setTheme($this);
        }

        return $this;
    }

    public function removeSoustheme(Soustheme $soustheme): self
    {
        if ($this->Sousthemes->contains($soustheme)) {
            $this->Sousthemes->removeElement($soustheme);
            // set the owning side to null (unless already changed)
            if ($soustheme->getTheme() === $this) {
                $soustheme->setTheme(null);
            }
        }

        return $this;
    }

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): self
    {
        $this->competence = $competence;

        return $this;
    }
    public function __toString()
    {
        return $this->Nom;
    }
}
