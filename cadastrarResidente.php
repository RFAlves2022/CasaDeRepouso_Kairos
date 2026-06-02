<?php
include_once "dbConnection.php";

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = trim($_POST['nome'] ?? '');
        $data_nasc = !empty($_POST['data_nasc']) ? $_POST['data_nasc'] : null;
        $cpf = trim($_POST['cpf'] ?? '');
        $rg = trim($_POST['rg'] ?? '');
        $telefone = trim($_POST['telefone'] ?? '');
        $endereco = trim($_POST['endereco'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $quarto = trim($_POST['quarto'] ?? '');
        $medicamentos = trim($_POST['medicamentos'] ?? '');
        $alergias = trim($_POST['alergias'] ?? '');
        $restricoes_alimentares = trim($_POST['restricoes_alimentares'] ?? '');
        $responsavel_nome = trim($_POST['responsavel_nome'] ?? '');
        $responsavel_telefone = trim($_POST['responsavel_telefone'] ?? '');
        $responsavel_email = trim($_POST['responsavel_email'] ?? '');
        $parente_grau = trim($_POST['parente_grau'] ?? '');

        if ($nome === '' || $cpf === '') {
            throw new Exception("Os campos 'nome' e 'cpf' são obrigatórios.");
        }

        $fotoNome = null;

        if (!empty($_FILES['foto']['name'])) {
            if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception("Erro no upload da foto.");
            }

            $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
            $permitidos = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($ext, $permitidos, true)) {
                throw new Exception("Formato inválido. Use JPG, PNG ou WEBP.");
            }

            $mime = mime_content_type($_FILES['foto']['tmp_name']);
            $mimesPermitidos = ['image/jpeg', 'image/png', 'image/webp'];

            if (!in_array($mime, $mimesPermitidos, true)) {
                throw new Exception("A foto enviada não é uma imagem válida.");
            }

            $diretorio = __DIR__ . "/uploads/residentes/";
            if (!is_dir($diretorio)) {
                mkdir($diretorio, 0775, true);
            }

            $fotoNome = uniqid('res_', true) . '.' . $ext;
            $destino = $diretorio . $fotoNome;

            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                throw new Exception("Não foi possível salvar a foto.");
            }
        }

        $sql = "INSERT INTO tb_residentes
            (nome, data_nasc, cpf, rg, telefone, endereco, email, quarto, medicamentos, alergias, restricoes_alimentares, responsavel_nome, responsavel_telefone, responsavel_email, parente_grau, foto)
            VALUES
            (:nome, :data_nasc, :cpf, :rg, :telefone, :endereco, :email, :quarto, :medicamentos, :alergias, :restricoes_alimentares, :responsavel_nome, :responsavel_telefone, :responsavel_email, :parente_grau, :foto)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':data_nasc', $data_nasc);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':rg', $rg);
        $stmt->bindValue(':telefone', $telefone);
        $stmt->bindValue(':endereco', $endereco);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':quarto', $quarto);
        $stmt->bindValue(':medicamentos', $medicamentos);
        $stmt->bindValue(':alergias', $alergias);
        $stmt->bindValue(':restricoes_alimentares', $restricoes_alimentares);
        $stmt->bindValue(':responsavel_nome', $responsavel_nome);
        $stmt->bindValue(':responsavel_telefone', $responsavel_telefone);
        $stmt->bindValue(':responsavel_email', $responsavel_email);
        $stmt->bindValue(':parente_grau', $parente_grau);
        $stmt->bindValue(':foto', $fotoNome);

        if ($stmt->execute()) {
            header("Location: frmCadResidente.php?sucesso=1");
            exit;
        }

        throw new Exception("Erro ao cadastrar residente.");
    }
} catch (Exception $e) {
    $cadastro_erro = $e->getMessage();
    echo $cadastro_erro;
}
