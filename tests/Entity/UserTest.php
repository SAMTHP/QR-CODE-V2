<?php
namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        $this->user = new User();
    }

    /**
     * @test
     */
    public function userShouldHaveLastName()
    {
        $this->user->setLastname("nametest");
        
        $this->assertEquals("nametest", $this->user->getLastname());
    }

    /**
     * @test
     */
    public function userShouldHaveFirstName()
    {
        $this->user->setFirstName("firsttest");
        
        $this->assertEquals("firsttest", $this->user->getFirstName());
    }

    /**
     * @test
     */
    public function userShouldHaveEmail()
    {
        $this->user->setEmail("test@test.fr");
        
        $this->assertEquals("test@test.fr", $this->user->getEmail());
    }

    /**
     * @test
     */
    public function userShouldHavePassword()
    {
        $this->user->setPassword("pass");
        
        $this->assertEquals("pass", $this->user->getPassword());
    }
}