<?php 
include_once "header.php"; 
require_once "dbConnection.php"; 
require_once "profileQuerys.php";
?>

<style>
  body{
    background-color:#E5F2E8;
  }

  .profile-shell{
    max-width:960px;
    margin:32px auto 40px;
    padding:0 16px;
  }

  .profile-card{
    background:#FFFFFF;
    border-radius:24px;
    box-shadow:0 18px 40px rgba(12,39,26,0.12);
    border:1px solid #D5E3DC;
    padding:28px 32px 32px;
  }

  .profile-title{
    font-size:1.8rem;
    font-weight:700;
    color:#1F5B36;
    margin-bottom:4px;
  }

  .profile-sub{
    font-size:0.95rem;
    color:#71827A;
    margin-bottom:20px;
  }

  .profile-label{
    font-weight:600;
    color:#2D4E3B;
    font-size:0.9rem;
  }

  .profile-value{
    font-size:0.96rem;
    color:#1F2E29;
  }

  .btn-pill-primary{
    border-radius:999px;
    background:#1F5B36;
    border:none;
    color:#FFFFFF;
    padding:9px 20px;
    font-size:0.95rem;
  }

  .modal .form-label{
    font-weight:500;
    color:#2D4E3B;
  }

  .modal .form-control{
    border-radius:10px;
  }
</style>

<main>
  <div class="profile-shell">
    <div class="profile-card">

      <header class="mb-3">
        <h1 class="profile-title">Meu perfil</h1>
        <p class="profile-sub">
          Veja suas informações de acesso e altere sua senha com segurança.
        </p>
      </header>

      <section class="mb-3">
        <h2 class="h6 mb-3" style="color:#476556;">Informações pessoais</h2>
        <div class="row mb-2">
          <div class="col-sm-4 profile-label">Nome</div>
          <div class="col-sm-8 profile-value">
            <?php echo htmlspecialchars($_SESSION['username']); ?>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-4 profile-label">Data de criação</div>
          <div class="col-sm-8 profile-value">
            <?php echo date('d/m/Y', strtotime($_SESSION['data_criacao'])); ?>
          </div>
        </div>
      </section>

      <hr class="my-3">

      <section class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="profile-label mb-0">
          Segurança da conta
        </div>
        <button class="btn btn-pill-primary"
                data-bs-toggle="modal"
                data-bs-target="#changePasswordModal">
          Alterar senha
        </button>
      </section>

    </div>
  </div>
</main>

<!-- Modal alterar senha -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">Alterar senha</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <form action="profile.php" method="POST">
          <div class="mb-3">
            <label for="currentPassword" class="form-label">Senha atual</label>
            <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
          </div>
          <div class="mb-3">
            <label for="newPassword" class="form-label">Nova senha</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
          </div>
          <button type="submit" class="btn btn-pill-primary">
            Salvar alterações
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once "footer.php"; ?>
