<?php
include_once "dbConnection.php";

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'] ?? '';
        $data_nasc = $_POST['data_nasc'] ?? null;
        $cpf = $_POST['cpf'] ?? '';
        $rg = $_POST['rg'] ?? null;
        $telefone = $_POST['telefone'] ?? null;
        $endereco = $_POST['endereco'] ?? null;
        $email = $_POST['email'] ?? null;
        $quarto = $_POST['quarto'] ?? null;
        $medicamentos = $_POST['medicamentos'] ?? null;
        $alergias = $_POST['alergias'] ?? null;
        $restricoes_alimentares = $_POST['restricoes_alimentares'] ?? null;
        $responsavel_nome = $_POST['responsavel_nome'] ?? null;
        $responsavel_telefone = $_POST['responsavel_telefone'] ?? null;
        $responsavel_email = $_POST['responsavel_email'] ?? null;
        $parente_grau = $_POST['parente_grau'] ?? null;

        if (empty($nome) || empty($cpf)) {
            throw new Exception("Os campos 'nome' e 'cpf' são obrigatórios.");
        }

        $sql = "INSERT INTO tb_residentes (nome, data_nasc, cpf, rg, telefone, endereco, email, quarto, medicamentos, alergias, restricoes_alimentares, responsavel_nome, responsavel_telefone, responsavel_email, parente_grau)
                VALUES (:nome, :data_nasc, :cpf, :rg, :telefone, :endereco, :email, :quarto, :medicamentos, :alergias, :restricoes_alimentares, :responsavel_nome, :responsavel_telefone, :responsavel_email, :parente_grau)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':data_nasc', $data_nasc);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':rg', $rg);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':quarto', $quarto);
        $stmt->bindParam(':medicamentos', $medicamentos);
        $stmt->bindParam(':alergias', $alergias);
        $stmt->bindParam(':restricoes_alimentares', $restricoes_alimentares);
        $stmt->bindParam(':responsavel_nome', $responsavel_nome);
        $stmt->bindParam(':responsavel_telefone', $responsavel_telefone);
        $stmt->bindParam(':responsavel_email', $responsavel_email);
        $stmt->bindParam(':parente_grau', $parente_grau);

        if ($stmt->execute()) {
            $cadastro_sucesso = true;
        } else {
            $cadastro_erro = true;
        }
    }
} catch (PDOException $e) {
    $erro_conexao = "Erro de conexão com o banco de dados: " . $e->getMessage();
} catch (Exception $e) {
    $cadastro_erro = $e->getMessage();
}
