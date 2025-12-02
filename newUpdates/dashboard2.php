<?php
include_once "header.php";
include_once "dashboardQuerys.php";
?>

<main>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar py-4" style="min-width: 120px; max-width: 140px; width: 13vw; min-height: 100vh; border-right: 1px solid #e0e0e0;">
                <div class="position-sticky">
                    <ul class="nav flex-column align-items-center gap-4">
                        <li class="nav-item w-100">
                            <a class="nav-link text-dark fw-bold d-flex flex-column align-items-center" href="listResidentes.php">
                                <img src="img/residentes-icon.png" alt="Residentes" style="width:40px; height:40px;">
                                <span class="mt-2" style="color: #5D737E;">Residentes</span>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a class="nav-link text-dark fw-bold d-flex flex-column align-items-center" href="listMedicamentos.php">
                                <img src="img/medicacao-icon.png" alt="Medicações" style="width:40px; height:40px;">
                                <span class="mt-2" style="color: #5D737E;">Medicações</span>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a class="nav-link text-dark fw-bold d-flex flex-column align-items-center" href="listConsultas.php">
                                <img src="img/Consulta-icon.png" alt="Consultas" style="width:40px; height:40px;">
                                <span class="mt-2" style="color: #5D737E;">Consultas agendadas</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="col-md-10 ms-sm-auto px-4">
                <div class="container text-center mt-3 mb-1">
                    <div class="row justify-content-center g-4 d-md-none">
                        <div class="col-4">
                            <a href="listResidentes.php" class="text-decoration-none text-dark">
                                <div class="circle-link mx-auto" style="border: 2px solid #5D737E; border-radius: 50%; padding: 10px; background-color: #f8f9fa; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    <img src="img/residentes-icon.png" alt="Ícone 1" class="circle-img">
                                </div>
                                <p class="mt-2 fw-bold" style="color: #5D737E;">Residentes</p>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="listConsultas.php" class="text-decoration-none text-dark">
                                <div class="circle-link mx-auto" style="border: 2px solid #5D737E; border-radius: 50%; padding: 10px; background-color: #f8f9fa; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    <img src="img/Consulta-icon.png" alt="Ícone 2" class="circle-img">
                                </div>
                                <p class="mt-2 fw-bold" style="color: #5D737E;">Consultas</p>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="listMedicamentos.php" class="text-decoration-none text-dark">
                                <div class="circle-link mx-auto" style="border: 2px solid #5D737E; border-radius: 50%; padding: 10px; background-color: #f8f9fa; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                    <img src="img/medicacao-icon.png" alt="Ícone 3" class="circle-img">
                                </div>
                                <p class="mt-2 fw-bold" style="color: #5D737E;">Medicações</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container mt-1">
                <div class="row justify-content-center" style="margin-left: -120px;">
                    <div class="col-md-6 mb-4">
                        <div class="card bg-white shadow-sm rounded-lg h-100">
                            <div class="card-body">
                                <h4 class="mb-4 text-center color1">Consultas agendadas <?= date('d/m/Y') ?></h4>
                                <?php if (count($consultasHoje) > 0): ?>
                                    <div class="table-responsive table-rounded" style="max-height: 400px; overflow-y: auto;">
                                        <table class="table table-bordered table-striped mb-0 text-center">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Paciente</th>
                                                    <th>Horário</th>
                                                    <th>Médico</th>
                                                    <th>Especialidade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($consultasHoje as $c): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($c['paciente']) ?></td>
                                                        <td><?= substr($c['horario'], 0, 5) ?></td>
                                                        <td><?= htmlspecialchars($c['medico']) ?></td>
                                                        <td><?= htmlspecialchars($c['especialidade']) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <p class="text-center text-muted mt-3">Nenhuma consulta agendada para hoje.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card bg-white shadow-sm rounded-lg h-100">
                            <div class="card-body">
                                <h4 class="mb-4 text-center color1">Medicação diária</h4>
                                <div class="table-responsive table-rounded" style="max-height: 400px; overflow-y: auto;">
                                    <table class="table table-bordered table-striped mb-0 text-center">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Horário</th>
                                                <th>Medicação</th>
                                                <th>Dosagem</th>
                                                <th>Paciente</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($medicamentos) > 0): ?>
                                                <?php foreach ($medicamentos as $med): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars(substr($med['horario'], 0, 5)) ?></td>
                                                        <td><?= htmlspecialchars($med['medicacao']) ?></td>
                                                        <td><?= htmlspecialchars($med['dosagem']) ?></td>
                                                        <td><?= htmlspecialchars($med['paciente']) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">Nenhum medicamento encontrado.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once "footer.php"; ?>