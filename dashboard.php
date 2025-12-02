<?php
include_once "header.php";
include_once "dashboardQuerys.php";
?>

<style>
body {
  background: linear-gradient(120deg, #e7faf2 0%, #f8fafc 100%) !important;
}

.kairos-dashboard-header {
  margin-bottom:24px;
}
.kairos-dashboard-header p {
  color:#81A093;font-size:.98rem;margin-bottom:0;
}

/* Atalhos menores */
.dashboard-shortcuts .shortcut-card{
  background:#ffffff;
  border-radius:999px;
  box-shadow:0 3px 10px rgba(18,77,48,.06);
  border:1px solid #D3E1D9;
  transition: box-shadow .16s, transform .16s, background .16s;
  cursor:pointer;
  padding:6px 10px;
  display:flex;
  align-items:center;
  gap:10px;
}
.dashboard-shortcuts .shortcut-card:hover {
  box-shadow:0 8px 20px rgba(18,77,48,.16);
  background:#f4fbf7;
  transform:translateY(-2px);
}
.dashboard-shortcuts .shortcut-card .icon{
  width:30px;height:30px;
  display:flex;align-items:center;justify-content:center;
  border-radius:50%;
  background:linear-gradient(180deg,#e3faef 0,#e7faf2 100%);
  flex-shrink:0;
}
.dashboard-shortcuts .shortcut-card img{
  width:20px;height:20px;
}
.dashboard-shortcuts .shortcut-label{
  font-weight:600;
  color:#2D614B;
  font-size:.92rem;
  text-align:left;
  margin-bottom:0;
}

/* Cards principais */
.dashboard-card {
  border-radius:26px !important;
  border:1px solid #dbebe1 !important;
  background:#fff !important;
  box-shadow:0 8px 38px rgba(31,91,54,0.09) !important;
  min-height:350px;
}
.dashboard-card .icon-title{
  font-size:1.4rem; color:#5d737e; margin-right:4px;
}
.dashboard-card h2 {
  color:#1F5B36;font-weight:700;font-size:1.13rem;margin-bottom:2px;
  display:flex;align-items:center;gap:6px;
}
.dashboard-card .dashboard-block-subtitle {
  font-size:.93rem;color:#80a094;font-weight:400;
}
.dashboard-card table thead{
  background:#F6FBF8;
  color:#518066;font-size:.95rem;
}
.dashboard-card table tbody tr:nth-child(even){
  background:#f8fbfa;
}
.dashboard-card table{
  border-radius:14px;overflow:hidden;
}

@media (max-width:991.98px){
  .dashboard-card{margin-bottom:20px;}
}
</style>

<main class="py-4">
  <div class="container">
    <!-- Atalhos menores -->
    <section class="dashboard-shortcuts mb-4">
      <div class="row g-2">
        <?php
        $atalhos = [
          ['href' => 'listResidentes.php',   'img' => 'img/residentes-icon.png', 'label' => 'Residentes'],
          ['href' => 'listConsultas.php',    'img' => 'img/Consulta-icon.png',   'label' => 'Consultas'],
          ['href' => 'listMedicamentos.php', 'img' => 'img/medicacao-icon.png',  'label' => 'Medicamentos'],
          ['href' => 'rotina.php',           'img' => 'img/rotina-icon.png',     'label' => 'Rotina'],
        ];
        foreach ($atalhos as $at) : ?>
          <div class="col-6 col-md-3">
            <a href="<?= $at['href'] ?>" class="text-decoration-none d-block">
              <div class="shortcut-card">
                <div class="icon">
                  <img src="<?= $at['img']; ?>" alt="<?= $at['label']; ?>">
                </div>
                <div class="shortcut-label"><?= $at['label']; ?></div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Cards principais -->
    <section>
      <div class="row g-4">

        <!-- Consultas agendadas -->
        <div class="col-md-6">
          <div class="card dashboard-card p-0">
            <div class="card-body pb-2">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                  <h2><i class="bi bi-clipboard2-pulse icon-title"></i>Consultas</h2>
                  <span class="dashboard-block-subtitle">Hoje • <?= date('d/m/Y') ?></span>
                </div>
                <a href="listConsultas.php"
                   class="btn btn-sm"
                   style="border-radius:999px;border:1px solid #1F5B36;color:#1F5B36;background-color:#F8FBF9;font-size:0.91rem;">
                  Ver tudo
                </a>
              </div>

              <?php if (count($consultasHoje) > 0): ?>
                <div class="table-responsive" style="max-height:270px;overflow-y:auto;">
                  <table class="table align-middle mb-0">
                    <thead>
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
                <p class="text-muted text-center mt-3" style="font-size:0.97rem;">
                  Nenhuma consulta agendada para hoje.
                </p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Medicação diária -->
        <div class="col-md-6">
          <div class="card dashboard-card p-0">
            <div class="card-body pb-2">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                  <h2><i class="bi bi-capsule icon-title"></i>Medicação diária</h2>
                  <span class="dashboard-block-subtitle">Doses de hoje</span>
                </div>
                <a href="listMedicamentos.php"
                   class="btn btn-sm"
                   style="border-radius:999px;border:1px solid #1F5B36;color:#1F5B36;background-color:#F8FBF9;font-size:0.91rem;">
                  Ver tudo
                </a>
              </div>
              <div class="table-responsive" style="max-height:270px;overflow-y:auto;">
                <table class="table align-middle mb-0">
                  <thead>
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
                        <td colspan="4" class="text-center text-muted" style="font-size:0.97rem;">
                          Nenhum medicamento encontrado.
                        </td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

  </div>
</main>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<?php include_once "footer.php"; ?>
