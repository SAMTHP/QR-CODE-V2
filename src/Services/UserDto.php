<?php
namespace App\Services;

use App\Entity\User;

/**
 * The Data Transfer Object for User.
 * It stores the mandatory data for a particular use case - for example ignoring the groups,
 * and ensuring easy serialization.
 */
class UserDto
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $hasAgreed;
    private $discounts;
    private $roles;

    /**
     * In more complex implementations, the population of the DTO can be the responsibilty
     * of an Assembler object, which would also break any dependency between User and UserDTO.
     */
    public function __construct()
    {
        
    }

    public function initUser(User $user) {
        $this->id = $user->getId();
        $this->firstName = $user->getFirstName();
        $this->lastName = $user->getLastName();
        $this->email = $user->getEmail();
        $this->hasAgreed = $user->getHasAgreed();
        $this->discounts = $user->getDiscounts();
        $this->roles = $user->getRoles();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of firstName
     */ 
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Get the value of lastName
     */ 
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of hasAgreed
     */ 
    public function getHasAgreed()
    {
        return $this->hasAgreed;
    }

    /**
     * Get the value of discounts
     */ 
    public function getDiscounts()
    {
        return $this->discounts;
    }
}