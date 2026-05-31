<?php

require_once __DIR__ . '/../../login/protege.php';
require_once __DIR__ . '/../../login/conexao.php';

$pdo = getConexao();

$id = $_GET['id'];

$sql = "DELETE FROM sessoes WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':id' => $id
]);

header("Location: index.php");
exit();

?>