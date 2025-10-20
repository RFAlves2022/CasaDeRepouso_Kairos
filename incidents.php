<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Novo residente • Kairós</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Tema (mesmo das demais páginas) -->
  <style>
    :root{
      --bg-soft:#eef5ef;
      --card:#f8fbf8;
      --brand:#294f3d;
      --brand-2:#5f8b71;
      --accent:#cfe6cf;
      --ink:#1f332b;
    }
    html,body{background:var(--bg-soft); color:var(--ink);}
    .shell{background:var(--card); border-radius:1.25rem; box-shadow:0 16px 40px rgba(0,0,0,.08);}
    .brand-logo{width:56px; height:56px; border-radius:50%; background:
      radial-gradient(circle at 30% 28%, var(--accent), #a7c5a7 65%);
      display:inline-flex; align-items:center; justify-content:center;}
    .brand-svg{width:40px; height:40px;}
    .link-nav{color:var(--brand-2); text-decoration:none; padding:.25rem .5rem; border-radius:.5rem;}
    .link-nav.active, .link-nav:hover{color:var(--brand);}
    .btn-brand{background:var(--brand); color:#fff; border:none;}
    .btn-brand:hover{background:#234533; color:#fff;}
    .card-soft{background:var(--card); border:0; border-radius:1rem; box-shadow:0 10px 24px rgba(0,0,0,.06);}
  </style>
</head>
<body>
  <main class="container py-4 py-md-5">
    <section class="shell p-4 p-md-5">
      <!-- Navbar -->
      <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
        <div class="d-flex align-items-center gap-2">
          <div class="brand-logo">
            <svg class="brand-svg" viewBox="0 0 64 64" fill="none" aria-hidden="true">
              <circle cx="20" cy="22" r="4" fill="#2f6b52"/>
              <circle cx="32" cy="16" r="4" fill="#2f6b52"/>
              <circle cx="44" cy="22" r="4" fill="#2f6b52"/>
              <path d="M32 28c10 6 14 16 14 16s-8-4-14-4-14 4-14 4 4-10 14-16Z" fill="#2f6b52"/>
            </svg>
          </div>
          <div class="fw-bold" style="color:var(--brand)">Kairós</div>
        </div>
        <nav class="nav gap-3 align-items-center">
          <a class="link-nav" href="index.html">Início</a>
          <a class="link-nav" href="dashboard.html">Dashboard</a>
          <a class="link-nav active" aria-current="page" href="residents.html">Residentes</a>
          <a class="link-nav" href="schedule.html">Agenda</a>
          <a class="link-nav" href="meds.html">Medicação</a>
          <a class="link-nav" href="incidents.html">Ocorrências</a>
          <a class="btn btn-sm btn-brand ms-1" href="login.html">Sair</a>
        </nav>
      </div>

      <!-- Cabeçalho -->
      <header class="mb-3">
        <h1 class="h2 fw-bold" style="color:var(--brand)">Novo residente</h1>
        <small class="text-muted">Preencha os dados abaixo para cadastrar um novo residente.</small>
      </header>

      <!-- Formulário -->
      <form class="card-soft p-4">
        <!-- Foto e dados básicos -->
        <div class="row g-3">
          <div class="col-md-3">
            <label class="form-label">Foto</label>
            <div class="input-group">
              <input type="file" class="form-control" id="fotoResidente" accept="image/*">
              <label class="input-group-text" for="fotoResidente">Upload</label>
            </div>
            <div class="form-text">PNG ou JPG até 2 MB.</div>
          </div>

          <div class="col-md-9">
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label">Nome completo</label>
                <input class="form-control form-control-lg" placeholder="Ex.: Maria Aparecida de Souza" required>
              </div>
              <div class="col-6">
                <label class="form-label">Data de nascimento</label>
                <input type="date" class="form-control" required>
              </div>
              <div class="col-6">
                <label class="form-label">Documento (RG/CPF)</label>
                <input class="form-control" placeholder="Ex.: 000.000.000-00">
              </div>
            </div>
          </div>
        </div>

        <hr class="my-4">

        <!-- Contato e responsável -->
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Responsável</label>
            <input class="form-control" placeholder="Nome do responsável">
          </div>
          <div class="col-md-3">
            <label class="form-label">Telefone responsável</label>
            <input class="form-control" placeholder="(00) 00000-0000">
          </div>
          <div class="col-md-3">
            <label class="form-label">Parentesco</label>
            <input class="form-control" placeholder="Filho(a), Neto(a), etc.">
          </div>
          <div class="col-12">
            <label class="form-label">Contato adicional</label>
            <input class="form-control" placeholder="E-mail ou segundo telefone">
          </div>
        </div>

        <hr class="my-4">

        <!-- Admissão e status -->
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Data de admissão</label>
            <input type="date" class="form-control">
          </div>
          <div class="col-md-4">
            <label class="form-label">Status</label>
            <select class="form-select">
              <option selected>Ativo</option>
              <option>Alta</option>
              <option>Óbito</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Quarto/Leito</label>
            <input class="form-control" placeholder="Ex.: A-203">
          </div>
          <div class="col-12">
            <label class="form-label">Condições/Restrições</label>
            <input class="form-control" placeholder="Alergias, mobilidade, dietas...">
          </div>
        </div>

        <hr class="my-4">

        <!-- Observações -->
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label">Observações</label>
            <textarea class="form-control" rows="4" placeholder="Anotações iniciais, histórico relevante, preferências..."></textarea>
          </div>
        </div>

        <!-- Ações -->
        <div class="d-flex justify-content-end gap-2 mt-4">
          <a href="residents.html" class="btn btn-outline-success">Cancelar</a>
          <a href="residents.html" class="btn btn-brand">Salvar</a>
        </div>
      </form>

    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
