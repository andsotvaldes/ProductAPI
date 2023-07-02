<?php

namespace Tests\Controllers;

use App\Domain\Entities\Product;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetProductsControllerTest extends WebTestCase
{

    public function testGetProducts()
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/v1/products',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse()->getContent();

        $this->assertJson($response);

        $responseArray = json_decode($response,true);

        $this->assertNotEquals(0,count($responseArray['data']['items']));

    }

    public function testGetProductsOnly1Product()
    {
        $client = static::createClient();

        $params = [
            'pageSize' => 1
        ];

        $client->request(
            'GET',
            '/v1/products',
            $params,
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse()->getContent();

        $this->assertJson($response);

        $responseArray = json_decode($response,true);

        $this->assertEquals(1,count($responseArray['data']['items']));
        $this->assertEquals(100,$responseArray['data']['totalItems']);
    }
    public function testGetProductsByCurrentPage()
    {
        $client = static::createClient();

        $currentPage = 2;

        $params = [
            'currentPage' => $currentPage
        ];

        $client->request(
            'GET',
            '/v1/products',
            $params,
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse()->getContent();

        $this->assertJson($response);

        $responseArray = json_decode($response,true);

        $this->assertEquals($currentPage,$responseArray['data']['currentPage']);
    }
    public function testGetProductsFilterByName()
    {
        $client = static::createClient();

        $name = 'ProductName';

        $params = [
            'name' => $name
        ];

        $client->request(
            'GET',
            '/v1/products',
            $params,
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse()->getContent();

        $this->assertJson($response);

        $responseArray = json_decode($response,true);

        $this->assertTrue(isset($responseArray['data']['items']) && isset($responseArray['data']['items'][0]));
        $this->assertStringContainsString($name,$responseArray['data']['items'][0]['name']);
    }

    public function testGetProductsFilterByName2()
    {
        $client = static::createClient();

        $name = '1';

        $params = [
            'name' => $name
        ];

        $client->request(
            'GET',
            '/v1/products',
            $params,
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse()->getContent();

        $this->assertJson($response);

        $responseArray = json_decode($response,true);

        $this->assertTrue(isset($responseArray['data']['items']) && isset($responseArray['data']['items'][0]));
        $this->assertStringContainsString($name,$responseArray['data']['items'][0]['name']);
    }

    public function testGetProductsFilterByName3()
    {
        $client = static::createClient();

        $name = '10';

        $params = [
            'name' => $name
        ];

        $client->request(
            'GET',
            '/v1/products',
            $params,
            [],
            ['CONTENT_TYPE' => 'application/json']
        );

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse()->getContent();

        $this->assertJson($response);

        $responseArray = json_decode($response,true);

        $this->assertTrue(isset($responseArray['data']['items']) && isset($responseArray['data']['items'][0]));
        $this->assertStringContainsString($name,$responseArray['data']['items'][0]['name']);
    }
}
