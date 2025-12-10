<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\UserRepository;

header('Content-Type: application/json');


header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_URI'] === '/users' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $repository = new UserRepository();
        $users = $repository->getAllUsers();
        
        $usersArray = array_map(fn($user) => $user->toArray(), $users);
        
        echo json_encode([
            'success' => true,
            'users' => $usersArray,
            'total' => count($users)
        ]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
} else {
    http_response_code(404);
    echo json_encode(['success' => false, 'error' => 'Not Found']);
}