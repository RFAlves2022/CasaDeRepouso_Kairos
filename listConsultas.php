<?php
include_once "header.php";
include_once "dbConnection.php"; 
$search = $_GET['search'] ?? '';
include_once "consultasQuerys.php";
?>

<style>
  body{
    background-color:#E5F2E8;
  }

  .page-shell{
    max-width:1120px;
    margin:0 auto;
    padding:24px 16px 40px;
  }

  .page-card{
    background:#FFFFFF;
    border-radius:24px;
    box-shadow:0 18px 40px rgba(12,39,26,0.12);
    border:1px solid #D5E3DC;
    padding:24px 28px 28px;
  }

  @media (max-width: 767.98px){
    .page-card{padding:20px 16px;}
  }

  .page-header-title{
    font-size:1.9rem;
    font-weight:700;
    color:#1F5B36;
  }

  .page-header-sub{
    font-size:0.95rem;
    color:#71827A;
  }

  .search-shell{
    margin-top:20px;
    margin-bottom:16px;
  }

  .search-input{
    border-radius:999px;
    border:1px solid #C4D5CD;
    padding-left:40px;
  }

  .search-input:focus{
    border-color:#1F5B36;
    box-shadow:0 0 0 0.16rem rgba(31,91,54,0.18);
  }

  .search-icon{
    position:absolute;
    left:14px;
    top:50%;
    transform:translateY(-50%);
    color:#8A9B93;
  }

  .btn-filter{
    border-radius:999px;
    border:1px solid #1F5B36;
    color:#1F5B36;
    background:#F6FBF8;
    font-size:0.9rem;
    padding-inline:18px;
  }

  .btn-new-consulta{
    border-radius:999px;
    background:#1F5B36;
    border:none;
    color:#FFFFFF;
    font-size:0.9rem;
    padding-inline:18px;
  }

  .table-shell{
    border-radius:18px;
    overflow:hidden;
    border:1px solid #E0E9E3;
    background:#FBFDFC;
  }

  .table thead{
    background:#F5FAF7;
    font-size:0.86rem;
    color:#5F7068;
  }

  .table tbody td{
    font-size:0.9rem;
    vertical-align:middle;
  }

  .badge-status{
    border-radius:999px;
    padding:2px 10px;
    font-size:0.78rem;
  }

  .form-section-title{
    font-size:1.2rem;
    font-weight:600;
    color:#1F5B36;
  }
</style>

<main>
  <div class="page-shell">

    <?php if (isset($_SESSION['message'])): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php unset($_SESSION['message']); ?>
    <?php elseif (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $_SESSION['error'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="page-card mb-4">
      <!-- Cabeçalho -->
      <header class="mb-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <a href="dashboard.php" class="btn btn-sm"
             style="border-radius:999px;border:1px solid #1F5B36;color:#1F5B36;background:#F6FBF8;">
            Voltar
          </a>
        </div>
        <h1 class="page-header-title mb-1">Consultas</h1>
        <p class="page-header-sub mb-0">
          Controle consultas por residente, data, horário e prescrição.
        </p>
      </header>

      <!-- Busca -->
      <section class="search-shell">
        <form method="GET" class="row g-2 align-items-center">
          <div class="col-12 col-md-7 position-relative">
            <span class="search-icon">
              <i class="bi bi-search"></i>
            </span>
            <input type="text"
                   name="search"
                   class="form-control search-input"
                   placeholder="Buscar por residente ou médico"
                   value="<?= htmlspecialchars($search) ?>">
          </div>
          <div class="col-6 col-md-2">
            <button class="btn btn-filter w-100" type="submit">Filtrar</button>
          </div>
          <div class="col-6 col-md-3 text-md-end">
            <button type="button" class="btn btn-new-consulta w-100 w-md-auto"
                    onclick="document.getElementById('new-button').click();">
              Nova consulta
            </button>
          </div>
        </form>
      </section>

      <!-- Tabela -->
      <section class="mb-4">
        <div class="table-responsive table-shell" style="max-height:400px;overflow-y:auto;">
          <table class="table mb-0 text-center align-middle">
            <thead>
              <tr>
                <th>Residente</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Médico</th>
                <th>Especialidade</th>
                <th>Observações</th>
                <th>Prescrição</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
              usort($consultas, function($a, $b) {
                  $dataA = strtotime($a['data_consulta'] . ' ' . $a['horario']);
                  $dataB = strtotime($b['data_consulta'] . ' ' . $b['horario']);
                  return $dataA <=> $dataB;
              });
              $hoje = strtotime(date('Y-m-d'));
              ?>
              <?php if (count($consultas) > 0): ?>
                <?php foreach ($consultas as $consulta): ?>
                  <?php
                    $dataConsulta = strtotime($consulta['data_consulta']);
                    $rowClass = '';
                    if ($dataConsulta < $hoje) {
                      $rowClass = 'table-danger';
                    } elseif ($dataConsulta === $hoje) {
                      $rowClass = 'table-success';
                    }
                  ?>
                  <tr class="editable-row <?= $rowClass ?>"
                      data-id="<?= $consulta['id'] ?>"
                      data-resident_id="<?= $consulta['resident_id'] ?>"
                      data-data_consulta="<?= $consulta['data_consulta'] ?>"
                      data-horario="<?= $consulta['horario'] ?>"
                      data-medico="<?= htmlspecialchars($consulta['medico']) ?>"
                      data-especialidade="<?= htmlspecialchars($consulta['especialidade']) ?>"
                      data-observacoes="<?= htmlspecialchars($consulta['observacoes']) ?>"
                      data-prescricao="<?= htmlspecialchars($consulta['prescricao']) ?>">
                    <td><?= htmlspecialchars($consulta['residente']) ?></td>
                    <td><?= htmlspecialchars(date('d/m/Y', strtotime($consulta['data_consulta']))) ?></td>
                    <td><?= htmlspecialchars(substr($consulta['horario'], 0, 5)) ?></td>
                    <td><?= htmlspecialchars($consulta['medico']) ?></td>
                    <td><?= htmlspecialchars($consulta['especialidade']) ?></td>
                    <td class="text-start"><?= htmlspecialchars($consulta['observacoes']) ?></td>
                    <td class="text-start"><?= htmlspecialchars($consulta['prescricao']) ?></td>
                    <td>
                      <form method="POST" class="d-inline">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $consulta['id'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm"
                                style="border-radius:999px;"
                                onclick="return confirm('Tem certeza que deseja excluir esta consulta?')">
                          Excluir
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="8" class="text-center">Nenhuma consulta encontrada.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Formulário -->
      <section class="mt-3">
        <h2 class="form-section-title text-center mb-3">Gerenciar consulta</h2>
        <form method="POST" class="mt-2">
          <input type="hidden" name="action" id="form-action" value="create">
          <input type="hidden" name="id" id="consulta-id">

          <div class="row mb-3">
            <div class="col-md-4">
              <label for="resident_id" class="form-label">Residente</label>
              <select class="form-select" id="resident_id" name="resident_id" required>
                <?php
                $residentes = $pdo->query("SELECT id, nome FROM tb_residentes ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);
                if (count($residentes) > 0):
                  echo "<option value='' disabled selected>Selecione um residente</option>";
                  foreach ($residentes as $residente) {
                    echo "<option value='{$residente['id']}'>{$residente['nome']}</option>";
                  }
                else:
                  echo "<option value='' disabled selected>Nenhum residente disponível</option>";
                endif;
                ?>
              </select>
              <?php if (count($residentes) === 0): ?>
                <div class="mt-2">
                  <a href="cadastrarResidente.php" class="btn btn-sm btn-primary">Cadastrar Residente</a>
                </div>
              <?php endif; ?>
            </div>
            <div class="col-md-4">
              <label for="data_consulta" class="form-label">Data da consulta</label>
              <input type="date" class="form-control" id="data_consulta" name="data_consulta" required>
            </div>
            <div class="col-md-4">
              <label for="horario" class="form-label">Horário</label>
              <input type="time" class="form-control" id="horario" name="horario">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-4">
              <label for="medico" class="form-label">Médico</label>
              <input type="text" class="form-control" id="medico" name="medico" required>
            </div>
            <div class="col-md-4">
              <label for="especialidade" class="form-label">Especialidade</label>
              <input type="text" class="form-control" id="especialidade" name="especialidade">
            </div>
            <div class="col-md-4">
              <label for="observacoes" class="form-label">Observações</label>
              <textarea class="form-control" id="observacoes" name="observacoes" rows="1"></textarea>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-12">
              <label for="prescricao" class="form-label">Prescrição</label>
              <textarea class="form-control" id="prescricao" name="prescricao" rows="2"></textarea>
            </div>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-success px-4"
                    style="background-color:#64B6AC;border:none;border-radius:999px;"
                    id="submit-button">
              Cadastrar consulta
            </button>
            <button type="button" class="btn btn-secondary ms-2 px-4"
                    style="background-color:#5D737E;border:none;border-radius:999px;"
                    id="new-button">
              Limpar
            </button>
          </div>
        </form>
      </section>

    </div>
  </div>
</main>

<script src="consultasEvents.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const rows = document.querySelectorAll('.editable-row');
  rows.forEach(row => {
    row.addEventListener('click', function() {
      rows.forEach(r => r.classList.remove('table-warning'));
      this.classList.add('table-warning');
    });
  });
});
</script>

<?php include_once "footer.php"; ?>
