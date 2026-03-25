<?php
declare(strict_types=1);

// Разрешаем только POST-запросы
$method = $_SERVER['REQUEST_METHOD'] ?? '';
if ($method !== 'POST') {
    http_response_code(405);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Method not allowed'], JSON_THROW_ON_ERROR);
    exit;
}

//Заголовок
header('Content-Type: application/json');

try {
    $rawInput = file_get_contents('php://input');
    $data = json_decode($rawInput, true, 512, JSON_THROW_ON_ERROR);
    
    // Валидация входных данных
    if (
        !isset($data['image'], $data['filename']) ||
        !is_string($data['image']) ||
        !is_string($data['filename'])
    ) {
        throw new InvalidArgumentException('Invalid request payload');
    }
    
    // Декодируем base64-изображение
    $imageData = base64_decode($data['image'], true);
    if ($imageData === false) {
        throw new RuntimeException('Failed to decode image data');
    }
    
    // Санитизация имени файла
    $filename = preg_replace('/[^a-zA-Z0-9_\.\-]/', '_', $data['filename']);
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    // Проверка разрешённых расширений
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($extension, $allowedExtensions, true)) {
        throw new InvalidArgumentException('Unsupported file extension');
    }
    
    // Формируем путь сохранения
    $uploadDir = __DIR__ . '/static/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $filepath = $uploadDir . basename($filename);
    
    // Сохраняем файл
    if (file_put_contents($filepath, $imageData) === false) {
        throw new RuntimeException('Failed to save file');
    }
    
    // Успешный ответ
    echo json_encode([
        'success' => true,
        'filepath' => '/static/uploads/' . basename($filename),
        'timestamp' => time(), // дата в формате timestamp
    ], JSON_THROW_ON_ERROR);
    
} catch (Throwable $e) {
    http_response_code(400);
    echo json_encode([
        'error' => $e->getMessage(),
        'timestamp' => time(),
    ], JSON_THROW_ON_ERROR);
}

