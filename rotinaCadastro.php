<?php
include_once "header.php";
include_once "dbConnection.php";

$residentes = [];
try {
    $stmt = $pdo->query("SELECT id, nome FROM tb_residentes ORDER BY nome");
    $residentes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo '<div class="alert alert-danger text-center">Erro ao buscar residentes: ' . htmlspecialchars($e->getMessage()) . '</div>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();

        $resident_id = $_POST['resident_id'];

        $stmt = $pdo->prepare("INSERT INTO tb_rotina_residente (
            resident_id, hora_acordar, hora_dormir, refeicao_cafe, refeicao_almoco, refeicao_lanche, refeicao_jantar,
            medicacao_manha, medicacao_tarde, medicacao_noite, cuidados_especiais
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $resident_id,
            $_POST['hora_acordar'],
            $_POST['hora_dormir'],
            $_POST['refeicao_cafe'],
            $_POST['refeicao_almoco'],
            $_POST['refeicao_lanche'],
            $_POST['refeicao_jantar'],
            $_POST['medicacao_manha'],
            $_POST['medicacao_tarde'],
            $_POST['medicacao_noite'],
            $_POST['cuidados_especiais']
        ]);
        $rotina_id = $pdo->lastInsertId();

        $i = 1;
        while (isset($_POST["atividade_hora_$i"]) && isset($_POST["atividade_desc_$i"])) {
            $hora = $_POST["atividade_hora_$i"];
            $desc = $_POST["atividade_desc_$i"];
            if ($hora && $desc) {
                $stmt = $pdo->prepare("INSERT INTO tb_rotina_atividade (rotina_id, hora, descricao) VALUES (?, ?, ?)");
                $stmt->execute([$rotina_id, $hora, $desc]);
            }
            $i++;
        }

        $pdo->commit();
        echo '<div class="alert alert-success text-center">Rotina cadastrada com sucesso!</div>';
    } catch (Exception $e) {
        $pdo->rollBack();
        echo '<div class="alert alert-danger text-center">Erro ao cadastrar rotina: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
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
    overflow:hidden;
  }

  .page-header{
    padding:18px 28px;
    border-bottom:1px solid #D5E3DC;
    background:#F4FAF6;
  }

  .page-header-title{
    font-size:1.8rem;
    font-weight:700;
    color:#1F5B36;
  }

  .page-header-sub{
    font-size:0.95rem;
    color:#71827A;
  }

  .page-body{
    padding:24px 28px 28px;
  }

  @media (max-width: 767.98px){
    .page-body{padding:20px 16px;}
  }

  .form-label{
    font-weight:600;
    color:#2D4E3B;
    font-size:0.9rem;
  }

  .form-control,
  .form-select{
    border-radius:12px;
    border:1px solid #C4D5CD;
  }

  .form-control:focus,
  .form-select:focus{
    border-color:#1F5B36;
    box-shadow:0 0 0 0.16rem rgba(31,91,54,0.18);
  }

  .section-title{
    font-size:1.05rem;
    font-weight:600;
    color:#1F5B36;
    margin-bottom:6px;
  }

  .btn-pill-primary{
    border-radius:999px;
    background:#1F5B36;
    border:none;
    color:#FFFFFF;
  }

  .btn-pill-secondary{
    border-radius:999px;
    background:#5D737E;
    border:none;
    color:#FFFFFF;
  }

  .btn-outline-soft{
    border-radius:999px;
    border:1px solid #C4D5CD;
    font-size:0.85rem;
    color:#2D4E3B;
    background:#F8FBF9;
  }
</style>

<main>
  <div class="page-shell">
    <div class="page-card">

      <header class="page-header d-flex justify-content-between align-items-start flex-wrap gap-2">
        <div>
          <h1 class="page-header-title mb-1">
            Cadastro de rotina
          </h1>
          <p class="page-header-sub mb-0">
            Defina horários, atividades diárias e cuidados especiais do residente.
          </p>
        </div>
        <a href="rotina.php" class="btn btn-pill-secondary px-3">
          <i class="bi bi-arrow-left me-1"></i> Voltar para rotina
        </a>
      </header>

      <div class="page-body">
        <form method="POST" autocomplete="off">
          <div class="row g-4">

            <!-- Residente -->
            <div class="col-12">
              <label class="form-label">Residente</label>
              <select name="resident_id" class="form-select" required>
                <option value="">Selecione o residente</option>
                <?php foreach ($residentes as $residente): ?>
                  <option value="<?= $residente['id'] ?>">
                    <?= htmlspecialchars($residente['nome']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Acordar / dormir -->
            <div class="col-md-6">
              <label class="form-label">Hora de acordar</label>
              <input type="time" class="form-control" name="hora_acordar" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Hora de dormir</label>
              <input type="time" class="form-control" name="hora_dormir" required>
            </div>

            <!-- Refeições -->
            <div class="col-12">
              <div class="section-title">Horários das refeições</div>
            </div>
            <div class="col-md-3">
              <label class="form-label">Café da manhã</label>
              <input type="time" class="form-control" name="refeicao_cafe" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Almoço</label>
              <input type="time" class="form-control" name="refeicao_almoco" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Lanche da tarde</label>
              <input type="time" class="form-control" name="refeicao_lanche" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Jantar</label>
              <input type="time" class="form-control" name="refeicao_jantar" required>
            </div>

            <!-- Medicações -->
            <div class="col-12 mt-1">
              <div class="section-title">Horários das medicações</div>
            </div>
            <div class="col-md-4">
              <label class="form-label">Medicação manhã</label>
              <input type="time" class="form-control" name="medicacao_manha" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Medicação tarde</label>
              <input type="time" class="form-control" name="medicacao_tarde" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Medicação noite</label>
              <input type="time" class="form-control" name="medicacao_noite" required>
            </div>

            <!-- Atividades -->
            <div class="col-12">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="section-title mb-0">Atividades programadas</span>
                <button type="button" class="btn btn-outline-soft btn-sm" id="add-atividade-btn">
                  <i class="bi bi-plus-circle me-1"></i> Nova atividade
                </button>
              </div>
              <div id="atividades-lista" class="row g-2">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                  <div class="col-md-3 atividade-item">
                    <input type="time"
                           class="form-control mb-1"
                           name="atividade_hora_<?= $i ?>"
                           placeholder="Hora">
                  </div>
                  <div class="col-md-9 atividade-item">
                    <input type="text"
                           class="form-control mb-1"
                           name="atividade_desc_<?= $i ?>"
                           placeholder="Descrição da atividade">
                  </div>
                <?php endfor; ?>
              </div>
            </div>

            <!-- Cuidados especiais -->
            <div class="col-12">
              <div class="section-title">Cuidados especiais</div>
              <textarea class="form-control"
                        name="cuidados_especiais"
                        rows="2"
                        placeholder="Descreva alergias, restrições e orientações específicas"></textarea>
            </div>
          </div>

          <div class="text-center mt-4">
            <button type="submit" class="btn btn-pill-primary px-5">
              <i class="bi bi-save me-1"></i> Salvar rotina
            </button>
            <a href="rotina.php" class="btn btn-pill-secondary ms-2 px-4">
              <i class="bi bi-arrow-left me-1"></i> Voltar
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<script>
  let atividadeCount = 4;
  const addBtn = document.getElementById('add-atividade-btn');
  const lista = document.getElementById('atividades-lista');

  addBtn.addEventListener('click', function() {
    atividadeCount++;

    const colHora = document.createElement('div');
    colHora.className = 'col-md-3 atividade-item';
    colHora.innerHTML = `<input type="time" class="form-control mb-1" name="atividade_hora_${atividadeCount}" placeholder="Hora">`;
    lista.appendChild(colHora);

    const colDesc = document.createElement('div');
    colDesc.className = 'col-md-9 atividade-item';
    colDesc.innerHTML = `<input type="text" class="form-control mb-1" name="atividade_desc_${atividadeCount}" placeholder="Descrição da atividade">`;
    lista.appendChild(colDesc);
  });

  document.querySelector('form').addEventListener('input', function() {
    let filled = true;
    for (let i = 1; i <= 4; i++) {
      if (
        !document.querySelector(`[name="atividade_hora_${i}"]`).value ||
        !document.querySelector(`[name="atividade_desc_${i}"]`).value
      ) {
        filled = false;
        break;
      }
    }
    addBtn.disabled = !filled;
  });
</script>

<?php include_once "footer.php"; ?>
