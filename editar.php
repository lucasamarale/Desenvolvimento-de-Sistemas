<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

include 'conexao.php';

$id = $_GET['id'];

$sql  = "SELECT * FROM tarefas WHERE id = :id AND usuario_id = :usuario_id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':usuario_id', $_SESSION['usuario_id']);
$stmt->execute();
$tarefa = $stmt->fetch(PDO::FETCH_OBJ);

if (!$tarefa) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo    = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $status    = $_POST['status'];

    $sql  = "UPDATE tarefas SET titulo = :titulo, descricao = :descricao, status = :status WHERE id = :id AND usuario_id = :usuario_id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':usuario_id', $_SESSION['usuario_id']);
    $stmt->execute();

    header('Location: index.php');
    exit;
}

$page_title = 'Editar Tarefa';
include 'layout.php';
?>

<div class="card shadow-sm" style="max-width: 600px;">
    <div class="card-body p-4">
        <h5 class="card-title mb-4">Editar Tarefa</h5>

        <form action="editar.php?id=<?php echo $id; ?>" method="post">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="titulo" name="titulo"
                       value="<?php echo htmlspecialchars($tarefa->titulo); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4"><?php echo htmlspecialchars($tarefa->descricao); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="pendente" <?php echo $tarefa->status === 'pendente' ? 'selected' : ''; ?>>Pendente</option>
                    <option value="concluida" <?php echo $tarefa->status === 'concluida' ? 'selected' : ''; ?>>Concluída</option>
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark">Salvar</button>
                <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
