<?php
require_once __DIR__ . '/../../login/protege.php';
require_once __DIR__ . '/../../login/conexao.php';

$pdo = getConexao();

$sql = "SELECT sessoes.*, filmes.nome AS nome_filme
        FROM sessoes
        INNER JOIN filmes ON sessoes.filme_id = filmes.id";

$stmt = $pdo->query($sql);

$sessoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT COUNT(*) AS total FROM sessoes";

$stmt = $pdo->query($sql);

$totalSessoes = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessões - Cinema Control</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-black text-white flex min-h-screen">

    <aside class="w-60 min-h-screen bg-[#050505] border-r border-zinc-900 flex flex-col justify-between p-5">
        <div>
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-11 h-11 rounded-xl bg-orange-500/10 border border-orange-500/30 flex items-center justify-center shadow-[0_0_20px_rgba(249,115,22,0.25)]">
                        <i data-lucide="clapperboard" class="w-7 h-7 text-orange-400"></i>
                    </div>

                    <h1 class="text-2xl font-bold leading-tight">
                        <span class="text-orange-500">Cinema</span><br>
                        Control
                    </h1>
                </div>

                <p class="text-zinc-500 text-sm">Painel administrativo</p>
            </div>

            <nav class="space-y-3">
                <a href="../painel/index.php" class="flex items-center gap-3 text-zinc-200 hover:text-orange-400 hover:bg-orange-500/10 px-4 py-3 rounded-2xl transition">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    <span class="text-sm">Painel</span>
                </a>

                <a href="../filmes/index.php" class="flex items-center gap-3 text-zinc-200 hover:text-orange-400 hover:bg-orange-500/10 px-4 py-3 rounded-2xl transition">
                    <i data-lucide="film" class="w-5 h-5"></i>
                    <span class="text-sm">Filmes</span>
                </a>

                <a href="../sessoes/index.php" class="flex items-center gap-3 bg-orange-500/10 text-orange-400 px-4 py-3 rounded-2xl border border-orange-500/20 shadow-[0_0_20px_rgba(249,115,22,0.12)]">
                    <i data-lucide="clock-3" class="w-5 h-5"></i>
                    <span class="text-sm font-medium">Sessões</span>
                </a>

                <a href="../ingressos/index.php" class="flex items-center gap-3 text-zinc-200 hover:text-orange-400 hover:bg-orange-500/10 px-4 py-3 rounded-2xl transition">
                    <i data-lucide="ticket" class="w-5 h-5"></i>
                    <span class="text-sm">Ingressos</span>
                </a>
            </nav>
        </div>

        <a href="../../login/logout.php" class="flex items-center gap-3 text-red-400 hover:bg-red-500/10 px-4 py-3 rounded-2xl transition">
            <i data-lucide="log-out" class="w-5 h-5"></i>
            <span class="text-sm">Sair</span>
        </a>
    </aside>

    <main class="flex-1 p-8">

        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 rounded-2xl bg-orange-500/10 border border-orange-500/30 flex items-center justify-center shadow-[0_0_25px_rgba(249,115,22,0.18)]">
                    <i data-lucide="clock-3" class="w-9 h-9 text-orange-400"></i>
                </div>

                <div>
                    <h1 class="text-4xl font-bold">Sessões</h1>
                    <p class="text-zinc-400 mt-1">
                        Gerencie as sessões cadastradas no Cinema Control
                    </p>
                </div>
            </div>

            <a href="cadastrar.php" class="bg-orange-500 hover:bg-orange-600 transition px-6 py-4 rounded-2xl font-semibold shadow-[0_0_25px_rgba(249,115,22,0.18)]">
                + Cadastrar Sessão
            </a>
        </div>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-7">
            <div class="bg-[#101014] border border-zinc-900 rounded-3xl p-6">
                <div class="w-14 h-14 rounded-full bg-orange-500/10 flex items-center justify-center mb-4">
                    <i data-lucide="calendar-clock" class="w-7 h-7 text-orange-400"></i>
                </div>

                <p class="text-zinc-400 text-sm">Total de sessões</p>

                <h2 class="text-4xl font-bold text-orange-500 mt-1">
                    <?php echo $totalSessoes; ?>
                </h2>
            </div>
        </section>

        <div class="bg-[#101014] border border-zinc-900 rounded-3xl overflow-hidden">

            <table class="w-full">

                <thead class="bg-zinc-900/80">
                    <tr>
                        <th class="text-left p-5 text-zinc-400">ID</th>
                        <th class="text-left p-5 text-zinc-400">Filme</th>
                        <th class="text-left p-5 text-zinc-400">Data</th>
                        <th class="text-left p-5 text-zinc-400">Horário</th>
                        <th class="text-left p-5 text-zinc-400">Sala</th>
                        <th class="text-left p-5 text-zinc-400">Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach($sessoes as $sessao): ?>

                        <tr class="border-t border-zinc-900 hover:bg-zinc-900/50 transition">

                            <td class="p-5 text-zinc-300">
                                <?php echo $sessao['id']; ?>
                            </td>

                            <td class="p-5 font-medium">
                                <div class="flex items-center gap-3">
                                    <span class="w-2 h-2 rounded-full bg-orange-500"></span>

                                    <?php echo htmlspecialchars($sessao['nome_filme']); ?>
                                </div>
                            </td>

                            <td class="p-5 text-zinc-300">
                                <?php echo date('d/m/Y', strtotime($sessao['data'])); ?>
                            </td>

                            <td class="p-5">
                                <span class="bg-orange-500/15 text-orange-400 border border-orange-500/30 px-4 py-2 rounded-xl text-sm font-semibold">
                                    <?php echo date('H:i', strtotime($sessao['horario'])); ?>
                                </span>
                            </td>

                            <td class="p-5 text-zinc-300">
                                <?php echo htmlspecialchars($sessao['sala']); ?>
                            </td>

                            <td class="p-5">
                                <div class="flex gap-3">

                                    <a href="editar.php?id=<?php echo $sessao['id']; ?>" class="w-10 h-10 flex items-center justify-center rounded-xl border border-orange-500/30 text-orange-400 hover:bg-orange-500/10 transition">
                                        <i data-lucide="pencil" class="w-5 h-5"></i>
                                    </a>

                                    <a href="delete.php?id=<?php echo $sessao['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')" class="w-10 h-10 flex items-center justify-center rounded-xl border border-red-500/30 text-red-400 hover:bg-red-500/10 transition">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </a>

                                </div>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </main>

    <script>
        lucide.createIcons();
    </script>

</body>
</html>