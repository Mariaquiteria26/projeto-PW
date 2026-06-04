<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /paginas/painel/index.php');
    exit();
}

require_once __DIR__ . '/conexao.php';
$pdo = getConexao();

$erro = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    

    if (empty($email) || empty($senha)) {
        $erro = 'Preencha todos os campos.';
    } else {
        $stmt = $pdo->prepare('SELECT id, senha FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && $senha === $usuario['senha']) {
            $_SESSION['user_id'] = $usuario['id'];
            header('Location: /paginas/painel/index.php');
            exit();
        } else {
            $erro = 'Email ou senha inválidos.';
        }
    }
}
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

<body
    class="min-h-screen bg-cover bg-center text-white"
    style="background-image: url('img/fundo-login.png');"
>

    <div class="min-h-screen bg-black/65 flex items-center justify-center p-8">

        <div class="w-full max-w-md bg-[#101014]/90 border border-orange-500/25 rounded-3xl p-10 shadow-[0_0_45px_rgba(249,115,22,0.18)] backdrop-blur-md">

            <div class="flex flex-col items-center text-center mb-8">

                <div class="w-20 h-20 rounded-3xl bg-orange-500/10 border border-orange-500/30 flex items-center justify-center mb-5 shadow-[0_0_25px_rgba(249,115,22,0.25)]">
                    <i data-lucide="clapperboard" class="w-11 h-11 text-orange-400"></i>
                </div>

                <h1 class="text-4xl font-bold leading-tight">
                    <span class="text-white">Cinema</span>
                    <span class="text-orange-500">Control</span>
                </h1>

                <p class="text-zinc-400 mt-3">
                    Sistema de gerenciamento para cinemas
                </p>

            </div>

            <?php if ($erro): ?>
                <div class="bg-red-500/10 border border-red-500/30 text-red-400 rounded-2xl px-4 py-3 mb-5 text-sm">
                    <?php echo htmlspecialchars($erro); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="login.php" class="space-y-5">

                <div>
                    <label class="flex items-center gap-2 text-zinc-300 mb-2">
                        <i data-lucide="mail" class="w-4 h-4 text-orange-400"></i>
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Digite seu email"
                        required
                        class="w-full bg-black/40 border border-zinc-700 rounded-2xl px-5 py-4 outline-none focus:border-orange-500 transition"
                    >
                </div>

                <div>
                    <label class="flex items-center gap-2 text-zinc-300 mb-2">
                        <i data-lucide="lock" class="w-4 h-4 text-orange-400"></i>
                        Senha
                    </label>

                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Digite sua senha"
                        required
                        class="w-full bg-black/40 border border-zinc-700 rounded-2xl px-5 py-4 outline-none focus:border-orange-500 transition"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 transition py-4 rounded-2xl font-bold shadow-[0_0_25px_rgba(249,115,22,0.22)]"
                >
                    Entrar
                </button>

            </form>

        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>

</body>
</html>