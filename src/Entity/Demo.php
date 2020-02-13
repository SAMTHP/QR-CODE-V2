<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\DemoRepository")
 */
class Demo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Demo2", mappedBy="demos")
     */
    private $demo2s;

    public function __construct()
    {
        $this->demo2s = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Demo2[]
     */
    public function getDemo2s(): Collection
    {
        return $this->demo2s;
    }

    public function addDemo2(Demo2 $demo2): self
    {
        if (!$this->demo2s->contains($demo2)) {
            $this->demo2s[] = $demo2;
            $demo2->addDemo($this);
        }

        return $this;
    }

    public function removeDemo2(Demo2 $demo2): self
    {
        if ($this->demo2s->contains($demo2)) {
            $this->demo2s->removeElement($demo2);
            $demo2->removeDemo($this);
        }

        return $this;
    }
}
