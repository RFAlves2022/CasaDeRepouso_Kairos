<?php
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $erro = "Preencha todos os campos.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id, username, password FROM tb_users WHERE username = :username LIMIT 1");
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                session_regenerate_id(true);
                header("Location: dashboard.php");
                exit;
            } else {
                $erro = "Usuário ou senha inválidos.";
            }
        } catch (PDOException $e) {
            $erro = "Erro ao verificar login: " . $e->getMessage();
        }
    }
}
?>
