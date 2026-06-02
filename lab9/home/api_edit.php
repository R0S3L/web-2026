<?php

require_once __DIR__ . '/database.php';

$method = $_SERVER['REQUEST_METHOD'];
$response = [];
$errorCheck = FALSE;

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
    if (empty($data['post_id']) || empty($data['user_id']) || empty($data['description'])) {
        http_response_code(400);
        $response = ['error' => 'Missing required fields: post_id, user_id, and description'];
        $errorCheck = TRUE;
    }
}

if (!$errorCheck) {
    try {
        $connection = connectDB();
        
        // Check if post exists and belongs to user
        $checkQuery = "SELECT id_post, id_user FROM post WHERE id_post = :post_id";
        $checkStmt = $connection->prepare($checkQuery);
        $checkStmt->execute([':post_id' => (int)$data['post_id']]);
        $post = $checkStmt->fetch();
        
        if (!$post) {
            http_response_code(404);
            $response = ['error' => 'Post not found'];
            $errorCheck = TRUE;
        } elseif ((int)$post['id_user'] !== (int)$data['user_id']) {
            http_response_code(403);
            $response = ['error' => 'Unauthorized: you cannot edit this post'];
            $errorCheck = TRUE;
        }
    } catch (PDOException $e) {
        http_response_code(500);
        $response = ['error' => 'Database error: ' . $e->getMessage()];
        $errorCheck = TRUE;
    }
}

// Handle image upload if provided
$newImageName = null;
if (!$errorCheck && isset($_FILES['post_image']) && $_FILES['post_image']['error'] !== UPLOAD_ERR_NO_FILE) {
    $image = $_FILES['post_image'];
    
    if ($image['error'] !== UPLOAD_ERR_OK) {
        http_response_code(400);
        $response = ['error' => 'File upload error: ' . $image['error']];
        $errorCheck = TRUE;
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
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $newImageName = uniqid('img_') . '_' . time() . '.' . $extension;
        
        $uploadDir = '../images/';
        $imagePath = $uploadDir . $newImageName;
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
            http_response_code(500);
            $response = ['error' => 'Failed to save uploaded file'];
            $errorCheck = TRUE;
        }
    }
}

if (!$errorCheck) {
    try {
        $connection = connectDB();
        
        $updateFields = [
            ':post_id' => (int)$data['post_id'],
            ':description' => htmlspecialchars($data['description'], ENT_QUOTES, 'UTF-8'),
        ];
        
        $updateQuery = "UPDATE post SET post_description = :description";
        
        if ($newImageName) {
            $updateQuery .= ", post_image = :post_image";
            $updateFields[':post_image'] = $newImageName;
        }
        
        $updateQuery .= " WHERE id_post = :post_id";
        
        $statement = $connection->prepare($updateQuery);
        $result = $statement->execute($updateFields);
        
        if ($result) {
            http_response_code(200);
            $response = [
                'success' => true,
                'message' => 'Post updated successfully',
                'post_id' => (int)$data['post_id']
            ];
            
            if ($newImageName) {
                $response['image_filename'] = $newImageName;
                $response['image_url'] = '/images/' . $newImageName;
            }
        } else {
            http_response_code(500);
            $response = ['error' => 'Failed to update post'];
        }
        
    } catch (PDOException $e) {
        http_response_code(500);
        $response = ['error' => 'Database error: ' . $e->getMessage()];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
