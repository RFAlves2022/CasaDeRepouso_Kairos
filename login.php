<?php
session_start();
include_once "dbConnection.php";

$msg = "";

if (!empty($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST['submit'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $msg = "Preencha usuário e senha.";
    } else {
        $sql = "SELECT id, username, password
                FROM tb_users
                WHERE username = :username
                LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['username'] = $usuario['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $msg = "Usuário ou senha inválidos.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/logotipo-kairos.png" type="image/png">
    <title>Kairos - Login</title>
    <style>
        body{
            background:#E5F2E8;
            min-height:100vh;
            display:flex;
            align-items:center;
        }
        .login-wrap{
            width:100%;
            padding:32px 16px;
        }
        .login-card{
            max-width:420px;
            margin:0 auto;
            background:#fff;
            border-radius:24px;
            box-shadow:0 18px 40px rgba(12,39,26,0.12);
            border:1px solid #D5E3DC;
            overflow:hidden;
        }
        .login-header{
            background:#F4FAF6;
            padding:24px;
            text-align:center;
            border-bottom:1px solid #D5E3DC;
        }
        .login-body{
            padding:28px;
        }
        .btn-kairos{
            background:#1F5B36;
            border:none;
            color:#fff;
            border-radius:999px;
        }
        .btn-kairos:hover{
            background:#18452A;
            color:#fff;
        }
        .form-control{
            border-radius:12px;
            border:1px solid #C4D5CD;
        }
        .form-control:focus{
            border-color:#1F5B36;
            box-shadow:0 0 0 0.16rem rgba(31,91,54,0.18);
        }
    </style>
</head>
<body>
    <div class="login-wrap">
        <div class="login-card">
            <div class="login-header">
                <img src="img/logotipo-kairos.png" alt="Kairos" width="64" height="64" class="rounded-circle mb-2">
                <h1 class="h4 mb-0" style="color:#1F5B36;">Kairos</h1>
                <p class="text-muted mb-0">Acesso administrativo</p>
            </div>

            <div class="login-body">
                <?php if (!empty($msg)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuário</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-kairos w-100 py-2">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
