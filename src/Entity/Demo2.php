<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Demo2Repository")
 */
class Demo2
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Demo", inversedBy="demo2s")
     */
    private $demos;

    public function __construct()
    {
        $this->demos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Demo[]
     */
    public function getDemos(): Collection
    {
        return $this->demos;
    }

    public function addDemo(Demo $demo): self
    {
        if (!$this->demos->contains($demo)) {
            $this->demos[] = $demo;
        }

        return $this;
    }

    public function removeDemo(Demo $demo): self
    {
        if ($this->demos->contains($demo)) {
            $this->demos->removeElement($demo);
        }

        return $this;
    }
}
