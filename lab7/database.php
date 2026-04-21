<?php

function connectDB(): PDO {
    $dsn = 'mysql:host=127.0.0.1; dbname=blog';
    $user = 'root';
    $password = '12345';

    return new PDO($dsn, $user, $password)
}

function findPostInDB(PDO $connection, int $id): ?array{
    $query = <<<SQL
        SELECT
            id_post, post_date, id_user, post_image, post_description, post_likes
        FROM post
        WHERE id = $id 
    SQL;
}