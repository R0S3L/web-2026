<?php

function connectDB(): PDO
{
    $dsn = 'mysql:host=127.0.0.1;dbname=blog;charset=utf8mb4';
    $user = 'root';
    $password = '12345';

    return new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}

function findPostInDB(PDO $connection, int $id): ?array
{
    $stmt = $connection->prepare("
        SELECT
            p.id_post,
            p.post_date,
            p.post_image,
            p.post_description,
            p.post_likes,
            u.id_user,
            u.user_name,
            u.user_surname,
            u.user_image
        FROM post AS p
        INNER JOIN user AS u ON p.id_user = u.id_user
        WHERE p.id_post = :id
        LIMIT 1
    ");

    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();

    return $row !== false ? $row : null;
}

function formatPostDate($dateString) {
    return date('d.m.Y H:i', strtotime($dateString));
}

