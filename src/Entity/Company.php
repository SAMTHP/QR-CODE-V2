<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 * @ApiResource()
 * @UniqueEntity(
 *     fields={"name", "contact"},
 *     errorPath="name",
 *     errorPath="contact",
 *     message="Une compagnie possède déjà ces informations"
 * )
 */
class Company
{
    /**
     * Company class constructor
     */
    public function __construct()
    {
        $this->discounts = new ArrayCollection();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *  message = "Vous devez renseigner le nom de la compagnie"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *  message = "Vous devez renseigner l'adresse contact de la compagnie"
     * )
     * @Assert\Email(
     *  message = "Vous devez renseigner renseigner un email valide"
     * )
     */
    private $contact;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Discount", mappedBy="company", orphanRemoval=true, cascade={"persist"})
     */
    private $discounts;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return Collection|Discount[]
     */
    public function getDiscounts(): Collection
    {
        return $this->discounts;
    }

    public function addDiscount(Discount $discount): self
    {
        if (!$this->discounts->contains($discount)) {
            $this->discounts[] = $discount;
            $discount->setCompany($this);
        }

        return $this;
    }

    public function removeDiscount(Discount $discount): self
    {
        if ($this->discounts->contains($discount)) {
            $this->discounts->removeElement($discount);
            // set the owning side to null (unless already changed)
            if ($discount->getCompany() === $this) {
                $discount->setCompany(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->name;
    }
}
