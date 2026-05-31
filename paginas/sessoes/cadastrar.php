<?php
require_once __DIR__ . '/../../login/protege.php';
require_once __DIR__ . '/../../login/conexao.php';

$pdo = getConexao();

$sql = "SELECT * FROM filmes";

$stmt = $pdo->query($sql);

$filmes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "INSERT INTO sessoes (filme_id, data, horario, sala)
            VALUES (:filme_id, :data, :horario, :sala)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':filme_id' => $_POST['filme_id'],
        ':data' => $_POST['data'],
        ':horario' => $_POST['horario'],
        ':sala' => $_POST['sala']
    ]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Sessão</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-black text-white min-h-screen flex items-center justify-center p-10">

    <div class="w-full max-w-xl bg-[#101014] border border-zinc-800 rounded-3xl p-10 shadow-2xl">

        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 rounded-2xl bg-orange-500/10 border border-orange-500/30 flex items-center justify-center">
                <i data-lucide="clock-3" class="w-8 h-8 text-orange-400"></i>
            </div>

            <div>
                <h1 class="text-3xl font-bold">Cadastrar Sessão</h1>
                <p class="text-zinc-400 text-sm">Preencha as informações da nova sessão</p>
            </div>
        </div>

        <form method="POST" class="space-y-5">

            <div>
                <label class="block mb-2 text-zinc-300">Filme</label>

                <select name="filme_id" required
                class="w-full bg-zinc-900 border border-zinc-700 rounded-2xl px-5 py-4 outline-none focus:border-orange-500">
                    <option value="">Selecione um filme</option>

                    <?php foreach($filmes as $filme): ?>
                        <option value="<?php echo $filme['id']; ?>">
                            <?php echo htmlspecialchars($filme['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block mb-2 text-zinc-300">Data</label>

                <input type="date" name="data" required
                class="w-full bg-zinc-900 border border-zinc-700 rounded-2xl px-5 py-4 outline-none focus:border-orange-500">
            </div>

            <div>
                <label class="block mb-2 text-zinc-300">Horário</label>

                <input type="time" name="horario" required
                class="w-full bg-zinc-900 border border-zinc-700 rounded-2xl px-5 py-4 outline-none focus:border-orange-500">
            </div>

            <div>
                <label class="block mb-2 text-zinc-300">Sala</label>

                <input type="text" name="sala" placeholder="Ex: Sala 1" required
                class="w-full bg-zinc-900 border border-zinc-700 rounded-2xl px-5 py-4 outline-none focus:border-orange-500">
            </div>

            <div class="flex justify-between gap-4 pt-4">
                <a href="index.php"
                class="bg-zinc-800 hover:bg-zinc-700 transition px-8 py-4 rounded-2xl font-semibold">
                    ← Voltar
                </a>

                <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 transition px-8 py-4 rounded-2xl font-semibold">
                    Cadastrar Sessão
                </button>
            </div>

        </form>
    </div>

    <script>
        lucide.createIcons();
    </script>

</body>
</html>