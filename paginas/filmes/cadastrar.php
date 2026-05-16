<?php
require_once __DIR__ . '/../../login/protege.php';
require_once __DIR__ . '/../../login/conexao.php';

$pdo = getConexao();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $genero = $_POST['genero'];
    $classificacao = $_POST['classificacao'];

    $stmt = $pdo->prepare("
        INSERT INTO filmes (nome, genero, classificacao)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([
        $nome,
        $genero,
        $classificacao
    ]);

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Filme</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-black text-white min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-2xl bg-[#101014] border border-zinc-900 rounded-3xl p-8">

        <h1 class="text-4xl font-bold mb-8">
             Cadastrar Filme
        </h1>

        <form method="POST" class="space-y-6">

            <!-- NOME -->
            <div>
                <label class="block mb-2 text-zinc-400">
                    Nome do filme
                </label>

                <input
                    type="text"
                    name="nome"
                    required

                    class="w-full bg-zinc-900 border border-zinc-800 rounded-2xl px-5 py-4 outline-none focus:border-orange-500"
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
                    required

                    class="w-full bg-zinc-900 border border-zinc-800 rounded-2xl px-5 py-4 outline-none focus:border-orange-500"
                >
            </div>

            <!-- CLASSIFICACAO -->
            <div>
                <label class="block mb-2 text-zinc-400">
                    Classificação
                </label>

                <select
                    name="classificacao"

                    class="w-full bg-zinc-900 border border-zinc-800 rounded-2xl px-5 py-4 outline-none focus:border-orange-500"
                >

                    <option>Livre</option>
                    <option>10+</option>
                    <option>12+</option>
                    <option>14+</option>
                    <option>16+</option>
                    <option>18+</option>

                </select>
            </div>

            <!-- BOTÕES -->
            <div class="flex gap-4 pt-4">

                <button
                    type="submit"

                    class="bg-orange-500 hover:bg-orange-600 transition px-8 py-4 rounded-2xl font-semibold"
                >

                    Cadastrar
                </button>

                <a
                    href="index.php"

                    class="bg-zinc-800 hover:bg-zinc-700 transition px-8 py-4 rounded-2xl font-semibold"
                >

                    Voltar
                </a>

            </div>

        </form>

    </div>

</body>
</html>