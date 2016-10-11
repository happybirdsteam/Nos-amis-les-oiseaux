<?php

namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserManagementTest extends WebTestCase
{
    public function testRegistrationLink()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('Inscription')->link();
        $client->click($link);

        $this->assertEquals('/register/', $client->getRequest()->getPathInfo());
    }

    public function testConnexionLink()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('Connexion')->link();
        $client->click($link);

        $this->assertEquals('/login', $client->getRequest()->getPathInfo());
    }

    public function testFormConnexion()
    {
        $client = static::createClient(array('debug' => true, 'environment' => 'test'), array(
            'HTTP_HOST' => 'localhost'
        ));
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Connexion')->form(array(
            '_username' => 'admin',
            '_password' => 0000,
        ));
        $client->submit($form);
        $client->followRedirect();

        $this->assertEquals('fos_user_security_login', $client->getRequest()->attributes->get('_route'));
    }
}