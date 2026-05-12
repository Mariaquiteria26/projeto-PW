<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: paginas/painel/index.php');
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
            header('Location: paginas/painel/index.php');
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

    <link rel="stylesheet" href="assets/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <div class="overlay"></div>
    
    <div class="login-container">

        <div class="login-box">

            <h1>Cinema Control</h1>
            <p class="subtitle">Login</p>

            <?php if ($erro): ?>
                <p class="error"><?php echo htmlspecialchars($erro); ?></p>
            <?php endif; ?>

            <form method="POST" action="login.php">

                <div class="input-group">
                    <label>Email</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu email" required>
                </div>

                <div class="input-group">
                    <label>Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>

                <button type="submit">Entrar</button>

            </form>
        </div>
    </div>

</body>
</html>