<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthenticationFrontControllerFunctionnalTests extends WebTestCase
{
    /**
     * @test
     */
    public function testLoginPageIsUp()
    {
        // HTTP CLIENT CREATION
        $client = static::createClient();

        // Get of request
        $client->request('GET', '/login');

        // Assertions for verify id response have good status code
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @test
     */
    public function testIfLoginPageHaveGoodElements()
    {
        // HTTP CLIENT CREATION
        $client = static::createClient();

        // Insert request into crawler which have for goal to allow us to browse DOM elements
        $crawler = $client->request('GET', '/login');

        // Assertions for verify if wiew contain the good element
        $this->assertSame(1, $crawler->filter('html:contains("Identification")')->count());
    }

    /**
     * @test
     */
    public function testLoginForm()
    {
        // HTTP CLIENT CREATION
        $client = static::createClient();

        // Insert request into crawler which have for goal to allow us to browse DOM elements
        $crawler = $client->request('GET', '/login');

        // Form creation
        $form = $crawler->selectButton("Se connecter")->form();

        // Filling form
        $form["_username"] = "admin@admin.fr";
        $form["_password"] = "admin";
        
        // Form submit
        $client->submit($form);

        // Insert response into crawler
        $crawler = $client->followRedirect();

        // Assertions for verify if wiew contain the good element
        $this->assertSame(1, $crawler->filter('html:contains("Administration")')->count());
        $this->assertSame(1, $crawler->filter('html:contains("API")')->count());
    }
}                                                                                                 