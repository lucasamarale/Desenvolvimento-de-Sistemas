<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

include 'conexao.php';

$id     = $_GET['id'];
$status = 'concluida';

$sql  = "UPDATE tarefas SET status = :status WHERE id = :id AND usuario_id = :usuario_id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':status', $status);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':usuario_id', $_SESSION['usuario_id']);
$stmt->execute();

header('Location: index.php');
exit;
?>
