<?php
use App\User;

test('user created', function () {
    $user = new User('Test Test', 'test@test.com');
    
    expect($user)->toBeInstanceOf(User::class)
        ->and($user->getFullName())->toBe('Test Test');
});

test('user full name', function () {
    $user = new User('Test Test', 'test@test.com');
    
    expect($user->getFullName())->toBe('Test Test');
});