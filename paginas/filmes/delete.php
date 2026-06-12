<?php

require_once __DIR__ . '/../../login/conexao.php';


$id = $_GET['id'];

$sql = "DELETE FROM filmes WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

header("Location: index.php");
exit();

?>