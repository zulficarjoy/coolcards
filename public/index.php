<?php

require '../src/config/database.php';
require '../src/api/BlogController.php';

$db = getDbConnection();
$controller = new BlogController($db);

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

$apiKey = getenv('API_KEY');
$providedApiKey = $_SERVER['HTTP_API_KEY'] ?? '';

if ($apiKey !== $providedApiKey) {
    http_response_code(403);
    echo json_encode(['error' => 'Forbidden: Invalid API Key']);
    exit;
}

switch ($method) {
    case 'GET':
        if ($path === '/posts') {
            echo json_encode($controller->getPosts());
        }
        break;
    case 'POST':
        if ($path === '/posts') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller->createPost($data['title'], $data['content']);
        }
        break;
    case 'PUT':
        if (preg_match('/\/posts\/(\d+)/', $path, $matches)) {
            $id = $matches[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $controller->updatePost($id, $data['title'], $data['content']);
        }
        break;
    case 'DELETE':
        if (preg_match('/\/posts\/(\d+)/', $path, $matches)) {
            $id = $matches[1];
            $controller->deletePost($id);
        }
        break;
    default:
        http_response_code(405);
        break;
}
?> 