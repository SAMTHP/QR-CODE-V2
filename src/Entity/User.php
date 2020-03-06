<?php

namespace App\Entity;

use App\Entity\ApiRole;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ApiResource(
 *  normalizationContext={"groups"={"users_read"}}
 * )
 * @UniqueEntity(
 *  fields={"email"},
 *  message = "Un autre utilisateur possède déjà cette adresse email, merci de la modifier"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups(
     *  {"users_read"}
     * )
     * @Assert\NotBlank(
     *  message = "Vous devez renseigner votre prénom"
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups(
     *  {"users_read"}
     * )
     * @Assert\NotBlank(
     *  message = "Vous devez renseigner votre nom"
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups(
     *  {"users_read"}
     * )
     * @Assert\NotBlank(
     *  message = "Vous devez renseigner votre email"
     * )
     * @Assert\Email(
     *  message = "Vous devez renseigner renseigner un email valide"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *  message = "Vous devez renseigner votre mot de passe"
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups(
     *  {"users_read"}
     * )
     * @Assert\NotBlank(
     *  message = "Vous devez renseigner votre numéro de téléphone"
     * )
     */
    private $phone;

    /**
     * @ORM\Column(type="boolean")
     * @Groups(
     *  {"users_read"}
     * )
     * @Assert\NotBlank(
     *  message = "Vous devez définir l'accord"
     * )
     */
    private $hasAgreed;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Discount", mappedBy="users", cascade={"persist"})
     * @Groups(
     *  {"users_read"}
     * )
     */
    private $discounts;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ApiRole", mappedBy="users", cascade={"persist"})
     * @Groups(
     *  {"users_read"}
     * )
     */
    private $apiRoles;

    public function __construct()
    {
        $this->discounts = new ArrayCollection();
        $this->apiRoles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getHasAgreed(): ?bool
    {
        return $this->hasAgreed;
    }

    public function setHasAgreed(bool $hasAgreed): self
    {
        $this->hasAgreed = $hasAgreed;

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
            $discount->addUser($this);
        }

        return $this;
    }

    public function removeDiscount(Discount $discount): self
    {
        if ($this->discounts->contains($discount)) {
            $this->discounts->removeElement($discount);
            $discount->removeUser($this);
        }

        return $this;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     */
    public function getRoles()
    {
        $roles = $this->apiRoles->map(function($role){
            return $role->getTitle();
        })->toArray();

        $roles[] = 'ROLE_USER';

        return $roles;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string|null The encoded password if any
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt(){}

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials(){}

    public function __toString()
    {
        return (string) $this->lastName.' '.$this->firstName;
    }

    /**
     * @return Collection|ApiRole[]
     */
    public function getApiRoles(): Collection
    {
        return $this->apiRoles;
    }

    public function addApiRole(ApiRole $apiRole): self
    {
        if (!$this->apiRoles->contains($apiRole)) {
            $this->apiRoles[] = $apiRole;
            $apiRole->addUser($this);
        }

        return $this;
    }

    public function removeApiRole(ApiRole $apiRole): self
    {
        if ($this->apiRoles->contains($apiRole)) {
            $this->apiRoles->removeElement($apiRole);
            $apiRole->removeUser($this);
        }

        return $this;
    }
}
