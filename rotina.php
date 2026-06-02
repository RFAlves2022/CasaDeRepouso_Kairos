<?php 
include_once "header.php"; 
include_once "dbConnection.php";

/* --- backend original mantido --- */
$residentes = [];
try {
    $stmt = $pdo->query("
        SELECT r.id, r.nome 
        FROM tb_residentes r
        INNER JOIN tb_rotina_residente rr ON rr.resident_id = r.id
        GROUP BY r.id, r.nome
        ORDER BY r.nome
    ");
    $residentes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo '<div class="alert alert-danger text-center">Erro ao buscar residentes: ' . htmlspecialchars($e->getMessage()) . '</div>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nova_observacao'])) {
    $residente_id = $_POST['residente_id'];
    $observacao = trim($_POST['observacao']);

    if ($residente_id && $observacao) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tb_observacoes_dia (resident_id, observacao) VALUES (?, ?)");
            $stmt->execute([$residente_id, $observacao]);
            echo '<div class="alert alert-success text-center">Observação cadastrada com sucesso!</div>';
        } catch (Exception $e) {
            echo '<div class="alert alert-danger text-center">Erro ao cadastrar observação: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    }
}

$residente_id = $_GET['residente_id'] ?? ($_POST['residente_id'] ?? '');
$residente = null;
$rotina = null;
$atividades = [];
$cuidados = '';
$observacoes = [];

if ($residente_id) {
    $stmt = $pdo->prepare("SELECT * FROM tb_residentes WHERE id = ?");
    $stmt->execute([$residente_id]);
    $residente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($residente) {
        $stmt = $pdo->prepare("SELECT * FROM tb_rotina_residente WHERE resident_id = ? ORDER BY criado_em DESC LIMIT 1");
        $stmt->execute([$residente['id']]);
        $rotina = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($rotina) {
            $stmt = $pdo->prepare("SELECT * FROM tb_rotina_atividade WHERE rotina_id = ? ORDER BY hora");
            $stmt->execute([$rotina['id']]);
            $atividades = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $cuidados = $rotina['cuidados_especiais'];
        }
    }
}

if ($residente_id) {
    $stmt = $pdo->prepare("SELECT observacao, data_hora FROM tb_observacoes_dia WHERE resident_id = ? ORDER BY data_hora DESC");
    $stmt->execute([$residente_id]);
    $observacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<style>
  body{
    background-color:#E5F2E8;
  }

  .page-shell{
    max-width:1120px;
    margin:0 auto;
    padding:32px 16px 40px;
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
    margin-bottom:20px;
  }

  .search-select{
    border-radius:999px 0 0 999px;
    border:1px solid #C4D5CD;
  }

  .search-select:focus{
    border-color:#1F5B36;
    box-shadow:0 0 0 0.16rem rgba(31,91,54,0.18);
  }

  .btn-search{
    border-radius:0 999px 999px 0;
    background:#1F5B36;
    border:none;
    color:#FFFFFF;
  }

  .summary-card{
    border-radius:20px;
    border:1px solid #E0E9E3;
    background:#FBFDFC;
  }

  .summary-icon{
    font-size:2.2rem;
  }

  .section-title{
    font-size:1.1rem;
    font-weight:600;
    color:#2D4E3B;
  }

  .list-group-item{
    border-color:#EDF3F0;
  }

  .badge-time{
    border-radius:999px;
    padding:4px 10px;
    font-size:0.8rem;
  }

  .btn-pill-primary{
    border-radius:999px;
    border:1px solid #1F5B36;
    background:#F6FBF8;
    color:#1F5B36;
    font-size:0.9rem;
  }

  .btn-pill-accent{
    border-radius:999px;
    background:#64B6AC;
    border:none;
    color:#FFFFFF;
    font-size:0.9rem;
  }
</style>

<main>
  <div class="page-shell">
    <div class="page-card">

      <!-- Cabeçalho no estilo dashboard -->
      <header class="mb-3 d-flex justify-content-between align-items-start flex-wrap gap-2">
        <div>
          <h1 class="page-header-title mb-1">Rotina diária</h1>
          <p class="page-header-sub mb-0">
            Consulte horários, atividades, medicações e observações de cada residente.
          </p>
        </div>
        <a href="rotinaCadastro.php" class="btn btn-pill-primary">
          <i class="bi bi-pencil-square me-1"></i> Cadastrar / editar rotina
        </a>
      </header>

      <!-- Seletor de residente -->
      <section class="search-shell text-center">
        <form class="d-flex justify-content-center" method="get" action="rotina.php">
          <div class="input-group" style="max-width:420px;">
            <select class="form-select search-select" name="residente_id" required>
              <option value="">Selecione o residente...</option>
              <?php foreach ($residentes as $r): ?>
                <option value="<?= $r['id'] ?>" <?= ($residente_id == $r['id']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($r['nome']) ?>
                </option>
              <?php endforeach; ?>
            </select>
            <button class="btn btn-search" type="submit">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </form>
      </section>

      <?php if ($residente && $rotina): ?>
        <!-- Cards resumo horários acordar/dormir -->
        <section class="mb-3">
          <div class="row g-3">
            <div class="col-md-6">
              <div class="card summary-card">
                <div class="card-body text-center py-3">
                  <i class="bi bi-alarm summary-icon text-success"></i>
                  <div class="mt-2 section-title">Hora de acordar</div>
                  <div class="fs-4 fw-semibold">
                    <?= htmlspecialchars(substr($rotina['hora_acordar'],0,5)) ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card summary-card">
                <div class="card-body text-center py-3">
                  <i class="bi bi-moon-stars summary-icon text-secondary"></i>
                  <div class="mt-2 section-title">Hora de dormir</div>
                  <div class="fs-4 fw-semibold">
                    <?= htmlspecialchars(substr($rotina['hora_dormir'],0,5)) ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Blocos principais -->
        <section class="mt-2">
          <div class="row g-3">

            <!-- Refeições -->
            <div class="col-md-6">
              <div class="card summary-card h-100">
                <div class="card-body">
                  <div class="text-center">
                    <i class="bi bi-cup-straw summary-icon text-success"></i>
                    <div class="mt-2 section-title">Horários das refeições</div>
                  </div>
                  <ul class="list-group list-group-flush mt-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Café da manhã
                      <span class="badge bg-success badge-time">
                        <?= htmlspecialchars(substr($rotina['refeicao_cafe'],0,5)) ?>
                      </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Almoço
                      <span class="badge bg-success badge-time">
                        <?= htmlspecialchars(substr($rotina['refeicao_almoco'],0,5)) ?>
                      </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Lanche da tarde
                      <span class="badge bg-success badge-time">
                        <?= htmlspecialchars(substr($rotina['refeicao_lanche'],0,5)) ?>
                      </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Jantar
                      <span class="badge bg-success badge-time">
                        <?= htmlspecialchars(substr($rotina['refeicao_jantar'],0,5)) ?>
                      </span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- Medicações -->
            <div class="col-md-6">
              <div class="card summary-card h-100">
                <div class="card-body">
                  <div class="text-center">
                    <i class="bi bi-capsule-pill summary-icon text-info"></i>
                    <div class="mt-2 section-title">Horários das medicações</div>
                  </div>
                  <ul class="list-group list-group-flush mt-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Manhã
                      <span class="badge bg-info text-dark badge-time">
                        <?= htmlspecialchars(substr($rotina['medicacao_manha'],0,5)) ?>
                      </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Tarde
                      <span class="badge bg-info text-dark badge-time">
                        <?= htmlspecialchars(substr($rotina['medicacao_tarde'],0,5)) ?>
                      </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Noite
                      <span class="badge bg-info text-dark badge-time">
                        <?= htmlspecialchars(substr($rotina['medicacao_noite'],0,5)) ?>
                      </span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- Atividades -->
            <div class="col-md-6">
              <div class="card summary-card h-100">
                <div class="card-body">
                  <div class="text-center">
                    <i class="bi bi-people summary-icon text-warning"></i>
                    <div class="mt-2 section-title">Atividades programadas</div>
                  </div>
                  <ul class="list-group list-group-flush mt-3">
                    <?php foreach ($atividades as $atv): ?>
                      <li class="list-group-item">
                        <span class="fw-bold text-primary me-2">
                          <?= htmlspecialchars(substr($atv['hora'],0,5)) ?>
                        </span>
                        <?= htmlspecialchars($atv['descricao']) ?>
                      </li>
                    <?php endforeach; ?>
                    <?php if (empty($atividades)): ?>
                      <li class="list-group-item text-muted">
                        Nenhuma atividade cadastrada.
                      </li>
                    <?php endif; ?>
                  </ul>
                </div>
              </div>
            </div>

            <!-- Cuidados especiais -->
            <div class="col-md-6">
              <div class="card summary-card h-100">
                <div class="card-body">
                  <div class="text-center">
                    <i class="bi bi-shield-plus summary-icon text-danger"></i>
                    <div class="mt-2 section-title">Cuidados especiais</div>
                  </div>
                  <div class="mt-3">
                    <p class="mb-0" style="white-space:pre-line;">
                      <?= nl2br(htmlspecialchars($cuidados)) ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Observações do dia -->
            <div class="col-12">
              <div class="card summary-card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                    <div class="d-flex align-items-center gap-2">
                      <i class="bi bi-journal-text summary-icon text-secondary"></i>
                      <div class="section-title mb-0">Observações do dia</div>
                    </div>
                    <?php if ($residente_id): ?>
                      <button type="button"
                              class="btn btn-pill-accent"
                              data-bs-toggle="modal"
                              data-bs-target="#novaObservacaoModal">
                        <i class="bi bi-plus-circle me-1"></i> Nova observação
                      </button>
                    <?php endif; ?>
                  </div>

                  <ul class="list-group list-group-flush mt-2">
                    <?php foreach ($observacoes as $obs): ?>
                      <li class="list-group-item">
                        <span class="text-secondary" style="font-size:0.85rem;">
                          <?= date('d/m/Y H:i', strtotime($obs['data_hora'])) ?>:
                        </span>
                        <span class="fw-semibold ms-1">
                          <?= htmlspecialchars($obs['observacao']) ?>
                        </span>
                      </li>
                    <?php endforeach; ?>
                    <?php if (empty($observacoes)): ?>
                      <li class="list-group-item text-muted">
                        Nenhuma observação registrada.
                      </li>
                    <?php endif; ?>
                  </ul>
                </div>
              </div>
            </div>

          </div>
        </section>

      <?php elseif ($residente_id): ?>
        <div class="alert alert-warning text-center mt-4">
          Residente não encontrado ou sem rotina cadastrada.
        </div>
      <?php endif; ?>

    </div>
  </div>
</main>

<!-- Modal nova observação (mantido com pequeno ajuste visual nos botões) -->
<div class="modal fade" id="novaObservacaoModal" tabindex="-1" aria-labelledby="novaObservacaoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="novaObservacaoModalLabel">
            <i class="bi bi-journal-plus me-1"></i> Nova observação
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="residente_id" value="<?= htmlspecialchars($residente_id) ?>">
          <div class="mb-3">
            <label for="observacao" class="form-label">Observação</label>
            <input type="text" name="observacao" id="observacao" class="form-control" required placeholder="Digite a observação">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary"
                  style="border-radius:999px;background-color:#5D737E;border:none;"
                  data-bs-dismiss="modal">
            Cancelar
          </button>
          <button type="submit" name="nova_observacao"
                  class="btn btn-success"
                  style="border-radius:999px;background-color:#64B6AC;border:none;">
            <i class="bi bi-plus-circle me-1"></i> Salvar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<?php include_once "footer.php"; ?>
