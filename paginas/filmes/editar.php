<?php
require_once __DIR__ . '/../../login/protege.php';
require_once __DIR__ . '/../../login/conexao.php';

$pdo = getConexao();

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM filmes WHERE id = :id");
$stmt->execute([':id' => $id]);
$filme = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$filme) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $genero = $_POST['genero'];
    $classificacao = $_POST['classificacao'];

    $stmt = $pdo->prepare("
        UPDATE filmes
        SET nome = :nome,
            genero = :genero,
            classificacao = :classificacao
        WHERE id = :id
    ");

    $stmt->execute([
        ':nome' => $nome,
        ':genero' => $genero,
        ':classificacao' => $classificacao,
        ':id' => $id
    ]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filme</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black text-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-2xl bg-zinc-900 border border-zinc-800 rounded-3xl p-8">

        <h1 class="text-4xl font-bold mb-8 text-orange-500">
            Editar Filme
        </h1>

        <form method="POST" class="space-y-6">

            <!-- NOME -->
            <div>

                <label class="block mb-2 text-zinc-400">
                    Nome
                </label>

                <input
                    type="text"
                    name="nome"
                    value="<?= $filme['nome'] ?>"

                    class="w-full bg-zinc-800 border border-zinc-700 rounded-2xl px-5 py-4 outline-none focus:border-orange-500"
                >

            </div>

            <!-- GENERO -->
            <div>

                <label class="block mb-2 text-zinc-400">
                    Gênero
                </label>

                <input
                    type="text"
                    name="genero"
                    value="<?= $filme['genero'] ?>"

                    class="w-full bg-zinc-800 border border-zinc-700 rounded-2xl px-5 py-4 outline-none focus:border-orange-500"
                >

            </div>

            <!-- CLASSIFICACAO -->
            <div>

                <label class="block mb-2 text-zinc-400">
                    Classificação
                </label>

                <input
                    type="text"
                    name="classificacao"
                    value="<?= $filme['classificacao'] ?>"

                    class="w-full bg-zinc-800 border border-zinc-700 rounded-2xl px-5 py-4 outline-none focus:border-orange-500"
                >

            </div>

            <!-- BOTÕES -->
            <div class="flex gap-4 pt-4">

                <button
                    type="submit"

                    class="bg-orange-500 hover:bg-orange-600 transition px-8 py-4 rounded-2xl font-semibold"
                >
                    Atualizar
                </button>

                <a
                    href="index.php"

                    class="bg-zinc-700 hover:bg-zinc-600 transition px-8 py-4 rounded-2xl font-semibold"
                >
                    Voltar
                </a>
            </div>
        </form>
    </div>
</body>
</html>