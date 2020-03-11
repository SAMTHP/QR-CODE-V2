<?php
namespace tests\AppBundle\Entity;

use App\Entity\ApiRole;
use App\Entity\User;
use App\Entity\Discount;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;
    private $discount;
    private $role;

    public function setUp(): void
    {
        $this->user = new User();
        $this->discount = new Discount();
        $this->role = new ApiRole();
        $this->role->setTitle("ADMIN");
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

    /**
     * @test
     */
    public function userShouldHavePhone()
    {
        $this->user->setPhone("0606060606");
        
        $this->assertEquals("0606060606", $this->user->getPhone());
    }

    /**
     * @test
     */
    public function userShouldHaveHasAgreedAttribute()
    {
        $this->user->setHasAgreed(true);
        
        $this->assertEquals(true, $this->user->getHasAgreed());
    }

    /**
     * @test
     */
    public function userShouldHaveDiscount()
    {
        $this->user->addDiscount($this->discount);
        
        $this->assertEquals($this->discount, $this->user->getDiscounts()[0]);
    }

    /**
     * @test
     */
    public function userShouldHaveRole()
    {
        $this->user->addApiRole($this->role);
        
        $this->assertEquals($this->role->getTitle(), $this->user->getRoles()[0]);
    }
}