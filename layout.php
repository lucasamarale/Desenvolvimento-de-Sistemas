<!DOCTYPE html>
<!-- Framework escolhido: Bootstrap 5 -->
<!-- Importado via CDN: https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'To-Do List'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand">&#10003; To-Do List</span>
        <?php if (isset($_SESSION['usuario'])): ?>
        <div class="d-flex align-items-center gap-3">
            <span class="text-white">Olá, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong></span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Sair</a>
        </div>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
