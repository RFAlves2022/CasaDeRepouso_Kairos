<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Você precisa estar logado para acessar esta página.";
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("SELECT username, data_criacao FROM tb_users WHERE id = :id");
    $stmt->execute([':id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['data_criacao'] = $user['data_criacao'];
    } else {
        $_SESSION['error'] = "Usuário não encontrado.";
        header("Location: login.php");
        exit();
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Erro ao buscar informações do usuário: " . $e->getMessage();
    header("Location: login.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];

    try {
        $stmt = $pdo->prepare("SELECT password FROM tb_users WHERE id = :id AND username = :username");
        $stmt->execute([
            ':id' => $userId,
            ':username' => $_SESSION['username']
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($currentPassword, $user['password'])) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateStmt = $pdo->prepare("UPDATE tb_users SET password = :newPassword WHERE id = :id AND username = :username");
            $updateStmt->execute([
                ':newPassword' => $hashedPassword,
                ':id' => $userId,
                ':username' => $_SESSION['username']
            ]);

            $_SESSION['message'] = "Senha alterada com sucesso!";
        } else {
            $_SESSION['error'] = "Senha atual incorreta.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erro ao alterar a senha: " . $e->getMessage();
    }


    header("Location: profile.php");
    exit();
}

if (isset($_SESSION['message'])) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
    echo $_SESSION['message'];
    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
    echo "</div>";
    unset($_SESSION['message']);
}

if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
    echo $_SESSION['error'];
    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
    echo "</div>";
    unset($_SESSION['error']);
}
