<?php
include_once "auth.php";
include_once "dbConnection.php";

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: frmCadGaleria.php");
        exit;
    }

    $data_postagem = $_POST['data_postagem'] ?? '';
    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');

    if ($data_postagem === '' || $titulo === '' || $descricao === '') {
        throw new Exception("Preencha todos os campos.");
    }

    if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Não foi possível salvar a imagem.");
    }

    $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
    $permitidos = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($ext, $permitidos, true)) {
        throw new Exception("Formato inválido. Use JPG, PNG ou WEBP.");
    }

    $mime = mime_content_type($_FILES['imagem']['tmp_name']);
    $mimesPermitidos = ['image/jpeg', 'image/png', 'image/webp'];

    if (!in_array($mime, $mimesPermitidos, true)) {
        throw new Exception("Arquivo não é uma imagem válida.");
    }

    $diretorio = __DIR__ . "/uploads/feed/";
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0775, true);
    }

    $nomeArquivo = uniqid('feed_', true) . '.' . $ext;
    $destino = $diretorio . $nomeArquivo;

    if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
        throw new Exception("Não foi possível mover a imagem.");
    }

    $sql = "INSERT INTO tb_galeria (imagem, data_postagem, titulo, descricao)
            VALUES (:imagem, :data_postagem, :titulo, :descricao)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':imagem', $nomeArquivo);
    $stmt->bindValue(':data_postagem', $data_postagem);
    $stmt->bindValue(':titulo', $titulo);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->execute();

    header("Location: frmCadGaleria.php?sucesso=1");
    exit;

} catch (Exception $e) {
    header("Location: frmCadGaleria.php?erro=" . urlencode($e->getMessage()));
    exit;
}
