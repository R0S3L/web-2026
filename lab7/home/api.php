<?php

function connectDatabase(): PDO {
    try {
        $pdo = new PDO(
            'mysql:host=localhost;dbname=blog;charset=utf8mb4',
            'root',
            ''
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database connection failed']);
        exit;
    }
}

$method = $_SERVER['REQUEST_METHOD'];
$errorCheck = FALSE;
$response = [];

if ($method !== 'POST') {
    http_response_code(405);
    $response = ['error' => 'Method not allowed. Use POST'];
    $errorCheck = TRUE;
}

if (!$errorCheck) {
    if (!isset($_POST['data'])) {
        http_response_code(400);
        $response = ['error' => 'Missing data field'];
        $errorCheck = TRUE;
    }
}

if (!$errorCheck) {
    $data = json_decode($_POST['data'], true);
    
    if (!$data) {
        http_response_code(400);
        $response = ['error' => 'Invalid JSON data'];
        $errorCheck = TRUE;
    }
}

if (!$errorCheck) {
    if (empty($data['user_id']) || empty($data['description'])) {
        http_response_code(400);
        $response = ['error' => 'Missing required fields: user_id and description'];
        $errorCheck = TRUE;
    }
}

if (!$errorCheck) {
    if (!isset($_FILES['post_image']) || $_FILES['post_image']['error'] === UPLOAD_ERR_NO_FILE) {
        http_response_code(400);
        $response = ['error' => 'Missing post_image file'];
        $errorCheck = TRUE;
    }
}

if (!$errorCheck) {
    $image = $_FILES['post_image'];
    
    if ($image['error'] !== UPLOAD_ERR_OK) {
        http_response_code(400);
        $response = ['error' => 'File upload error: ' . $image['error']];
        $errorCheck = TRUE;
    }
}

if (!$errorCheck) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $image['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mimeType, $allowedTypes)) {
        http_response_code(400);
        $response = ['error' => 'Invalid file type. Allowed: JPEG, PNG, GIF, WEBP'];
        $errorCheck = TRUE;
    }
}

if (!$errorCheck) {
    $maxSize = 5 * 1024 * 1024;
    if ($image['size'] > $maxSize) {
        http_response_code(400);
        $response = ['error' => 'File too large. Max size: 5MB'];
        $errorCheck = TRUE;
    }
}

if (!$errorCheck) {
    // Получаем расширение файла
    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    // Генерируем уникальное имя файла
    $imageName = uniqid('img_') . '_' . time() . '.' . $extension;
    
    // Путь для сохранения файла на сервере
    $uploadDir = '../images/';
    $imagePath = $uploadDir . $imageName;
    
    // В БД сохраняем ТОЛЬКО имя файла (не полный путь)
    $dbImagePath = $imageName; // Просто имя файла
    
    // Создаем директорию если не существует
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    // Перемещаем загруженный файл
    if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
        http_response_code(500);
        $response = ['error' => 'Failed to save uploaded file'];
        $errorCheck = TRUE;
    }
}

if (!$errorCheck) {
    try {
        $connection = connectDatabase();
        
        $checkUserQuery = "SELECT id_user FROM user WHERE id_user = :user_id";
        $checkStmt = $connection->prepare($checkUserQuery);
        $checkStmt->execute([':user_id' => $data['user_id']]);
        
        if (!$checkStmt->fetch()) {
            http_response_code(404);
            $response = ['error' => 'User not found'];
            $errorCheck = TRUE;
        }
    } catch (PDOException $e) {
        http_response_code(500);
        $response = ['error' => 'Database error: ' . $e->getMessage()];
        $errorCheck = TRUE;
    }
}

if (!$errorCheck) {
    try {
        $connection = connectDatabase();
        
        $query = "
            INSERT INTO post (
                id_user,
                post_image,
                post_description,
                post_likes,
                post_date
            ) VALUES (
                :user_id,
                :post_image,
                :description,
                :like_amount,
                NOW()
            )
        ";
        
        $statement = $connection->prepare($query);
        
        $likeAmount = isset($data['like_amount']) ? (int)$data['like_amount'] : 0;
        
        $result = $statement->execute([
            ':user_id' => (int)$data['user_id'],
            ':post_image' => $dbImagePath, // Сохраняем только имя файла
            ':description' => htmlspecialchars($data['description'], ENT_QUOTES, 'UTF-8'),
            ':like_amount' => $likeAmount
        ]);
        
        if ($result) {
            $postId = $connection->lastInsertId();
            http_response_code(201);
            $response = [
                'success' => true,
                'message' => 'Post created successfully',
                'post_id' => $postId,
                'image_filename' => $imageName,
                'image_url' => '/images/' . $imageName // Для доступа через веб
            ];
        } else {
            http_response_code(500);
            $response = ['error' => 'Failed to create post'];
        }
        
    } catch (PDOException $e) {
        http_response_code(500);
        $response = ['error' => 'Database error: ' . $e->getMessage()];
    }
}

header('Content-Type: application/json');
echo json_encode($response);