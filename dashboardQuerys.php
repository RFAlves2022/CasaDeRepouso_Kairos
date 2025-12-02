<?php
$dataHoje = date('Y-m-d');

try {
    $sqlHoje = "
        SELECT 
            r.nome AS paciente,
            c.horario,
            c.medico,
            c.especialidade
        FROM tb_consultas c
        INNER JOIN tb_residentes r ON c.resident_id = r.id
        WHERE c.data_consulta = :hoje
        ORDER BY c.horario ASC
    ";

    $stmtHoje = $pdo->prepare($sqlHoje);
    $stmtHoje->bindParam(':hoje', $dataHoje);
    $stmtHoje->execute();
    $consultasHoje = $stmtHoje->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar consultas de hoje: " . $e->getMessage());
}

try {
    $sqlTodas = "
        SELECT 
            r.nome AS paciente,
            c.data_consulta,
            c.horario,
            c.medico,
            c.especialidade
        FROM tb_consultas c
        INNER JOIN tb_residentes r ON c.resident_id = r.id
        ORDER BY c.data_consulta ASC, c.horario ASC
    ";

    $stmtTodas = $pdo->query($sqlTodas);
    $consultasTodas = $stmtTodas->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar todas as consultas: " . $e->getMessage());
}

try {
    $sqlMedicamentos = "
        SELECT 
            m.horario,
            m.nome_medicamento AS medicacao,
            m.dosagem,
            r.nome AS paciente
        FROM tb_medicamentos m
        INNER JOIN tb_residentes r ON m.resident_id = r.id
        ORDER BY m.horario ASC
    ";

    $stmt = $pdo->prepare($sqlMedicamentos);
    $stmt->execute();
    $medicamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar medicamentos: " . $e->getMessage());
}
