<?php
if (!empty($search)) {
    $query = $pdo->prepare("
        SELECT c.*, r.nome AS residente
        FROM tb_consultas c
        JOIN tb_residentes r ON c.resident_id = r.id
        WHERE r.nome LIKE :search OR c.medico LIKE :search
        ORDER BY c.data_consulta DESC, c.horario ASC
    ");
    $query->execute(['search' => "%$search%"]);
} else {
    $query = $pdo->query("
        SELECT c.*, r.nome AS residente
        FROM tb_consultas c
        JOIN tb_residentes r ON c.resident_id = r.id
        ORDER BY c.data_consulta DESC, c.horario ASC
    ");
}

$consultas = $query->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        try {
            if ($action === 'create') {
                $resident_id = $_POST['resident_id'];
                $data_consulta = $_POST['data_consulta'];
                $horario = $_POST['horario'];
                $medico = $_POST['medico'];
                $especialidade = $_POST['especialidade'];
                $observacoes = $_POST['observacoes'];
                $prescricao = $_POST['prescricao'];

                $stmt = $pdo->prepare("
                    INSERT INTO tb_consultas (resident_id, data_consulta, horario, medico, especialidade, observacoes, prescricao)
                    VALUES (:resident_id, :data_consulta, :horario, :medico, :especialidade, :observacoes, :prescricao)
                ");
                $stmt->execute([
                    ':resident_id' => $resident_id,
                    ':data_consulta' => $data_consulta,
                    ':horario' => $horario,
                    ':medico' => $medico,
                    ':especialidade' => $especialidade,
                    ':observacoes' => $observacoes,
                    ':prescricao' => $prescricao,
                ]);
                $_SESSION['message'] = 'Consulta cadastrada com sucesso!';
            } elseif ($action === 'update') {
                $id = $_POST['id'];
                $resident_id = $_POST['resident_id'];
                $data_consulta = $_POST['data_consulta'];
                $horario = $_POST['horario'];
                $medico = $_POST['medico'];
                $especialidade = $_POST['especialidade'];
                $observacoes = $_POST['observacoes'];
                $prescricao = $_POST['prescricao'];

                $stmt = $pdo->prepare("
                    UPDATE tb_consultas
                    SET resident_id = :resident_id, data_consulta = :data_consulta, horario = :horario,
                        medico = :medico, especialidade = :especialidade, observacoes = :observacoes, prescricao = :prescricao
                    WHERE id = :id
                ");
                $stmt->execute([
                    ':id' => $id,
                    ':resident_id' => $resident_id,
                    ':data_consulta' => $data_consulta,
                    ':horario' => $horario,
                    ':medico' => $medico,
                    ':especialidade' => $especialidade,
                    ':observacoes' => $observacoes,
                    ':prescricao' => $prescricao,
                ]);
                $_SESSION['message'] = 'Consulta atualizada com sucesso!';
            } elseif ($action === 'delete') {
                $id = $_POST['id'];
                $stmt = $pdo->prepare("DELETE FROM tb_consultas WHERE id = :id");
                $stmt->execute([':id' => $id]);
                $_SESSION['message'] = 'Consulta excluída com sucesso!';
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Ocorreu um erro: ' . $e->getMessage();
        }

        header("Location: listConsultas.php");
        exit;
    }
}
