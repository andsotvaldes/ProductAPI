<?php

namespace Tests\Controllers;

use App\Domain\Entities\Product;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginControllerTest extends WebTestCase
{

    public function testLoginSucessfull()
    {
        $client = static::createClient();

        $dataLogin = [
          'username' => 'admin@admin.com',
          'password' => 'admin@admin.com',
        ];

        $client->request(
            'POST',
            '/v1/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($dataLogin)
        );

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse()->getContent();

        $this->assertJson($response);

        $responseArray = json_decode($response,true);

        $this->assertTrue(isset($responseArray['token']) && !empty(isset($responseArray['token'])));

    }

    public function testInvalidCredentials()
    {
        $client = static::createClient();

        $dataLogin = [
            'username' => 'noexist@admin.com',
            'password' => 'nopasswor',
        ];

        $client->request(
            'POST',
            '/v1/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($dataLogin)
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }
}
