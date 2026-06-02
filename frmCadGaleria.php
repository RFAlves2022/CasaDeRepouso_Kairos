<?php
include_once "auth.php";
include_once "dbConnection.php";
include_once "header.php";
?>

<style>
  body{
    background:#E5F2E8;
  }
  .page-shell{
    max-width:1120px;
    margin:0 auto;
    padding:32px 16px 40px;
  }
  .page-card{
    background:#fff;
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
    font-size:.95rem;
    color:#71827A;
  }
  .page-body{
    padding:24px 28px 32px;
  }
  .form-label{
    font-weight:600;
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
  .btn-pill-primary{
    border-radius:999px;
    background:#1F5B36;
    border:none;
    color:#fff;
  }
  .btn-pill-secondary{
    border-radius:999px;
    background:#5D737E;
    border:none;
    color:#fff;
  }
  .photo-preview{
    width:160px;
    height:200px;
    object-fit:cover;
    border-radius:16px;
    border:1px solid #D5E3DC;
    background:#E8F2EA;
  }
</style>

<main>
  <div class="page-shell">
    <div class="page-card">
      <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
          <h1 class="page-header-title mb-1">Cadastrar imagem na galeria</h1>
          <p class="page-header-sub mb-0">Adicione imagens para aparecerem no feed da página inicial.</p>
        </div>
        <a href="index.php" class="btn btn-pill-secondary px-3">
          <i class="bi bi-arrow-left me-1"></i> Voltar
        </a>
      </div>

      <div class="page-body">
        <?php if (isset($_GET['sucesso'])): ?>
          <div class="alert alert-success">Imagem cadastrada com sucesso!</div>
        <?php endif; ?>

        <?php if (isset($_GET['erro'])): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($_GET['erro']) ?></div>
        <?php endif; ?>

        <form action="salvarGaleria.php" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 860px;">
          <div class="row g-4">
            <div class="col-md-4 text-center">
              <img id="fotoPreview" src="https://via.placeholder.com/160x200?text=Foto" alt="Preview" class="photo-preview">
            </div>

            <div class="col-md-8">
              <div class="mb-3">
                <label for="imagem" class="form-label">Imagem</label>
                <input type="file" class="form-control" id="imagem" name="imagem" accept="image/" required>
              </div>

              <div class="mb-3">
                <label for="data_postagem" class="form-label">Data da postagem</label>
                <input type="date" class="form-control" id="data_postagem" name="data_postagem" required>
              </div>

              <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
              </div>

              <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4" required></textarea>
              </div>

              <button type="submit" class="btn btn-pill-primary px-4">Salvar imagem</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<script>
  const imagemInput = document.getElementById('imagem');
  const fotoPreview = document.getElementById('fotoPreview');

  imagemInput.addEventListener('change', function () {
    const file = this.files && this.files[0];
    if (!file) {
      fotoPreview.src = 'https://via.placeholder.com/160x200?text=Foto';
      return;
    }
    const reader = new FileReader();
    reader.onload = e => fotoPreview.src = e.target.result;
    reader.readAsDataURL(file);
  });
</script>

<?php include_once "footer.php"; ?>
