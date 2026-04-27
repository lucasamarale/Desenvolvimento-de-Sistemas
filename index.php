<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

include 'conexao.php';

$usuario_id = $_SESSION['usuario_id'];

$sql     = "SELECT * FROM tarefas WHERE usuario_id = :usuario_id ORDER BY created_at DESC";
$stmt    = $conexao->prepare($sql);
$stmt->bindParam(':usuario_id', $usuario_id);
$stmt->execute();
$tarefas = $stmt->fetchAll(PDO::FETCH_OBJ);

$page_title = 'Minhas Tarefas';
include 'layout.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Minhas Tarefas</h5>
    <a href="nova.php" class="btn btn-dark btn-sm">+ Nova Tarefa</a>
</div>

<?php if (count($tarefas) === 0): ?>
    <div class="alert alert-secondary">Nenhuma tarefa cadastrada. <a href="nova.php">Adicionar agora</a>.</div>
<?php else: ?>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Título</th>
                    <th>Status</th>
                    <th>Criado em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tarefas as $tarefa): ?>
                <tr>
                    <td><?php echo htmlspecialchars($tarefa->titulo); ?></td>
                    <td>
                        <?php if ($tarefa->status === 'concluida'): ?>
                            <span class="badge bg-success">Concluída</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Pendente</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo date('d/m/Y H:i', strtotime($tarefa->created_at)); ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $tarefa->id; ?>" class="btn btn-outline-secondary btn-sm">Editar</a>
                        <a href="concluir.php?id=<?php echo $tarefa->id; ?>" class="btn btn-outline-success btn-sm">Concluir</a>
                        <a href="excluir.php?id=<?php echo $tarefa->id; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Excluir esta tarefa?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<?php include 'footer.php'; ?>
