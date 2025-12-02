<?php
include_once "dbConnection.php"; 
include_once "authCheck.php"; 
?>
<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/logotipo-kairos.png" type="image/png">
    <title>Kairos - Page</title>
</head>

<body>
    <header class="shadow-sm sticky-top bg-white">
        <nav class="navbar navbar-expand-lg navbar-light px-4">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand d-flex align-items-center gap-2" href="dashboard.php">
                    <img src="img/logotipo-kairos.png" alt="Logo" width="40" height="40" class="rounded-circle">
                    <span class="fw-bold fs-5" style="color: #5D737E;">Kairos</span>
                    <label class="text-muted fs-6">Casa de repouso</label>
                </a>

                <!-- Perfil -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/avatar-generic.png" alt="Avatar" class="rounded-circle shadow-sm me-2"
                                height="35" width="35">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="profile.php">👤 Meu Perfil</a></li>
                            <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin'): ?>
                                <li><a class="dropdown-item" href="adminConfig.php">⚙️ Configurações</a></li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="logout.php">🚪 Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</body>
