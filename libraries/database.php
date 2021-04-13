<?php

/**
 * Retourne une connexion
 *
 * @return PDO
 */
function getPdo(): PDO
{
    $pdo = new PDO(
        'mysql:host=localhost;dbname=blogpoo;charset=utf8',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    return $pdo;
}

/**
 * @return array
 */
function findAllArticles(): array
{
    $pdo = getPdo();
    $resultats = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
    // On fouille le résultat pour en extraire les données réelles
    $articles = $resultats->fetchAll();
    return $articles;
}

/**
 * @return array
 */
function findArticle(int $id)
{
    $pdo = getPdo();
    $query = $pdo->prepare('SELECT * FROM articles WHERE id = :article_id');

    // On exécute la requête en précisant le paramètre :article_id
    $query->execute(['article_id' => $id]);

    // On fouille le résultat pour en extraire les données réelles de l'article
    $article = $query->fetch();

    return $article;
}

/**
 * @return array
 */
function findAllComments(int $article_id): array
{
    $pdo = getPdo();
    $query = $pdo->prepare(
        'SELECT * FROM comments WHERE article_id = :article_id'
    );
    $query->execute(['article_id' => $article_id]);
    $commentaires = $query->fetchAll();

    return $commentaires;
}

function deleteArticle(int $id)
{
    $pdo = getPdo();
    $query = $pdo->prepare('DELETE FROM articles WHERE id = :id');
    $query->execute(['id' => $id]);
}

function findComment($id)
{
    $pdo = getPdo();
    $query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
    $query->execute(['id' => $id]);
    $comment = $query->fetch();

    return $comment;
}

function deleteComment($id)
{
    $pdo = getPdo();
    $query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
    $query->execute(['id' => $id]);
}

function insertComment(string $author, string $content, int $article_id)
{
    $pdo = getPdo();
    $query = $pdo->prepare(
        'INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()'
    );
    $query->execute(compact('author', 'content', 'article_id'));
}