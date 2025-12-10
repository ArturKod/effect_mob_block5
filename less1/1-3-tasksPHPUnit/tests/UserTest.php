<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testUserCanBeCreated()
    {
        $user = new User("Тестовый Пользователь", "test@example.com");
        
        $this->assertInstanceOf(User::class, $user);
    }

    public function testUserFullName()
    {
        $user = new User("Иван Иванов", "ivan@example.com");

        $this->assertEquals("Иван Иванов", $user->getFullName());
        $this->assertIsString($user->getFullName());
        $this->assertNotEmpty($user->getFullName());
    }

}