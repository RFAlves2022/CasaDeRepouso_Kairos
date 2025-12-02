<?php
include_once "dbConnection.php";
session_start();
require_once "loginValidation.php";
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kairós • Acessar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/abstract-icon.png" type="image/png">
    <link rel="stylesheet" href="style.css">

    <style>
        /* identidade visual igual à imagem */
        body{
            min-height:100vh;
            margin:0;
            background-color:#E5F2E8;   /* verde clarinho do fundo */
            font-family: system-ui, -apple-system, BlinkMacSystemFont,"Segoe UI",sans-serif;
            color:#16352B;
        }
        main{
            min-height:100vh;
            display:flex;
            align-items:flex-start;
            justify-content:center;
            padding-top:90px;           /* distância do topo igual ao print */
        }
        .login-container{
            width:100%;
            max-width:640px;
            text-align:center;
        }
        .login-logo img{
            width:86px;
            height:86px;
            margin-bottom:6px;
        }
        .login-title-main{
            font-size:2.4rem;
            font-weight:700;
            color:#1F5B36;              /* verde do texto “Kairós”/“Acessar” */
        }
        .login-sub{
            font-size:1.1rem;
            color:#4E665A;
            margin-bottom:28px;
        }
        .login-form-wrapper{
            max-width:640px;
            margin:0 auto;
        }
        .form-control{
            border-radius:999px;
            border:1px solid #B9CEC3;   /* borda suave para destacar do fundo */
            background-color:#FFFFFF;
            padding:14px 18px;
            font-size:1rem;
            box-shadow:0 4px 10px rgba(0,0,0,0.03);
        }
        .form-control:focus{
            border-color:#184D30;       /* verde escuro no foco */
            box-shadow:0 0 0 0.16rem rgba(24,77,48,0.25);
            outline:none;
        }
        .btn-login{
            width:100%;
            padding:16px 18px;
            border-radius:999px;
            background-color:#184D30;   /* verde escuro do botão */
            border:none;
            color:#fff;
            font-size:1.05rem;
            font-weight:600;
            margin-top:12px;
        }
        .btn-login:hover{
            background-color:#123B24;
        }
        .forgot-link{
            margin-top:18px;
            font-size:0.95rem;
            color:#6D7D75;
            text-decoration:none;
        }
        .forgot-link:hover{
            text-decoration:underline;
        }
        .alert{
            border-radius:12px;
        }
    </style>
</head>

<body>
<main>
    <div class="login-container">

        <!-- topo com logo e texto exatamente como na imagem -->
        <div class="login-logo">
            <img src="img/logotipo-kairos.png" alt="Kairós">
        </div>
        <div class="login-sub text-muted">Casa de Repouso</div>
        <h1 class="login-title-main mb-4">Acessar</h1>

        <?php if (!empty($erro)): ?>
            <div class="alert alert-danger py-2 mb-3"><?= $erro ?></div>
        <?php endif; ?>

        <!-- campos grandes centralizados -->
        <form method="POST" class="login-form-wrapper">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="E-mail" required>
            </div>
            <div class="mb-1">
                <input type="password" name="password" class="form-control" placeholder="Senha" required>
            </div>

            <button type="submit" class="btn btn-login">Entrar</button>

            <a href="#!" class="forgot-link d-block">Esqueci minha senha</a>
        </form>
    </div>
</main>

<?php include_once "footer.php" ?>
</body>
</html>
