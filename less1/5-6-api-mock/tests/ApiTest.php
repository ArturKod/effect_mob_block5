<?php

use PHPUnit\Framework\TestCase;
use App\UserRepository;

require_once __DIR__ . '/../vendor/autoload.php';

class ApiTest extends TestCase
{
    public function testUserApiReturnsUsers()
    {
        $repository = new UserRepository();
        $users = $repository->getAllUsers();
        
        $this->assertIsArray($users);
        
        $this->assertNotEmpty($users);
        
        $firstUser = $users[0];
        $this->assertInstanceOf(\App\User::class, $firstUser);
        $this->assertIsInt($firstUser->id);
        $this->assertIsString($firstUser->name);
        $this->assertIsString($firstUser->email);
        
        $userArray = $firstUser->toArray();
        $this->assertArrayHasKey('id', $userArray);
        $this->assertArrayHasKey('name', $userArray);
        $this->assertArrayHasKey('email', $userArray);
        $this->assertArrayNotHasKey('password', $userArray);
    }
}