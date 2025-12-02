<?php
include_once "header.php";
include_once "cadastrarResidente.php";
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
    padding:24px 28px 32px;
  }

  @media (max-width: 767.98px){
    .page-body{padding:20px 16px;}
  }

  .form-label{
    font-weight:600;
    font-size:0.9rem;
    color:#2D4E3B;
  }

  .form-control{
    border-radius:12px;
    border:1px solid #C4D5CD;
  }

  .form-control:focus{
    border-color:#1F5B36;
    box-shadow:0 0 0 0.16rem rgba(31,91,54,0.18);
  }

  .section-title{
    font-size:1.1rem;
    font-weight:600;
    color:#1F5B36;
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
</style>

<main>
  <div class="page-shell">
    <div class="page-card">

      <!-- Cabeçalho -->
      <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
          <h1 class="page-header-title mb-1">Cadastro de residente</h1>
          <p class="page-header-sub mb-0">
            Registre dados pessoais, contato, quarto e responsável pelo residente.
          </p>
        </div>
        <a href="listResidentes.php" class="btn btn-pill-secondary px-3">
          <i class="bi bi-arrow-left me-1"></i> Voltar
        </a>
      </div>

      <div class="page-body">

        <?php
        if (isset($cadastro_sucesso)) {
            echo "<div class='alert alert-success' role='alert'>Residente cadastrado com sucesso!</div>";
        }
        if (isset($cadastro_erro)) {
            echo "<div class='alert alert-danger' role='alert'>Erro ao cadastrar residente.</div>";
        }
        if (isset($erro_conexao)) {
            echo "<div class='alert alert-danger' role='alert'>" . $erro_conexao . "</div>";
        }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="mx-auto" style="max-width: 880px;">

          <!-- Dados do residente -->
          <h2 class="section-title mb-3">Dados do residente</h2>

          <div class="row mb-3">
            <div class="col-md-8">
              <label for="nome" class="form-label">Nome completo</label>
              <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="col-md-4">
              <label for="data_nasc" class="form-label">Data de nascimento</label>
              <input type="date" class="form-control" id="data_nasc" name="data_nasc">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-4">
              <label for="cpf" class="form-label">CPF</label>
              <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <div class="col-md-3">
              <label for="rg" class="form-label">RG</label>
              <input type="text" class="form-control" id="rg" name="rg">
            </div>
            <div class="col-md-5">
              <label for="telefone" class="form-label">Telefone</label>
              <input type="text" class="form-control" id="telefone" name="telefone">
            </div>
          </div>

          <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco">
          </div>

          <div class="row mb-3">
            <div class="col-md-8">
              <label for="email" class="form-label">E-mail</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="col-md-4">
              <label for="quarto" class="form-label">Quarto / leito</label>
              <input type="text" class="form-control" id="quarto" name="quarto">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="medicamentos" class="form-label">Medicamentos em uso</label>
              <input type="text" class="form-control" id="medicamentos" name="medicamentos">
            </div>
            <div class="col-md-6">
              <label for="alergias" class="form-label">Alergias</label>
              <input type="text" class="form-control" id="alergias" name="alergias">
            </div>
          </div>

          <div class="mb-4">
            <label for="restricoes_alimentares" class="form-label">Restrições alimentares</label>
            <textarea class="form-control" id="restricoes_alimentares" name="restricoes_alimentares" rows="2"></textarea>
          </div>

          <hr class="my-4">

          <!-- Responsável -->
          <h2 class="section-title text-center mb-4">Informações do responsável</h2>

          <div class="row mb-3">
            <div class="col-md-8">
              <label for="responsavel_nome" class="form-label">Nome do responsável</label>
              <input type="text" class="form-control" id="responsavel_nome" name="responsavel_nome">
            </div>
            <div class="col-md-4">
              <label for="responsavel_telefone" class="form-label">Telefone do responsável</label>
              <input type="tel" class="form-control" id="responsavel_telefone" name="responsavel_telefone">
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-md-6">
              <label for="responsavel_email" class="form-label">E-mail do responsável</label>
              <input type="email" class="form-control" id="responsavel_email" name="responsavel_email">
            </div>
            <div class="col-md-6">
              <label for="parente_grau" class="form-label">Grau de parentesco</label>
              <input type="text" class="form-control" id="parente_grau" name="parente_grau">
            </div>
          </div>

          <div class="text-center">
            <button type="submit"
                    class="btn btn-pill-primary mt-2 mb-3 px-5">
              Cadastrar residente
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</main>

<?php include_once "footer.php"; ?>
