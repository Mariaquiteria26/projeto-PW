<?php

define('DB_HOST',    'localhost');
define('DB_NOME',    'cinema');
define('DB_USUARIO', 'root');
define('DB_SENHA',   '');
define('DB_CHARSET', 'utf8mb4');

function getConexao(): PDO
{
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NOME . ";charset=" . DB_CHARSET;

    $opcoes = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $pdo = new PDO($dsn, DB_USUARIO, DB_SENHA, $opcoes);
        return $pdo;

    } catch (PDOException $e) {
        die("Erro de conexão com o banco de dados: " . $e->getMessage());
    }
}