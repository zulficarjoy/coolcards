<?php

require './src/config/database.php';
require './src/api/BlogController.php';

$db = getDbConnection();
$controller = new BlogController($db);

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'] ?? '/';

// echo "<pre>";
// // print_r( $_SERVER['REQUEST_METHOD']);
// print_r( $_SERVER);
// echo "</pre>";
// exit;

$apiKey = getenv('API_KEY');
$headers = getallheaders();
$providedApiKey = $headers['API_KEY'] ?? '';

// echo $apiKey;
// echo "<br>";
// echo $providedApiKey;
// exit;

if ($apiKey !== $providedApiKey) {
    http_response_code(403);
    echo json_encode(['error' => 'Forbidden: Invalid API Key']);
    exit;
}

switch ($method) {
    case 'GET':
        if ($path === '/api/posts') {
            echo json_encode($controller->getPosts());
            exit;
        }
        echo "Cool Cards Assesments";
        break;
    case 'POST':
        if ($path === '/api/posts') {
            $data = json_decode(file_get_contents('php://input'), true);
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            // exit;
            $controller->createPost($data['title'], $data['content']);
        }
        break;
    case 'PUT':
        if (preg_match('/\/api\/posts\/(\d+)/', $path, $matches)) {
            $id = $matches[1];
            $data = json_decode(file_get_contents('php://input'), true);
            $controller->updatePost($id, $data['title'], $data['content']);
        }
        break;
    case 'DELETE':
        if (preg_match('/\/api\/posts\/(\d+)/', $path, $matches)) {
            $id = $matches[1];
            $controller->deletePost($id);
        }
        break;
    default:
        http_response_code(405);
        break;
}
?> 