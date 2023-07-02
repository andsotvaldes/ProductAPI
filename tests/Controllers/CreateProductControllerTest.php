<?php

namespace Tests\Controllers;

use App\Domain\Entities\Product;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateProductControllerTest extends WebTestCase
{

    public function testCreateProductSuccesfull()
    {
        $client = $this->createTokenLogin();

        $dataProduct = [
          'name' => 'NameTest',
          'description' => 'DescriptionTest',
          'price' => 100,
          'tax' => 10,
        ];

        $client->request(
            'POST',
            '/v1/product',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($dataProduct)
        );

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse()->getContent();

        $this->assertJson($response);
    }

    public function testCreateProductUnsuccesfull()
    {
        $client = $this->createTokenLogin();

        $dataProduct = [
            'name' => '',
            'description' => '',
            'price' => 'PriceText',
            'tax' => 99,
        ];

        $client->request(
            'POST',
            '/v1/product',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($dataProduct)
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);

        $response = $client->getResponse()->getContent();

        $this->assertJson($response);
    }

    public function testCreateProductUnsuccesfullName()
    {
        $client = $this->createTokenLogin();

        $dataProduct = [
            'name' => '',
            'description' => 'DescriptionnNameTest',
            'price' => 100,
            'tax' => 4,
        ];

        $client->request(
            'POST',
            '/v1/product',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($dataProduct)
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);

        $response = $client->getResponse()->getContent();

        $this->assertJson($response);

    }

    public function testCreateProductUnsuccesfullDescription()
    {
        $client = $this->createTokenLogin();

        $dataProduct = [
            'name' => 'NameTest',
            'description' => '',
            'price' => 100,
            'tax' => 4,
        ];

        $client->request(
            'POST',
            '/v1/product',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($dataProduct)
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);

        $response = $client->getResponse()->getContent();

        $this->assertJson($response);

    }

    public function testCreateProductUnsuccesfullPrice()
    {
        $client = $this->createTokenLogin();

        $dataProduct = [
            'name' => 'NameTest',
            'description' => 'DescriptionnNameTest',
            'price' => -100,
            'tax' => 4,
        ];

        $client->request(
            'POST',
            '/v1/product',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($dataProduct)
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);

        $response = $client->getResponse()->getContent();

        $this->assertJson($response);

    }

    public function testCreateProductUnsuccesfullTax()
    {
        $client = $this->createTokenLogin();

        $dataProduct = [
            'name' => 'NameTest',
            'description' => 'DescriptionnNameTest',
            'price' => 100,
            'tax' => 1,
        ];

        $client->request(
            'POST',
            '/v1/product',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($dataProduct)
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);

        $response = $client->getResponse()->getContent();

        $this->assertJson($response);

    }

    protected function createTokenLogin()
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

        $response = $client->getResponse()->getContent();

        $responseArray = json_decode($response,true);

        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $responseArray['token']));

        return $client;

    }
}
