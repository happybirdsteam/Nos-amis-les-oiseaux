<?php

namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AdminControllerTest extends WebTestCase
{
    private function logIn()
    {
        $client = static::createClient();
        $session = $client->getContainer()->get('session');

        $firewall = 'main';

        $token = new UsernamePasswordToken('admin', null, $firewall, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);

        return $client;
    }

    public function testAdminPage()
    {
        $client = $this->logIn();
        $client->request('GET', '/admin');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testUserManagementLink()
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/admin');
        $link = $crawler->selectLink('Gestion des utilisateurs')->link();
        $client->click($link);

        $this->assertEquals('/admin/gestion-des-utilisateurs', $client->getRequest()->getPathInfo());
    }

    public function testUserManagementPage()
    {
        $client = $this->logIn();
        $client->request('GET', '/admin/gestion-des-utilisateurs');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testValidateObservationsLink()
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/admin');
        $link = $crawler->selectLink('Valider observations')->link();
        $client->click($link);

        $this->assertEquals('/admin/gestion-observations/', $client->getRequest()->getPathInfo());
    }

    /*public function testValidateObservationsPage()
    {
        $client = $this->logIn();
        $client->request('GET', '/admin/gestion-observations/');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }*/

    public function testSeeObservationsLink()
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/admin');
        $link = $crawler->selectLink('Voir les observations')->link();
        $client->click($link);

        $this->assertEquals('/admin/voir-observations/', $client->getRequest()->getPathInfo());
    }

    /*public function testSeeObservationsPage()
    {
        $client = $this->logIn();
        $client->request('GET', '/admin/voir-observations/');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }*/

    public function testReturnToHomeLink()
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/admin');
        $link = $crawler->selectLink('Retour au site')->link();
        $client->click($link);

        $this->assertEquals('/', $client->getRequest()->getPathInfo());
    }
}