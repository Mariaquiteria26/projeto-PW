<?php
require_once __DIR__ . '/../../login/protege.php';
require_once __DIR__ . '/../../login/conexao.php';

$pdo = getConexao();

$sql = "SELECT COUNT(*) AS total FROM filmes";
$stmt = $pdo->query($sql);
$totalFilmes = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

$sql = "SELECT * FROM filmes ORDER BY id DESC LIMIT 3";
$stmt = $pdo->query($sql);
$filmesEmCartaz = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT COUNT(*) AS total FROM sessoes";
$stmt = $pdo->query($sql);
$totalSessoes = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Control</title>

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
                <a href="../painel/index.php" class="flex items-center gap-3 bg-orange-500/10 text-orange-400 px-4 py-3 rounded-2xl border border-orange-500/20 shadow-[0_0_20px_rgba(249,115,22,0.12)]">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    <span class="text-sm font-medium">Painel</span>
                </a>

                <a href="../filmes/index.php" class="flex items-center gap-3 text-zinc-200 hover:text-orange-400 hover:bg-orange-500/10 px-4 py-3 rounded-2xl transition">
                    <i data-lucide="film" class="w-5 h-5"></i>
                    <span class="text-sm">Filmes</span>
                </a>

                <a href="../sessoes/index.php" class="flex items-center gap-3 text-zinc-200 hover:text-orange-400 hover:bg-orange-500/10 px-4 py-3 rounded-2xl transition">
                    <i data-lucide="clock-3" class="w-5 h-5"></i>
                    <span class="text-sm">Sessões</span>
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
        <section class="relative overflow-hidden bg-[#101014] border border-zinc-900 rounded-3xl p-8 mb-7">
            <div class="absolute top-[-80px] right-[-60px] w-64 h-64 bg-orange-500/10 blur-3xl rounded-full"></div>

            <div class="absolute right-10 top-6 opacity-30 text-orange-400">
                <div class="flex items-center gap-5">
                    <i data-lucide="popcorn" class="w-24 h-24"></i>
                    <i data-lucide="cup-soda" class="w-24 h-24"></i>
                    <i data-lucide="ticket" class="w-20 h-20 rotate-12"></i>
                </div>
            </div>

            <div class="relative z-10">
                <h2 class="text-4xl font-bold mb-3">Olá, administrador</h2>
                <p class="text-zinc-400 text-lg">Bem-vindo ao Cinema Control.</p>
            </div>
        </section>

        <section class="grid grid-cols-3 gap-5 mb-7">
            <div class="bg-[#101014] border border-zinc-900 rounded-3xl p-6">
                <div class="w-14 h-14 rounded-full bg-orange-500/10 flex items-center justify-center mb-5">
                    <i data-lucide="film" class="w-7 h-7 text-orange-400"></i>
                </div>

                <p class="text-zinc-400 text-lg mb-2">Filmes</p>

                <h3 class="text-4xl font-bold text-orange-500">
                    <?php echo $totalFilmes; ?>
                </h3>
            </div>

            <div class="bg-[#101014] border border-zinc-900 rounded-3xl p-6">
                <div class="w-14 h-14 rounded-full bg-orange-500/10 flex items-center justify-center mb-5">
                    <i data-lucide="clock-3" class="w-7 h-7 text-orange-400"></i>
                </div>

                <p class="text-zinc-400 text-lg mb-2">Sessões</p>
                <h3 class="text-4xl font-bold text-orange-500">
                    <?php echo $totalSessoes; ?>
                </h3>
            </div>

            <div class="bg-[#101014] border border-zinc-900 rounded-3xl p-6">
                <div class="w-14 h-14 rounded-full bg-orange-500/10 flex items-center justify-center mb-5">
                    <i data-lucide="ticket" class="w-7 h-7 text-orange-400"></i>
                </div>

                <p class="text-zinc-400 text-lg mb-2">Ingressos</p>
                <h3 class="text-4xl font-bold text-orange-500">156</h3>
            </div>
        </section>

        <section class="bg-[#101014] border border-zinc-900 rounded-3xl p-7">
            <h3 class="text-2xl font-bold mb-7">Filmes em cartaz</h3>

            <div class="space-y-5">
                <?php foreach ($filmesEmCartaz as $filme): ?>
                    <div class="flex items-center justify-between border-b border-zinc-800 pb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 rounded-full bg-zinc-900 flex items-center justify-center">
                                <i data-lucide="film" class="w-5 h-5 text-orange-400"></i>
                            </div>

                            <div>
                                <p class="text-zinc-200 font-medium">
                                    <?php echo htmlspecialchars($filme['nome']); ?>
                                </p>

                                <p class="text-zinc-500 text-sm">
                                    <?php echo htmlspecialchars($filme['genero']); ?>
                                </p>
                            </div>
                        </div>

                        <span class="bg-orange-500/15 text-orange-400 px-4 py-2 rounded-full text-sm">
                            <?php echo htmlspecialchars($filme['classificacao']); ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>