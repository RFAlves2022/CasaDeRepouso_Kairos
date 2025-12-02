<?php
include_once "dbConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST['cpf'] ?? '';

    if (!empty($cpf)) {
        $sql = $pdo->prepare("DELETE FROM tb_residentes WHERE cpf = :cpf");
        $sql->bindValue(':cpf', $cpf);

        if ($sql->execute()) {
            header("Location: listResidentes.php?success=Residente deletado com sucesso!");
            exit;
        } else {
            header("Location: listResidentes.php?error=Erro ao deletar o residente.");
            exit;
        }
    } else {
        header("Location: listResidentes.php?error=CPF inválido.");
        exit;
    }
}
?>