<?php

namespace App\Entity;

use App\Repository\CathegoriRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=App\Repository\CathegoriRepository::class)
 */
class Cathegori
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imag;

    /**
     * @ORM\OneToMany(targetEntity=Award::class, mappedBy="cathegori")
     */
    private $awards;

    public function __construct()
    {
        $this->awards = new ArrayCollection();
    }
    public function __toString()
    {
        return '' . $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImag(): ?string
    {
        return $this->imag;
    }

    public function setImag(string $imag): self
    {
        $this->imag = $imag;

        return $this;
    }

    /**
     * @return Collection|Award[]
     */
    public function getAwards(): Collection
    {
        return $this->awards;
    }

    public function addAward(Award $award): self
    {
        if (!$this->awards->contains($award)) {
            $this->awards[] = $award;
            $award->setCathegori($this);
        }

        return $this;
    }

    public function removeAward(Award $award): self
    {
        if ($this->awards->removeElement($award)) {
            // set the owning side to null (unless already changed)
            if ($award->getCathegori() === $this) {
                $award->setCathegori(null);
            }
        }

        return $this;
    }
}
