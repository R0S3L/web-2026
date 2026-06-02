<?php

require_once __DIR__ . '/database.php';

$method = $_SERVER['REQUEST_METHOD'];
$response = [];

if ($method !== 'GET') {
    http_response_code(405);
    $response = ['error' => 'Method not allowed. Use GET'];
} else {
    if (!isset($_GET['post_id'])) {
        http_response_code(400);
        $response = ['error' => 'Missing post_id parameter'];
    } else {
        try {
            $connection = connectDB();
            
            $post_id = (int)$_GET['post_id'];
            
            $query = "
                SELECT
                    p.id_post,
                    p.post_date,
                    p.post_image,
                    p.post_description,
                    p.post_likes,
                    p.id_user,
                    u.id_user,
                    u.user_name,
                    u.user_surname,
                    u.user_image
                FROM post AS p
                INNER JOIN user AS u ON p.id_user = u.id_user
                WHERE p.id_post = :post_id
            ";
            
            $stmt = $connection->prepare($query);
            $stmt->execute([':post_id' => $post_id]);
            $post = $stmt->fetch();
            
            if (!$post) {
                http_response_code(404);
                $response = ['error' => 'Post not found'];
            } else {
                http_response_code(200);
                $response = [
                    'success' => true,
                    'post' => [
                        'id_post' => (int)$post['id_post'],
                        'post_description' => htmlspecialchars($post['post_description'] ?? '', ENT_QUOTES, 'UTF-8'),
                        'post_image' => htmlspecialchars($post['post_image'] ?? '', ENT_QUOTES, 'UTF-8'),
                        'post_likes' => (int)$post['post_likes'],
                        'id_user' => (int)$post['id_user'],
                        'user_name' => htmlspecialchars($post['user_name'], ENT_QUOTES, 'UTF-8'),
                        'user_surname' => htmlspecialchars($post['user_surname'], ENT_QUOTES, 'UTF-8')
                    ]
                ];
            }
        } catch (PDOException $e) {
            http_response_code(500);
            $response = ['error' => 'Database error: ' . $e->getMessage()];
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);
