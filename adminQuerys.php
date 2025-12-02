<?php
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    $_SESSION['error'] = "Acesso negado. Apenas o administrador pode acessar esta página.";
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['new_password'])) {
    $userId = $_POST['user_id'];
    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("UPDATE tb_users SET password = :password WHERE id = :id");
        $stmt->execute([
            ':password' => $newPassword,
            ':id' => $userId
        ]);
        $_SESSION['message'] = "Senha alterada com sucesso para o usuário ID $userId.";
        header("Location: adminConfig.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erro ao alterar a senha: " . $e->getMessage();
        header("Location: adminConfig.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_id'])) {
    $userId = $_POST['delete_user_id'];

    try {
        $stmt = $pdo->prepare("SELECT username FROM tb_users WHERE id = :id");
        $stmt->execute([':id' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['username'] === 'admin') {
            $_SESSION['error'] = "O usuário admin não pode ser deletado.";
        } else {
            $stmt = $pdo->prepare("DELETE FROM tb_users WHERE id = :id");
            $stmt->execute([':id' => $userId]);
            $_SESSION['message'] = "Usuário ID $userId deletado com sucesso.";
        }
        header("Location: adminConfig.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erro ao deletar o usuário: " . $e->getMessage();
        header("Location: adminConfig.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_username'], $_POST['new_password'])) {
    $newUsername = $_POST['new_username'];
    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO tb_users (username, password, data_criacao) VALUES (:username, :password, NOW())");
        $stmt->execute([
            ':username' => $newUsername,
            ':password' => $newPassword
        ]);
        $_SESSION['message'] = "Usuário '$newUsername' cadastrado com sucesso.";
        header("Location: adminConfig.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erro ao cadastrar o usuário: " . $e->getMessage();
        header("Location: adminConfig.php");
        exit();
    }
}

try {
    $stmt = $pdo->query("SELECT id, username, data_criacao FROM tb_users ORDER BY data_criacao DESC");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error'] = "Erro ao buscar usuários: " . $e->getMessage();
    $users = [];
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
