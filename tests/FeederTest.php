<?php

namespace Tests;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;


class FeederTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new Client([
            'base_uri' => 'http://localhost:8080/'
        ]);
    }

    /**
     * @test
     * @dataProvider routeFeedCases
     * @throws GuzzleException
    */
    public function testFeedControl($requestUri)
    {
        $response = $this->client->get($requestUri);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @return \string[][]
     */
    public function routeFeedCases(): array
    {
        return [
            ['/feed/google/json'],
            ['/feed/facebook/xml'],
            ['/feed/cimri/json'],
            ['/feed/google/xml'],
        ];
    }

    /**
     * @test
     * @dataProvider routeNotFeedCases
     * @throws GuzzleException
     */
    public function testNotFeedControl($requestUri)
    {
        $response = $this->client->request('GET', $requestUri, ['http_errors' => false]);
        $this->assertEquals(422, $response->getStatusCode());
    }

    /**
     * @return \string[][]
     */
    public function routeNotFeedCases(): array
    {
        return [
            ['/feed/akakce/json'],
            ['/feed/hepsiburada/xml'],
        ];
    }

    /**
     * @test
     * @dataProvider routeNotExportCases
     * @throws GuzzleException
     */
    public function testNotExportControl($requestUri)
    {
        $response = $this->client->request('GET', $requestUri, ['http_errors' => false]);
        $this->assertEquals(422, $response->getStatusCode());
    }

    /**
     * @return \string[][]
     */
    public function routeNotExportCases(): array
    {
        return [
            ['/feed/facebook/text'],
            ['/feed/google/test'],
        ];
    }
}
