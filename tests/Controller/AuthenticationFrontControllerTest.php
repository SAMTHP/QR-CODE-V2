<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccountControllerTest extends WebTestCase
{
    public function testLoginPageIsUp()
    {
        // HTTP CLIENT CREATION
        $client = static::createClient();

        // Get of request
        $client->request('GET', '/login');

        // Assertions for verify id response have good status code
        $this->assertSame(200, $client->getResponse()->getStatusCode());

        //echo $client->getResponse()->getContent();
    }

    // public function testIfLoginPageHaveGoodElements()
    // {
    //     // HTTP CLIENT CREATION
    //     $client = static::createClient();

    //     // Insert request into crawler which have for goal to allow us to browse DOM elements
    //     $crawler = $client->request('GET', '/login');

    //     // Assertions for verify if wiew contain the good element
    //     $this->assertSame(1, $crawler->filter('html:contains("Identification")')->count());
    // }

    // public function testLoginForm()
    // {
    //     // HTTP CLIENT CREATION
    //     $client = static::createClient();

    //     // Insert request into crawler which have for goal to allow us to browse DOM elements
    //     $crawler = $client->request('GET', '/login');

    //     // Form creation
    //     $form = $crawler->selectButton("Se connecter")->form();

    //     // Filling form
    //     $form["_username"] = "samir_615@live.fr";
    //     $form["_password"] = "623598741";
        
    //     // Form submit
    //     $client->submit($form);

    //     // Insert response into crawler
    //     $crawler = $client->followRedirect();

    //     // Assertions for verify if wiew contain the good element
    //     $this->assertSame(1, $crawler->filter('html:contains("Tableau de bord")')->count());
    // }

    // public function testAddNewSportHall()
    // {
    //     // HTTP CLIENT CREATION
    //     $client = static::createClient();

    //     // Insert request into crawler which have for goal to allow us to browse DOM elements
    //     $crawler = $client->request('GET', '/login');

    //     // Form creation
    //     $loginForm = $crawler->selectButton("Se connecter")->form();

    //     // Filling form
    //     $loginForm["_username"] = "samir_615@live.fr";
    //     $loginForm["_password"] = "623598741";
        
    //     // Form submit
    //     $client->submit($loginForm);

    //     // Insert response into crawler
    //     $crawler = $client->followRedirect();

    //     $link = $crawler->selectLink('Ajouter une salle de sport')->link();
    //     $crawler = $client->click($link);

    //     $addSportHallForm = $crawler->selectButton("Ajouter la salle de sport")->form();

    //     // Filling form
    //     $addSportHallForm["sport_hall[name]"] = "Salle ajouter via les tests";
    //     $addSportHallForm["sport_hall[city]"] = "Test city";
    //     $addSportHallForm["sport_hall[address]"] = "address city of test";
    //     $addSportHallForm["sport_hall[postalCode]"] = "34660";
    //     $addSportHallForm["sport_hall[photo]"] = "https://static.gymlib.com/legacy/img/gyms/hall-boxing-paris/42ef30e3-cc10-4c9a-8f9f-64619f2e779d.jpeg";

    //     // Form submit
    //     $client->submit($addSportHallForm);

    //     // Insert response into crawler
    //     $crawler = $client->followRedirect();

    //     // Assertions for verify if wiew contain the good element
    //     $this->assertSame(1, $crawler->filter('html:contains("Ajout d\'une salle de sport")')->count());

    //     // Showing of response
    //     echo $client->getResponse()->getContent();
    // }


}