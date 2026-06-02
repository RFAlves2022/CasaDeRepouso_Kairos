<?php 
include_once "header.php"; 
?>

<main>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Vertical (NAVBAR DA DASHBOARD2) -->
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

            <!-- Conteúdo principal -->
            <div class="col-md-10 ms-sm-auto px-4 d-flex justify-content-center align-items-center" style="min-height: 100vh;">
                <section class="py-5 w-100" style="background: linear-gradient(135deg, #e0f7fa 0%, #f8fafc 100%); min-height: 100vh;">
                    <div class="container">
                        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
                            <div class="col-xl-9 col-lg-10 d-flex justify-content-start">
                                <div class="card shadow-lg border-0 rounded-4">
                                    <div class="card-header bg-gradient" style="background: linear-gradient(90deg, #5D737E 60%, #64B6AC 100%);">
                                        <h2 class="mb-0 text-white text-center py-3 d-flex justify-content-center align-items-center gap-3">
                                            <i class="bi bi-calendar2-week"></i> Rotina Diária do Residente
                                            <!-- Ícone de Alertas -->
                                            <button type="button" class="btn btn-link p-0 ms-3 align-middle" data-bs-toggle="modal" data-bs-target="#alertasModal" title="Ver Alertas">
                                                <i class="bi bi-bell-fill fs-3 text-warning"></i>
                                            </button>
                                            <!-- Ícone para ir para rotinaCadastro.php -->
                                            <a href="rotinaCadastro.php" class="btn btn-link p-0 ms-2 align-middle" title="Cadastrar/Editar Rotina">
                                                <i class="bi bi-pencil-square fs-3 text-info"></i>
                                            </a>
                                        </h2>
                                    </div>
                                    <div class="card-body p-5">
                                        <div class="row g-4">
                                            <!-- Hora de Acordar -->
                                            <div class="col-md-6">
                                                <div class="card border-0 shadow-sm" style="min-height: 120px;">
                                                    <div class="card-body text-center py-3">
                                                        <i class="bi bi-alarm fs-1 text-primary"></i>
                                                        <h5 class="mt-2 mb-1 text-secondary">Hora de Acordar</h5>
                                                        <p class="fs-4 fw-semibold mb-0">07:00</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Hora de Dormir -->
                                            <div class="col-md-6">
                                                <div class="card border-0 shadow-sm" style="min-height: 120px;">
                                                    <div class="card-body text-center py-3">
                                                        <i class="bi bi-moon-stars fs-1 text-dark"></i>
                                                        <h5 class="mt-2 mb-1 text-secondary">Hora de Dormir</h5>
                                                        <p class="fs-4 fw-semibold mb-0">21:30</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Horários das Refeições -->
                                            <div class="col-md-6">
                                                <div class="card border-0 shadow-sm h-100">
                                                    <div class="card-body">
                                                        <i class="bi bi-cup-straw fs-1 text-success d-block text-center"></i>
                                                        <h5 class="mt-3 mb-3 text-secondary text-center">Horários das Refeições</h5>
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                Café da manhã <span class="badge bg-success">07:30</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                Almoço <span class="badge bg-success">12:00</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                Lanche da tarde <span class="badge bg-success">15:30</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                Jantar <span class="badge bg-success">18:30</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Horários das Medicações -->
                                            <div class="col-md-6">
                                                <div class="card border-0 shadow-sm h-100">
                                                    <div class="card-body">
                                                        <i class="bi bi-capsule-pill fs-1 text-info d-block text-center"></i>
                                                        <h5 class="mt-3 mb-3 text-secondary text-center">Horários das Medicações</h5>
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                Manhã <span class="badge bg-info text-dark">08:00</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                Tarde <span class="badge bg-info text-dark">14:00</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                Noite <span class="badge bg-info text-dark">20:00</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Atividades Programadas -->
                                            <div class="col-md-6">
                                                <div class="card border-0 shadow-sm h-100">
                                                    <div class="card-body">
                                                        <i class="bi bi-people fs-1 text-warning d-block text-center"></i>
                                                        <h5 class="mt-3 mb-3 text-secondary text-center">Atividades Programadas</h5>
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item">
                                                                <span class="fw-bold text-primary">09:00</span> - Caminhada no jardim
                                                            </li>
                                                            <li class="list-group-item">
                                                                <span class="fw-bold text-primary">10:30</span> - Oficina de artesanato
                                                            </li>
                                                            <li class="list-group-item">
                                                                <span class="fw-bold text-primary">16:00</span> - Sessão de música
                                                            </li>
                                                            <li class="list-group-item">
                                                                <span class="fw-bold text-primary">17:00</span> - Leitura em grupo
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Cuidados Especiais -->
                                            <div class="col-md-6">
                                                <div class="card border-0 shadow-sm h-100">
                                                    <div class="card-body">
                                                        <i class="bi bi-shield-plus fs-1 text-danger d-block text-center"></i>
                                                        <h5 class="mt-3 mb-3 text-secondary text-center">Cuidados Especiais</h5>
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item">
                                                                <span class="fw-bold text-danger">Alimentação restrita:</span> Sem açúcar
                                                            </li>
                                                            <li class="list-group-item">
                                                                <span class="fw-bold text-danger">Atenção:</span> Alergia a penicilina
                                                            </li>
                                                            <li class="list-group-item">
                                                                <span class="fw-bold text-danger">Monitorar:</span> Pressão arterial após o almoço
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Observações do Dia -->
                                            <div class="col-md-6">
                                                <div class="card border-0 shadow-sm h-100">
                                                    <div class="card-body">
                                                        <i class="bi bi-journal-text fs-1 text-secondary d-block text-center"></i>
                                                        <h5 class="mt-3 mb-3 text-secondary text-center">Observações do Dia</h5>
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item">
                                                                Dormiu bem durante a noite.
                                                            </li>
                                                            <li class="list-group-item">
                                                                Participou de todas as atividades.
                                                            </li>
                                                            <li class="list-group-item">
                                                                Apresentou leve cansaço após a caminhada.
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal de Alertas -->
                                            <div class="modal fade" id="alertasModal" tabindex="-1" aria-labelledby="alertasModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning">
                                                            <h5 class="modal-title text-dark" id="alertasModalLabel">
                                                                <i class="bi bi-exclamation-triangle-fill"></i> Alertas
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item text-warning fw-semibold">
                                                                    <i class="bi bi-exclamation-circle"></i> Medicação da tarde atrasada ontem.
                                                                </li>
                                                                <li class="list-group-item text-warning fw-semibold">
                                                                    <i class="bi bi-exclamation-circle"></i> Consultar fisioterapeuta sobre dor no joelho.
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Fim Modal de Alertas -->
                                        </div><!-- row -->
                                    </div><!-- card-body -->
                                </div><!-- card -->
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>

<!-- Bootstrap Icons CDN (adicione no <head> do seu header.php se ainda não tiver) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<?php include_once "footer.php"; ?>
