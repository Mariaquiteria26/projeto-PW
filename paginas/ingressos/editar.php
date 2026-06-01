<?php
require_once __DIR__ . '/../../login/protege.php';
require_once __DIR__ . '/../../login/conexao.php';

$pdo = getConexao();

$id = $_GET['id'];

$sql = "SELECT * FROM ingressos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':id' => $id
]);

$ingresso = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT sessoes.*,
               filmes.nome AS nome_filme
        FROM sessoes
        INNER JOIN filmes ON sessoes.filme_id = filmes.id";

$stmt = $pdo->query($sql);

$sessoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "UPDATE ingressos
            SET sessao_id = :sessao_id,
                cliente = :cliente,
                quantidade = :quantidade
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':sessao_id' => $_POST['sessao_id'],
        ':cliente' => $_POST['cliente'],
        ':quantidade' => $_POST['quantidade'],
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
    <title>Editar Ingresso</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-black text-white min-h-screen flex items-center justify-center p-10">

    <div class="w-full max-w-xl bg-[#101014] border border-zinc-800 rounded-3xl p-10 shadow-2xl">

        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 rounded-2xl bg-orange-500/10 border border-orange-500/30 flex items-center justify-center">
                <i data-lucide="pencil" class="w-8 h-8 text-orange-400"></i>
            </div>

            <div>
                <h1 class="text-3xl font-bold">Editar Ingresso</h1>
                <p class="text-zinc-400 text-sm">Altere as informações do ingresso</p>
            </div>
        </div>

        <form method="POST" class="space-y-5">

            <div>
                <label class="block mb-2 text-zinc-300">Sessão</label>

                <select name="sessao_id" required
                class="w-full bg-zinc-900 border border-zinc-700 rounded-2xl px-5 py-4 outline-none focus:border-orange-500">

                    <?php foreach($sessoes as $sessao): ?>

                        <option value="<?php echo $sessao['id']; ?>"
                            <?php echo ($sessao['id'] == $ingresso['sessao_id']) ? 'selected' : ''; ?>>

                            <?php echo htmlspecialchars($sessao['nome_filme']); ?>
                            -
                            <?php echo date('d/m/Y', strtotime($sessao['data'])); ?>
                            -
                            <?php echo date('H:i', strtotime($sessao['horario'])); ?>
                            -
                            <?php echo htmlspecialchars($sessao['sala']); ?>

                        </option>

                    <?php endforeach; ?>

                </select>
            </div>

            <div>
                <label class="block mb-2 text-zinc-300">Cliente</label>

                <input type="text" name="cliente" value="<?php echo htmlspecialchars($ingresso['cliente']); ?>" required
                class="w-full bg-zinc-900 border border-zinc-700 rounded-2xl px-5 py-4 outline-none focus:border-orange-500">
            </div>

            <div>
                <label class="block mb-2 text-zinc-300">Quantidade</label>

                <input type="number" name="quantidade" min="1" value="<?php echo $ingresso['quantidade']; ?>" required
                class="w-full bg-zinc-900 border border-zinc-700 rounded-2xl px-5 py-4 outline-none focus:border-orange-500">
            </div>

            <div class="flex justify-between gap-4 pt-4">
                <a href="index.php"
                class="bg-zinc-800 hover:bg-zinc-700 transition px-8 py-4 rounded-2xl font-semibold">
                    ← Voltar
                </a>

                <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 transition px-8 py-4 rounded-2xl font-semibold">
                    Salvar Alterações
                </button>
            </div>

        </form>
    </div>

    <script>
        lucide.createIcons();
    </script>

</body>
</html>