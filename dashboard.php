<?php
include_once "header.php";
include_once "dashboardQuerys.php";

// Garantir que as variáveis existem
$consultasHoje = isset($consultasHoje) ? $consultasHoje : [];
$consultasTodas = isset($consultasTodas) ? $consultasTodas : [];
$medicamentos = isset($medicamentos) ? $medicamentos : [];

// Contar registros
$consultasHojeCount = count($consultasHoje);
$medicamentosCount = count($medicamentos);
$consultasTodasCount = count($consultasTodas);

// Total de residentes
try {
    $totalResidentes = $pdo->query("SELECT COUNT(*) as total FROM tb_residentes")->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
} catch (Exception $e) {
    $totalResidentes = 0;
}
?>

<style>
main {
  padding-bottom: 100px;
}

.dashboard-header {
  margin-bottom: 32px;
}

.dashboard-header h1 {
  font-size: 2rem;
  font-weight: 700;
  color: #1F5B36;
  margin-bottom: 4px;
}

.dashboard-header p {
  color: #71827A;
  font-size: 0.98rem;
  margin-bottom: 0;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 18px;
  margin-bottom: 32px;
}

.stat-card {
  background: #FFFFFF;
  border-radius: 18px;
  border: 1px solid #D5E3DC;
  padding: 20px;
  box-shadow: 0 4px 12px rgba(31, 91, 54, 0.06);
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 14px;
}

.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(31, 91, 54, 0.1);
  background: #F8FBF9;
}

.stat-icon {
  width: 52px;
  height: 52px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.6rem;
  flex-shrink: 0;
}

.stat-icon.residents {
  background: #E0F5F2;
}

.stat-icon.consultas {
  background: #FFE8E8;
}

.stat-icon.medicamentos {
  background: #E8F0FF;
}

.stat-icon.agenda {
  background: #FFF3E0;
}

.stat-content h3 {
  font-size: 0.9rem;
  color: #71827A;
  font-weight: 500;
  margin: 0 0 6px 0;
}

.stat-content .number {
  font-size: 1.8rem;
  font-weight: 700;
  color: #1F5B36;
  margin: 0;
}

.shortcuts-section {
  margin-bottom: 32px;
}

.shortcuts-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
  gap: 12px;
}

.shortcut-card {
  background: #FFFFFF;
  border-radius: 14px;
  border: 1px solid #D5E3DC;
  padding: 14px;
  box-shadow: 0 2px 8px rgba(31, 91, 54, 0.04);
  transition: all 0.3s ease;
  cursor: pointer;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  text-decoration: none;
  color: inherit;
  text-align: center;
}

.shortcut-card:hover {
  box-shadow: 0 6px 16px rgba(31, 91, 54, 0.1);
  background: #F4FBF7;
  transform: translateY(-2px);
}

.shortcut-card .icon {
  font-size: 1.8rem;
}

.shortcut-card .label {
  font-weight: 600;
  color: #2D614B;
  font-size: 0.88rem;
}

.dashboard-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
  gap: 20px;
  margin-bottom: 24px;
}

.content-card {
  background: #FFFFFF;
  border-radius: 20px;
  border: 1px solid #D5E3DC;
  box-shadow: 0 6px 20px rgba(31, 91, 54, 0.07);
  overflow: hidden;
}

.content-card-header {
  padding: 18px 20px;
  border-bottom: 1px solid #E5EDE7;
  background: linear-gradient(180deg, #F9FBF9 0%, #FFFFFF 100%);
}

.content-card-header h2 {
  color: #1F5B36;
  font-weight: 700;
  font-size: 1.1rem;
  margin: 0 0 2px 0;
  display: flex;
  align-items: center;
  gap: 6px;
}

.content-card-header .subtitle {
  font-size: 0.85rem;
  color: #71827A;
  margin: 0;
}

.content-card-body {
  padding: 16px 20px;
}

.content-card table {
  margin-bottom: 0;
  font-size: 0.9rem;
}

.content-card table thead {
  background: #F6FBF8;
  color: #518066;
  font-weight: 600;
  font-size: 0.85rem;
}

.content-card table tbody tr {
  border-bottom: 1px solid #E5EDE7;
}

.content-card table tbody tr:hover {
  background: #F9FBFA;
}

.content-card table td {
  padding: 12px 8px;
  vertical-align: middle;
  color: #3D5245;
}

.empty-state {
  text-align: center;
  padding: 32px 16px;
  color: #80a094;
}

.empty-state-icon {
  font-size: 2.6rem;
  margin-bottom: 8px;
  opacity: 0.4;
}

.empty-state p {
  margin: 0;
  font-size: 0.95rem;
}

.view-all-btn {
  display: inline-block;
  border-radius: 999px;
  border: 1px solid #1F5B36;
  color: #1F5B36;
  background: #F6FBF8;
  padding: 6px 14px;
  font-size: 0.85rem;
  font-weight: 500;
  text-decoration: none;
  transition: all 0.3s ease;
}

.view-all-btn:hover {
  background: #1F5B36;
  color: #FFFFFF;
}

@media (max-width: 991.98px) {
  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .dashboard-cards {
    grid-template-columns: 1fr;
  }

  .shortcuts-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 576px) {
  .dashboard-header h1 {
    font-size: 1.6rem;
  }

  .stats-grid {
    grid-template-columns: 1fr;
  }

  .shortcuts-grid {
    grid-template-columns: 1fr;
  }

  .stat-card {
    padding: 16px;
  }

  .content-card-body {
    padding: 12px 16px;
  }
}
</style>

<main class="py-4">
  <div class="container-lg">
    <!-- Cabeçalho -->
    <div class="dashboard-header">
      <h1>📊 Dashboard</h1>
      <p>Bem-vindo! Acompanhe as atividades e informações importantes de hoje</p>
    </div>

    <!-- Cards de Estatísticas -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon residents">👥</div>
        <div class="stat-content">
          <h3>Total de Residentes</h3>
          <p class="number"><?= $totalResidentes ?></p>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon consultas">🩺</div>
        <div class="stat-content">
          <h3>Consultas Hoje</h3>
          <p class="number"><?= $consultasHojeCount ?></p>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon medicamentos">💊</div>
        <div class="stat-content">
          <h3>Medicações</h3>
          <p class="number"><?= $medicamentosCount ?></p>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon agenda">📅</div>
        <div class="stat-content">
          <h3>Total de Consultas</h3>
          <p class="number"><?= $consultasTodasCount ?></p>
        </div>
      </div>
    </div>

    <!-- Atalhos Rápidos -->
    <div class="shortcuts-section">
      <h3 style="color: #1F5B36; font-weight: 600; margin-bottom: 16px; font-size: 1rem;">
        Acessos Rápidos
      </h3>
      <div class="shortcuts-grid">
        <a href="frmCadResidente.php" class="shortcut-card">
          <div class="icon">➕</div>
          <div class="label">Novo Residente</div>
        </a>
        <a href="listResidentes.php" class="shortcut-card">
          <div class="icon">👥</div>
          <div class="label">Residentes</div>
        </a>
        <a href="listConsultas.php" class="shortcut-card">
          <div class="icon">📋</div>
          <div class="label">Consultas</div>
        </a>
        <a href="listMedicamentos.php" class="shortcut-card">
          <div class="icon">💊</div>
          <div class="label">Medicamentos</div>
        </a>
        <a href="rotina.php" class="shortcut-card">
          <div class="icon">⏱️</div>
          <div class="label">Rotina</div>
        </a>
        <a href="profile.php" class="shortcut-card">
          <div class="icon">⚙️</div>
          <div class="label">Meu Perfil</div>
        </a>
      </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="dashboard-cards">
      <!-- Consultas de Hoje -->
      <div class="content-card">
        <div class="content-card-header">
          <h2>
            <span>🩺</span>
            Consultas de Hoje
          </h2>
          <p class="subtitle">Agenda do dia • <?= date('d/m/Y') ?></p>
        </div>
        <div class="content-card-body">
          <?php if ($consultasHojeCount > 0): ?>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Paciente</th>
                    <th>Horário</th>
                    <th>Médico</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($consultasHoje as $consulta): ?>
                    <tr>
                      <td><?= htmlspecialchars($consulta['paciente']) ?></td>
                      <td><strong><?= htmlspecialchars(substr($consulta['horario'], 0, 5)) ?></strong></td>
                      <td><?= htmlspecialchars($consulta['medico']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php else: ?>
            <div class="empty-state">
              <div class="empty-state-icon">📭</div>
              <p>Nenhuma consulta agendada para hoje</p>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Medicações -->
      <div class="content-card">
        <div class="content-card-header">
          <h2>
            <span>💊</span>
            Medicações Programadas
          </h2>
          <p class="subtitle">Próximos horários</p>
        </div>
        <div class="content-card-body">
          <?php if ($medicamentosCount > 0): ?>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Horário</th>
                    <th>Medicação</th>
                    <th>Dosagem</th>
                    <th>Paciente</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach (array_slice($medicamentos, 0, 6) as $med): ?>
                    <tr>
                      <td><strong><?= htmlspecialchars(substr($med['horario'], 0, 5)) ?></strong></td>
                      <td><?= htmlspecialchars($med['medicacao']) ?></td>
                      <td><?= htmlspecialchars($med['dosagem']) ?></td>
                      <td><?= htmlspecialchars($med['paciente']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php else: ?>
            <div class="empty-state">
              <div class="empty-state-icon">✓</div>
              <p>Nenhuma medicação programada</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

  </div>
</main>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<?php include_once "footer.php"; ?>
