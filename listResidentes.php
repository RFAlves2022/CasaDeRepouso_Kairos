<?php
include_once "header.php";
$search = $_GET['search'] ?? '';

if (!empty($search)) {
  $sql = $pdo->prepare("SELECT * FROM tb_residentes WHERE nome LIKE :search ORDER BY nome ASC");
  $sql->bindValue(':search', '%' . $search . '%');
  $sql->execute();
} else {
  $sql = $pdo->query("SELECT * FROM tb_residentes ORDER BY nome ASC");
}

$residentes = $sql->fetchAll(PDO::FETCH_ASSOC);

function calcularIdade($data_nasc)
{
  $nasc = new DateTime($data_nasc);
  $hoje = new DateTime();
  return $nasc->diff($hoje)->y;
}
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
    padding:28px 32px 28px;
  }

  @media (max-width: 767.98px){
    .page-card{padding:20px 18px;}
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
    margin-top:24px;
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

  .btn-new{
    border-radius:999px;
    background:#1F5B36;
    border:none;
    color:#FFFFFF;
    font-size:0.9rem;
    padding-inline:18px;
  }

  .res-count{
    font-size:0.9rem;
    color:#71827A;
  }

  .resident-item{
    border:none;
    border-radius:16px;
    background:#FAFDFC;
    padding:12px 16px;
    margin-bottom:10px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    cursor:pointer;
    transition:box-shadow .15s ease, transform .15s ease, background .15s ease;
  }

  .resident-item:hover{
    background:#F3F9F6;
    box-shadow:0 8px 18px rgba(13,44,29,0.12);
    transform:translateY(-1px);
  }

  .resident-avatar{
    width:40px;
    height:40px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#E1EFE7;
    color:#1F5B36;
    margin-right:12px;
    font-size:1.2rem;
  }

  .resident-name{
    font-weight:600;
    color:#1F2E29;
  }

  .resident-meta{
    font-size:0.85rem;
    color:#819089;
  }

  .resident-room{
    font-size:0.85rem;
    color:#556861;
    background:#E7F1EB;
    border-radius:999px;
    padding:4px 10px;
  }
</style>

<main>
  <div class="page-shell">
    <div class="page-card">

      <!-- Cabeçalho -->
      <header class="mb-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <a href="dashboard.php" class="btn btn-sm"
             style="border-radius:999px;border:1px solid #1F5B36;color:#1F5B36;background:#F6FBF8;">
            Voltar
          </a>
        </div>
        <h1 class="page-header-title mb-1">Residentes</h1>
        <p class="page-header-sub mb-0">
          Gerencie cadastros, contatos e status de acolhimento.
        </p>
      </header>

      <!-- Barra de busca + botão novo -->
      <section class="search-shell">
        <form method="GET" class="row g-2 align-items-center">
          <div class="col-12 col-md-7 position-relative">
            <span class="search-icon">
              <i class="bi bi-search"></i>
            </span>
            <input
              type="text"
              name="search"
              class="form-control search-input"
              placeholder="Buscar por nome ou responsável"
              value="<?= htmlspecialchars($search) ?>">
          </div>

          <div class="col-6 col-md-2">
            <button class="btn btn-filter w-100" type="submit">Filtrar</button>
          </div>

          <div class="col-6 col-md-3 text-md-end">
            <a href="frmCadResidente.php" class="btn btn-new w-100 w-md-auto">
              Novo residente
            </a>
          </div>
        </form>

        <div class="d-flex justify-content-between align-items-center mt-2">
          <span class="res-count">
            Mostrando <strong><?= count($residentes) ?></strong> residentes
          </span>
        </div>
      </section>

      <!-- Lista de residentes no estilo card-list -->
      <section>
        <?php if (count($residentes) > 0): ?>
          <div class="mx-auto" style="max-width:860px;">
            <?php foreach ($residentes as $res): ?>
              <div class="resident-item"
                   data-bs-toggle="modal" data-bs-target="#residenteModal"
                   data-nome="<?= htmlspecialchars($res['nome']) ?>"
                   data-data_nasc="<?= htmlspecialchars((new DateTime($res['data_nasc']))->format('d/m/Y')) ?>"
                   data-cpf="<?= htmlspecialchars($res['cpf']) ?>"
                   data-rg="<?= htmlspecialchars($res['rg']) ?>"
                   data-telefone="<?= htmlspecialchars($res['telefone']) ?>"
                   data-endereco="<?= htmlspecialchars($res['endereco']) ?>"
                   data-email="<?= htmlspecialchars($res['email']) ?>"
                   data-quarto="<?= htmlspecialchars($res['quarto']) ?>"
                   data-medicamentos="<?= htmlspecialchars($res['medicamentos']) ?>"
                   data-alergias="<?= htmlspecialchars($res['alergias']) ?>"
                   data-restricoes_alimentares="<?= htmlspecialchars($res['restricoes_alimentares']) ?>"
                   data-responsavel_nome="<?= htmlspecialchars($res['responsavel_nome']) ?>"
                   data-responsavel_telefone="<?= htmlspecialchars($res['responsavel_telefone']) ?>"
                   data-responsavel_email="<?= htmlspecialchars($res['responsavel_email']) ?>"
                   data-parente_grau="<?= htmlspecialchars($res['parente_grau']) ?>">

                <div class="d-flex align-items-center">
                  <div class="resident-avatar">
                    <i class="bi bi-person-fill"></i>
                  </div>
                  <div>
                    <div class="resident-name">
                      <?= htmlspecialchars($res['nome']) ?>
                    </div>
                    <div class="resident-meta">
                      Idade: <?= calcularIdade($res['data_nasc']) ?> anos
                    </div>
                  </div>
                </div>

                <div class="text-end">
                  <div class="resident-room">
                    Quarto <?= htmlspecialchars($res['quarto']) ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="alert alert-warning text-center mt-3">
            Nenhum residente encontrado.
          </div>
        <?php endif; ?>
      </section>

    </div>
  </div>
</main>

<!-- MODAL permanece igual -->
<div class="modal fade" id="residenteModal" tabindex="-1" aria-labelledby="residenteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="residenteModalLabel">Detalhes do Residente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Nome:</strong> <span id="modal-nome"></span></p>
        <p><strong>Data de Nascimento:</strong> <span id="modal-data_nasc"></span></p>
        <p><strong>CPF:</strong> <span id="modal-cpf"></span></p>
        <p><strong>RG:</strong> <span id="modal-rg"></span></p>
        <p><strong>Telefone:</strong> <span id="modal-telefone"></span></p>
        <p><strong>Endereço:</strong> <span id="modal-endereco"></span></p>
        <p><strong>E-mail:</strong> <span id="modal-email"></span></p>
        <p><strong>Quarto:</strong> <span id="modal-quarto"></span></p>
        <p><strong>Medicamentos:</strong> <span id="modal-medicamentos"></span></p>
        <p><strong>Alergias:</strong> <span id="modal-alergias"></span></p>
        <p><strong>Restrições Alimentares:</strong> <span id="modal-restricoes_alimentares"></span></p>
        <p><strong>Nome do Responsável:</strong> <span id="modal-responsavel_nome"></span></p>
        <p><strong>Telefone do Responsável:</strong> <span id="modal-responsavel_telefone"></span></p>
        <p><strong>E-mail do Responsável:</strong> <span id="modal-responsavel_email"></span></p>
        <p><strong>Grau de Parentesco:</strong> <span id="modal-parente_grau"></span></p>
      </div>
      <div class="modal-footer d-flex justify-content-between">
        <form method="POST" action="deletarResidente.php" onsubmit="return confirm('Tem certeza que deseja deletar este residente?');">
          <input type="hidden" name="cpf" id="modal-cpf-hidden">
          <button type="submit" class="btn btn-danger">Deletar</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color:#5D737E;">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
  const residenteModal = document.getElementById('residenteModal');
  residenteModal.addEventListener('show.bs.modal', function(event) {
    const button = event.relatedTarget;
    const modal = residenteModal.querySelector('.modal-body');

    modal.querySelector('#modal-nome').textContent = button.getAttribute('data-nome');
    modal.querySelector('#modal-data_nasc').textContent = button.getAttribute('data-data_nasc');
    modal.querySelector('#modal-cpf').textContent = button.getAttribute('data-cpf');
    modal.querySelector('#modal-rg').textContent = button.getAttribute('data-rg');
    modal.querySelector('#modal-telefone').textContent = button.getAttribute('data-telefone');
    modal.querySelector('#modal-endereco').textContent = button.getAttribute('data-endereco');
    modal.querySelector('#modal-email').textContent = button.getAttribute('data-email');
    modal.querySelector('#modal-quarto').textContent = button.getAttribute('data-quarto');
    modal.querySelector('#modal-medicamentos').textContent = button.getAttribute('data-medicamentos');
    modal.querySelector('#modal-alergias').textContent = button.getAttribute('data-alergias');
    modal.querySelector('#modal-restricoes_alimentares').textContent = button.getAttribute('data-restricoes_alimentares');
    modal.querySelector('#modal-responsavel_nome').textContent = button.getAttribute('data-responsavel_nome');
    modal.querySelector('#modal-responsavel_telefone').textContent = button.getAttribute('data-responsavel_telefone');
    modal.querySelector('#modal-responsavel_email').textContent = button.getAttribute('data-responsavel_email');
    modal.querySelector('#modal-parente_grau').textContent = button.getAttribute('data-parente_grau');

    document.getElementById('modal-cpf-hidden').value = button.getAttribute('data-cpf');
  });
</script>

<?php include_once "footer.php"; ?>
