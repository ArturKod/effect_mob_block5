<?php

use PHPUnit\Framework\TestCase;
use App\User;
use App\UserRepository;

require_once __DIR__ . '/../vendor/autoload.php';

class MockTest extends TestCase
{
    public function testFindUserByEmailIsCalled()
    {
        $userRepositoryMock = $this->createMock(UserRepository::class);
        
        $userRepositoryMock->expects($this->once())
            ->method('findUserByEmail')
            ->with('test@example.com')
            ->willReturn(null);
        
        $result = $userRepositoryMock->findUserByEmail('test@example.com');
        
        $this->assertNull($result);
    }
}