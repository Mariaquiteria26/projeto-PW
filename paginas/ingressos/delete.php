<?php

require_once __DIR__ . '/../../login/protege.php';
require_once __DIR__ . '/../../login/conexao.php';


$id = $_GET['id'];
$sql = "DELETE FROM ingressos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

header("Location: index.php");
exit();

?>