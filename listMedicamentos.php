<?php
include_once "header.php";
include_once "dbConnection.php"; 
$search = $_GET['search'] ?? '';
require "medQuerys.php";
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

  .btn-new-med{
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

  .form-section-title{
    font-size:1.2rem;
    font-weight:600;
    color:#1F5B36;
  }
</style>

<main>
  <div class="page-shell">
    <div class="page-card mb-4">

      <!-- Cabeçalho -->
      <header class="mb-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <a href="dashboard.php" class="btn btn-sm"
             style="border-radius:999px;border:1px solid #1F5B36;color:#1F5B36;background:#F6FBF8;">
            Voltar
          </a>
        </div>
        <h1 class="page-header-title mb-1">Medicamentos</h1>
        <p class="page-header-sub mb-0">
          Gerencie prescrições, horários, doses e vias de administração.
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
                   placeholder="Buscar por residente ou medicamento"
                   value="<?= htmlspecialchars($search) ?>">
          </div>
          <div class="col-6 col-md-2">
            <button class="btn btn-filter w-100" type="submit">Filtrar</button>
          </div>
          <div class="col-6 col-md-3 text-md-end">
            <button type="button" class="btn btn-new-med w-100 w-md-auto"
                    onclick="document.getElementById('new-button').click();">
              Novo medicamento
            </button>
          </div>
        </form>
      </section>

      <!-- Tabela -->
      <section>
        <div class="table-responsive table-shell flex-grow-1" style="max-height:400px;overflow-y:auto;">
          <table class="table mb-0 text-center align-middle">
            <thead>
              <tr>
                <th>Residente</th>
                <th>Medicamento</th>
                <th>Horário</th>
                <th>Dosagem</th>
                <th>Via de administração</th>
                <th>Observações</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php if (count($medicamentos) > 0): ?>
                <?php foreach ($medicamentos as $med): ?>
                  <tr class="editable-row"
                      data-id="<?= $med['id'] ?>"
                      data-resident_id="<?= $med['resident_id'] ?>"
                      data-nome_medicamento="<?= htmlspecialchars($med['nome_medicamento']) ?>"
                      data-horario="<?= htmlspecialchars($med['horario']) ?>"
                      data-dosagem="<?= htmlspecialchars($med['dosagem']) ?>"
                      data-via_adm="<?= htmlspecialchars($med['via_adm']) ?>"
                      data-observacoes="<?= htmlspecialchars($med['observacoes']) ?>">
                    <td><?= htmlspecialchars($med['residente']) ?></td>
                    <td><?= htmlspecialchars($med['nome_medicamento']) ?></td>
                    <td><?= htmlspecialchars(substr($med['horario'], 0, 5)) ?></td>
                    <td><?= htmlspecialchars($med['dosagem']) ?></td>
                    <td><?= htmlspecialchars($med['via_adm']) ?></td>
                    <td class="text-start"><?= htmlspecialchars($med['observacoes']) ?></td>
                    <td>
                      <form method="POST" class="d-inline">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $med['id'] ?>">
                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                style="border-radius:999px;"
                                onclick="return confirm('Tem certeza que deseja excluir este medicamento?')">
                          Excluir
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="7" class="text-center">Nenhum medicamento encontrado.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Formulário -->
      <section class="mt-4">
        <h2 class="form-section-title text-center">Gerenciar medicamento</h2>
        <form method="POST" class="mt-3">
          <input type="hidden" name="action" id="form-action" value="create">
          <input type="hidden" name="id" id="medicamento-id">

          <div class="row mb-3">
            <div class="col-md-4">
              <label for="resident_id" class="form-label">Residente</label>
              <select class="form-select" id="resident_id" name="resident_id" required>
                <?php
                $residentes = $pdo->query("SELECT id, nome FROM tb_residentes ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($residentes as $residente) {
                  echo "<option value='{$residente['id']}'>{$residente['nome']}</option>";
                }
                ?>
              </select>
            </div>
            <div class="col-md-4">
              <label for="nome_medicamento" class="form-label">Nome do medicamento</label>
              <input type="text" class="form-control" id="nome_medicamento" name="nome_medicamento" required>
            </div>
            <div class="col-md-4">
              <label for="horario" class="form-label">Horário</label>
              <input type="time" class="form-control" id="horario" name="horario" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-4">
              <label for="dosagem" class="form-label">Dosagem</label>
              <input type="text" class="form-control" id="dosagem" name="dosagem" required>
            </div>
            <div class="col-md-4">
              <label for="via_adm" class="form-label">Via de administração</label>
              <input type="text" class="form-control" id="via_adm" name="via_adm" required>
            </div>
            <div class="col-md-4">
              <label for="observacoes" class="form-label">Observações</label>
              <textarea class="form-control" id="observacoes" name="observacoes" rows="1"></textarea>
            </div>
          </div>

          <div class="text-center">
            <button type="submit"
                    class="btn btn-success px-4"
                    style="background-color:#64B6AC;border:none;border-radius:999px;"
                    id="submit-button">
              Cadastrar medicamento
            </button>
            <button type="button"
                    class="btn btn-secondary ms-2 px-4"
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

<script src="medEvents.js"></script>

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
