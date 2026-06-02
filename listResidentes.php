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
  if (empty($data_nasc)) return '';
  $nasc = new DateTime($data_nasc);
  $hoje = new DateTime();
  return $nasc->diff($hoje)->y;
}

// Caminhos das fotos dos residentes
$baseFotoPublica = '/kairos/uploads/residentes/';
$baseFotoFisica  = __DIR__ . '/uploads/residentes/';
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
    border-radius:18px;
    background:#FAFDFC;
    padding:14px 16px;
    margin-bottom:12px;
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

  .resident-left{
    display:flex;
    align-items:center;
    gap:12px;
    min-width:0;
  }

  .resident-avatar{
    width:72px;
    height:96px;
    border-radius:14px;
    overflow:hidden;
    background:#E1EFE7;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
    border:1px solid #D6E4DB;
  }

  .resident-avatar i{
    font-size:1.5rem;
    color:#1F5B36;
  }

  .resident-photo{
    width:100%;
    height:100%;
    object-fit:cover;
    object-position:center top;
    display:block;
  }

  .resident-name{
    font-weight:600;
    color:#1F2E29;
    line-height:1.2;
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
    white-space:nowrap;
  }

  .modal-resident-photo{
    width:160px;
    height:214px;
    border-radius:18px;
    object-fit:cover;
    object-position:center top;
    border:1px solid #D5E3DC;
    background:#E1EFE7;
  }

  .modal-photo-box{
    width:160px;
    height:214px;
    border-radius:18px;
    border:1px dashed #B9CBBF;
    background:#F8FCF9;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#1F5B36;
    font-size:2rem;
  }
</style>

<main>
  <div class="page-shell">
    <div class="page-card">
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

      <section class="search-shell">
        <form method="GET" class="row g-2 align-items-center">
          <div class="col-12 col-md-7 position-relative">
            <span class="search-icon"><i class="bi bi-search"></i></span>
            <input type="text" name="search" class="form-control search-input" placeholder="Buscar por nome ou responsável" value="<?= htmlspecialchars($search) ?>">
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

      <section>
        <?php if (count($residentes) > 0): ?>
          <div class="mx-auto" style="max-width:860px;">
            <?php foreach ($residentes as $res): ?>
              <?php
                $idRes = (int)($res['id'] ?? 0);
                $arquivoFoto = $idRes . '.png';
                $caminhoFisicoFoto = $baseFotoFisica . $arquivoFoto;
                $foto = file_exists($caminhoFisicoFoto) ? $baseFotoPublica . $arquivoFoto : '';

                $dataNascFormatada = !empty($res['data_nasc'])
                  ? (new DateTime($res['data_nasc']))->format('d/m/Y')
                  : '';
              ?>
              <div class="resident-item"
                   data-bs-toggle="modal" data-bs-target="#residenteModal"
                   data-foto="<?= htmlspecialchars($foto) ?>"
                   data-nome="<?= htmlspecialchars($res['nome'] ?? '') ?>"
                   data-data_nasc="<?= htmlspecialchars($dataNascFormatada) ?>"
                   data-cpf="<?= htmlspecialchars($res['cpf'] ?? '') ?>"
                   data-rg="<?= htmlspecialchars($res['rg'] ?? '') ?>"
                   data-telefone="<?= htmlspecialchars($res['telefone'] ?? '') ?>"
                   data-endereco="<?= htmlspecialchars($res['endereco'] ?? '') ?>"
                   data-email="<?= htmlspecialchars($res['email'] ?? '') ?>"
                   data-quarto="<?= htmlspecialchars($res['quarto'] ?? '') ?>"
                   data-medicamentos="<?= htmlspecialchars($res['medicamentos'] ?? '') ?>"
                   data-alergias="<?= htmlspecialchars($res['alergias'] ?? '') ?>"
                   data-restricoes_alimentares="<?= htmlspecialchars($res['restricoes_alimentares'] ?? '') ?>"
                   data-responsavel_nome="<?= htmlspecialchars($res['responsavel_nome'] ?? '') ?>"
                   data-responsavel_telefone="<?= htmlspecialchars($res['responsavel_telefone'] ?? '') ?>"
                   data-responsavel_email="<?= htmlspecialchars($res['responsavel_email'] ?? '') ?>"
                   data-parente_grau="<?= htmlspecialchars($res['parente_grau'] ?? '') ?>">

                <div class="resident-left">
                  <div class="resident-avatar">
                    <?php if (!empty($foto)): ?>
                      <img src="<?= htmlspecialchars($foto) ?>"
                           alt="<?= htmlspecialchars($res['nome'] ?? '') ?>"
                           class="resident-photo">
                    <?php else: ?>
                      <i class="bi bi-person-fill"></i>
                    <?php endif; ?>
                  </div>

                  <div class="min-w-0">
                    <div class="resident-name">
                      <?= htmlspecialchars($res['nome'] ?? '') ?>
                    </div>
                    <div class="resident-meta">
                      Idade: <?= !empty($res['data_nasc']) ? calcularIdade($res['data_nasc']) . ' anos' : 'Não informada' ?>
                    </div>
                  </div>
                </div>

                <div class="text-end">
                  <div class="resident-room">
                    Quarto <?= htmlspecialchars($res['quarto'] ?? '-') ?>
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

<div class="modal fade" id="residenteModal" tabindex="-1" aria-labelledby="residenteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="residenteModalLabel">Detalhes do Residente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="row g-4">
          <div class="col-md-4 text-center">
            <div id="modal-foto-box" class="mx-auto">
              <div class="modal-photo-box" id="modal-foto-placeholder">
                <i class="bi bi-person-fill"></i>
              </div>
              <img id="modal-foto" src="" alt="Foto do residente" class="modal-resident-photo d-none">
            </div>
          </div>

          <div class="col-md-8">
            <div class="row">
              <div class="col-12 mb-2"><strong>Nome:</strong> <span id="modal-nome"></span></div>
              <div class="col-12 mb-2"><strong>Data de Nascimento:</strong> <span id="modal-data_nasc"></span></div>
              <div class="col-12 mb-2"><strong>CPF:</strong> <span id="modal-cpf"></span></div>
              <div class="col-12 mb-2"><strong>RG:</strong> <span id="modal-rg"></span></div>
              <div class="col-12 mb-2"><strong>Telefone:</strong> <span id="modal-telefone"></span></div>
              <div class="col-12 mb-2"><strong>Endereço:</strong> <span id="modal-endereco"></span></div>
              <div class="col-12 mb-2"><strong>E-mail:</strong> <span id="modal-email"></span></div>
              <div class="col-12 mb-2"><strong>Quarto:</strong> <span id="modal-quarto"></span></div>
              <div class="col-12 mb-2"><strong>Medicamentos:</strong> <span id="modal-medicamentos"></span></div>
              <div class="col-12 mb-2"><strong>Alergias:</strong> <span id="modal-alergias"></span></div>
              <div class="col-12 mb-2"><strong>Restrições Alimentares:</strong> <span id="modal-restricoes_alimentares"></span></div>
              <div class="col-12 mb-2"><strong>Nome do Responsável:</strong> <span id="modal-responsavel_nome"></span></div>
              <div class="col-12 mb-2"><strong>Telefone do Responsável:</strong> <span id="modal-responsavel_telefone"></span></div>
              <div class="col-12 mb-2"><strong>E-mail do Responsável:</strong> <span id="modal-responsavel_email"></span></div>
              <div class="col-12 mb-2"><strong>Grau de Parentesco:</strong> <span id="modal-parente_grau"></span></div>
            </div>
          </div>
        </div>
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

    const setText = (id, value) => {
      const el = document.getElementById(id);
      if (el) el.textContent = value || '-';
    };

    setText('modal-nome', button.getAttribute('data-nome'));
    setText('modal-data_nasc', button.getAttribute('data-data_nasc'));
    setText('modal-cpf', button.getAttribute('data-cpf'));
    setText('modal-rg', button.getAttribute('data-rg'));
    setText('modal-telefone', button.getAttribute('data-telefone'));
    setText('modal-endereco', button.getAttribute('data-endereco'));
    setText('modal-email', button.getAttribute('data-email'));
    setText('modal-quarto', button.getAttribute('data-quarto'));
    setText('modal-medicamentos', button.getAttribute('data-medicamentos'));
    setText('modal-alergias', button.getAttribute('data-alergias'));
    setText('modal-restricoes_alimentares', button.getAttribute('data-restricoes_alimentares'));
    setText('modal-responsavel_nome', button.getAttribute('data-responsavel_nome'));
    setText('modal-responsavel_telefone', button.getAttribute('data-responsavel_telefone'));
    setText('modal-responsavel_email', button.getAttribute('data-responsavel_email'));
    setText('modal-parente_grau', button.getAttribute('data-parente_grau'));

    document.getElementById('modal-cpf-hidden').value = button.getAttribute('data-cpf') || '';

    const fotoPath = button.getAttribute('data-foto');
    const fotoImg = document.getElementById('modal-foto');
    const fotoPlaceholder = document.getElementById('modal-foto-placeholder');

    if (fotoPath) {
      fotoImg.src = fotoPath;
      fotoImg.classList.remove('d-none');
      fotoPlaceholder.classList.add('d-none');
    } else {
      fotoImg.src = '';
      fotoImg.classList.add('d-none');
      fotoPlaceholder.classList.remove('d-none');
    }
  });
</script>

<?php include_once "footer.php"; ?>
