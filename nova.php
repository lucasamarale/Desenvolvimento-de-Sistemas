<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo    = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    $sql  = "INSERT INTO tarefas (titulo, descricao, usuario_id) VALUES (?, ?, ?)";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([$titulo, $descricao, $_SESSION['usuario_id']]);

    header('Location: index.php');
    exit;
}

$page_title = 'Nova Tarefa';
include 'layout.php';
?>

<div class="card shadow-sm" style="max-width: 600px;">
    <div class="card-body p-4">
        <h5 class="card-title mb-4">Nova Tarefa</h5>

        <form action="nova.php" method="post">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4"></textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark">Salvar</button>
                <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
