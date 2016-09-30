<?php

namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class HomeControllerTest extends WebTestCase
{
    public function testHomePage()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testObservationsLink()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('Consulter les observations')->link();
        $client->click($link);

        $this->assertEquals('/observations/', $client->getRequest()->getPathInfo());
    }

    /*public function testMyObservationsLink()
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('Consulter mes observations')->link();
        $client->click($link);

        $this->assertEquals('/observations/mesObservations/3', $client->getRequest()->getPathInfo());
    }*/

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
}