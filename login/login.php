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

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body
    class="min-h-screen bg-cover bg-center text-white"
    style="background-image: url('img/fundo-login.png');"
>

    <div class="min-h-screen bg-black/65 flex items-center justify-center px-10">

        <div class="w-full max-w-7xl flex items-center justify-between gap-20">

            <!-- LADO ESQUERDO -->

            <div class="hidden lg:flex flex-col items-center text-center w-1/2">

                <div class="mb-8">

                    <div class="w-40 h-40 rounded-full flex items-center justify-center">

                        <i
                            data-lucide="clapperboard"
                            class="w-32 h-32 text-orange-400 drop-shadow-[0_0_25px_rgba(249,115,22,0.8)]"
                        ></i>

                    </div>

                </div>

                <h1 class="text-8xl font-bold tracking-wide leading-none">
                    CINEMA
                </h1>

                <h2 class="text-7xl font-light text-orange-500 tracking-wide">
                    CONTROL
                </h2>

                <p class="mt-6 text-2xl text-zinc-300 leading-relaxed">
                    Sistema de gerenciamento<br>
                    para cinemas
                </p>

            </div>

            <!-- LADO DIREITO -->

            <div
                class="w-full lg:w-[550px] bg-black/70 backdrop-blur-md border border-orange-500/30 rounded-[40px] p-10 shadow-[0_0_50px_rgba(249,115,22,0.18)]"
            >

                <div class="flex justify-center mb-6">

                    <div class="w-24 h-24 rounded-full border border-orange-500/30 flex items-center justify-center">

                        <i
                            data-lucide="user"
                            class="w-12 h-12 text-orange-400"
                        ></i>

                    </div>

                </div>

                <h2 class="text-4xl font-bold text-center mb-3">
                    Bem-vindo de volta!
                </h2>

                <p class="text-center text-zinc-400 mb-10">
                    Acesse sua conta para gerenciar o cinema.
                </p>

                <?php if ($erro): ?>

                    <div class="bg-red-500/10 border border-red-500/30 text-red-400 rounded-2xl px-4 py-3 mb-5">

                        <?php echo htmlspecialchars($erro); ?>

                    </div>

                <?php endif; ?>

                <form method="POST" action="login.php" class="space-y-6">

                    <div>

                        <label class="flex items-center gap-2 text-orange-400 mb-2">

                            <i data-lucide="mail" class="w-4 h-4"></i>

                            E-mail

                        </label>

                        <input
                            type="email"
                            name="email"
                            placeholder="Digite seu email"
                            required
                            class="w-full bg-black/40 border border-zinc-700 rounded-2xl px-5 py-4 text-white outline-none focus:border-orange-500 transition"
                        >

                    </div>

                    <div>

                        <label class="flex items-center gap-2 text-orange-400 mb-2">

                            <i data-lucide="lock" class="w-4 h-4"></i>

                            Senha

                        </label>

                        <input
                            type="password"
                            name="senha"
                            placeholder="Digite sua senha"
                            required
                            class="w-full bg-black/40 border border-zinc-700 rounded-2xl px-5 py-4 text-white outline-none focus:border-orange-500 transition"
                        >

                    </div>

                    <button
                        type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-600 transition py-4 rounded-2xl font-bold text-lg shadow-[0_0_25px_rgba(249,115,22,0.25)]"
                    >
                        Entrar
                    </button>

                </form>

                <div class="mt-8 border-t border-zinc-800 pt-6 text-center">

                    <p class="text-zinc-500 text-sm">
                        Desenvolvido por Mariah © 2026
                    </p>

                </div>

            </div>

        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>