<?php
require_once __DIR__ . '/../../login/protege.php';
require_once __DIR__ . '/../../login/conexao.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $genero = $_POST['genero'];
    $classificacao = $_POST['classificacao'];

    $sql = "INSERT INTO filmes (nome, genero, classificacao)
        VALUES (:nome, :genero, :classificacao)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nome' => $_POST['nome'],
        ':genero' => $_POST['genero'],
        ':classificacao' => $_POST['classificacao']
    ]);

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Filme</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-black text-white min-h-screen flex items-center justify-center p-10">

    <div class="w-full max-w-xl bg-[#101014] border border-zinc-800 rounded-3xl p-10 shadow-2xl">

        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 rounded-2xl bg-orange-500/10 border border-orange-500/30 flex items-center justify-center">
                <i data-lucide="film" class="w-8 h-8 text-orange-400"></i>
            </div>

            <div>
                <h1 class="text-3xl font-bold">Cadastrar Filme</h1>
                <p class="text-zinc-400 text-sm">Preencha as informações do novo filme</p>
            </div>
        </div>

        <form method="POST" class="space-y-5">

            <div>
                <label class="block mb-2 text-zinc-300">Nome do Filme</label>
                <input type="text" name="nome" required
                    class="w-full bg-zinc-900 border border-zinc-700 rounded-2xl px-5 py-4 outline-none focus:border-orange-500">
            </div>

            <div>
                <label class="block mb-2 text-zinc-300">Gênero</label>
                <input type="text" name="genero" required
                    class="w-full bg-zinc-900 border border-zinc-700 rounded-2xl px-5 py-4 outline-none focus:border-orange-500">
            </div>

            <div>
                <label class="block mb-2 text-zinc-300">Classificação</label>
                <select name="classificacao"
                    class="w-full bg-zinc-900 border border-zinc-700 rounded-2xl px-5 py-4 outline-none focus:border-orange-500">
                    <option>Livre</option>
                    <option>10+</option>
                    <option>12+</option>
                    <option>14+</option>
                    <option>16+</option>
                    <option>18+</option>
                </select>
            </div>

            <div class="flex justify-between gap-4 pt-4">
                <a href="index.php"
                    class="bg-zinc-800 hover:bg-zinc-700 transition px-8 py-4 rounded-2xl font-semibold">
                    ← Voltar
                </a>

                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 transition px-8 py-4 rounded-2xl font-semibold">
                    Cadastrar Filme
                </button>
            </div>

        </form>
    </div>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>