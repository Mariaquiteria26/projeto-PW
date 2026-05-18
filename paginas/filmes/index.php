<?php
require_once __DIR__ . '/../../login/protege.php';
require_once __DIR__ . '/../../login/conexao.php';

$pdo = getConexao();

$stmt = $pdo->query("SELECT * FROM filmes ORDER BY id DESC");
$filmes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Filmes</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-black text-white min-h-screen p-8">

    <!-- TOPO -->
    <div class="flex items-center justify-between mb-10">

        <div>
            <h1 class="text-5xl font-bold mb-2">
                 Filmes
            </h1>

            <p class="text-zinc-400">
                Lista de filmes cadastrados
            </p>
        </div>

        <a
            href="cadastrar.php"

            class="bg-orange-500 hover:bg-orange-600 transition px-6 py-4 rounded-2xl font-semibold"
        >
            + Cadastrar Filme
        </a>

    </div>

    <!-- TABELA -->
    <div class="bg-[#101014] border border-zinc-900 rounded-3xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-zinc-900">

                <tr>

                    <th class="text-left p-5 text-zinc-400">
                        ID
                    </th>

                    <th class="text-left p-5 text-zinc-400">
                        Nome
                    </th>

                    <th class="text-left p-5 text-zinc-400">
                        Gênero
                    </th>

                    <th class="text-left p-5 text-zinc-400">
                        Classificação
                    </th>
                    <th class="text-left p-5 text-zinc-400">
                          Ações
                    </th>

                </tr>

            </thead>

            <tbody>

                <?php foreach($filmes as $filme): ?>

                    <tr class="border-t border-zinc-900 hover:bg-zinc-900/40 transition">

                        <td class="p-5">
                            <?php echo $filme['id']; ?>
                        </td>

                        <td class="p-5">
                            <?php echo htmlspecialchars($filme['nome']); ?>
                        </td>

                        <td class="p-5">
                            <?php echo htmlspecialchars($filme['genero']); ?>
                        </td>

                        <td class="p-5">
                            <?php echo htmlspecialchars($filme['classificacao']); ?>
                        </td>
                        <td class="p-5">
                            <a href="editar.php?id=<?php echo $filme['id']; ?>" class="bg-blue-500 text-white px-4 py-2 rounded-xl">
                                Editar
                            </a>

                            <a href="delete.php?id=<?php echo $filme['id']; ?>" class="bg-red-500 text-white px-4 py-2 rounded-xl" onclick="return confirm('Tem certeza que deseja excluir?')">
                                Excluir
                            </a>
                        </td>  
                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</body>
</html>