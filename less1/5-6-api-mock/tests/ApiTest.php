<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;

require_once __DIR__ . '/../vendor/autoload.php';

class ApiTest extends TestCase
{
    private $httpClient;
    private $baseUrl = 'http://127.0.0.1:8000';
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->httpClient = HttpClient::create([
            'timeout' => 10,
        ]);
    }
    
    public function testUserApiReturnsUsers()
    {
        $response = $this->httpClient->request('GET', $this->baseUrl . '/users');
        
        $this->assertEquals(200, $response->getStatusCode());
        
        $headers = $response->getHeaders();
        $this->assertStringContainsString('application/json', $headers['content-type'][0]);
        
        $content = $response->getContent();
        $data = json_decode($content, true);
        
        $this->assertIsArray($data);
        $this->assertArrayHasKey('success', $data);
        $this->assertTrue($data['success'], 'API должно возвращать success: true');
        
        $this->assertArrayHasKey('users', $data);
        $this->assertArrayHasKey('total', $data);
        
        $users = $data['users'];
        
        $this->assertIsArray($users);
        $this->assertNotEmpty($users, 'Список пользователей не должен быть пустым');
        
        $firstUser = $users[0];
        $this->assertIsArray($firstUser);
        $this->assertArrayHasKey('id', $firstUser);
        $this->assertArrayHasKey('name', $firstUser);
        $this->assertArrayHasKey('email', $firstUser);
        $this->assertArrayNotHasKey('password', $firstUser);
        
        $this->assertIsInt($firstUser['id']);
        $this->assertIsString($firstUser['name']);
        $this->assertIsString($firstUser['email']);
        
        $this->assertEquals($data['total'], count($users), 
            'Количество пользователей должно совпадать с total');
    }
    
}