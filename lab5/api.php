<?php
$method = $_SERVER['REQUEST_METHOD'];

if ($method !== 'POST') {
    http_response_code(405);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Метод не разрешен. Используйте POST']);
    exit;
}

header('Content-Type: application/json');
$input = file_get_contents('php://input');

$input = trim($input);
if (strpos($input, 'base64,') !== false) {
    $input = explode('base64,', $input)[1];
}

$imageBinary = base64_decode($input);

if ($imageBinary === false) {
    http_response_code(400);
    echo json_encode(['error' => 'Неверный формат base64']);
    exit;
}

$filepath = __DIR__ . '/static/uploads/post1.png';

if (file_put_contents($filepath, $imageBinary)) {
    echo json_encode([
        'success' => true,
        'message' => 'Изображение сохранено',
        'file' => '/static/uploads/post1.png',
    ]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Ошибка при сохранении файла']);
}
?>