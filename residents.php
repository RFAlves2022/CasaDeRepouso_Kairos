<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Residentes • Kairós</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Tema (igual ao index/dashboard) -->
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
    .badge-soft{background:var(--accent); color:var(--brand);}
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
      <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div>
          <h1 class="h2 fw-bold m-0" style="color:var(--brand)">Residentes</h1>
          <small class="text-muted">Gerencie cadastros, contatos e status de acolhimento.</small>
        </div>
        <div class="mt-3 mt-md-0">
          <a class="btn btn-brand" href="resident-new.html">Novo residente</a>
        </div>
      </div>

      <!-- Filtros e busca -->
      <div class="card-soft p-3 mb-4">
        <form class="row g-2 align-items-center">
          <div class="col-12 col-md-6">
            <div class="input-group">
              <span class="input-group-text bg-white border-0">🔎</span>
              <input type="search" class="form-control border-0" placeholder="Buscar por nome ou responsável">
            </div>
          </div>
          <div class="col-6 col-md-3">
            <select class="form-select">
              <option value="">Todos os status</option>
              <option>Ativo</option>
              <option>Alta</option>
              <option>Óbito</option>
            </select>
          </div>
          <div class="col-6 col-md-3 text-md-end">
            <button type="button" class="btn btn-outline-success">Filtrar</button>
          </div>
        </form>
      </div>

      <!-- Tabela de residentes -->
      <div class="card-soft p-0">
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead class="small text-muted">
              <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>Responsável</th>
                <th>Status</th>
                <th class="text-end">Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Maria Oliveira</td>
                <td>82</td>
                <td>Paulo Oliveira</td>
                <td><span class="badge bg-success-subtle text-success">Ativo</span></td>
                <td class="text-end">
                  <a class="btn btn-sm btn-outline-success" href="resident-new.html">Editar</a>
                </td>
              </tr>
              <tr>
                <td>João Sousa</td>
                <td>86</td>
                <td>Carla Sousa</td>
                <td><span class="badge bg-success-subtle text-success">Ativo</span></td>
                <td class="text-end">
                  <a class="btn btn-sm btn-outline-success" href="resident-new.html">Editar</a>
                </td>
              </tr>
              <tr>
                <td>Ana Lima</td>
                <td>79</td>
                <td>Marcos Lima</td>
                <td><span class="badge bg-secondary-subtle text-secondary">Alta</span></td>
                <td class="text-end">
                  <a class="btn btn-sm btn-outline-success" href="resident-new.html">Editar</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Paginação -->
        <div class="d-flex justify-content-between align-items-center p-3">
          <small class="text-muted">Mostrando 1–3 de 3</small>
          <nav aria-label="Paginação">
            <ul class="pagination pagination-sm mb-0">
              <li class="page-item disabled"><span class="page-link">Anterior</span></li>
              <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">Próximo</a></li>
            </ul>
          </nav>
        </div>
      </div>

    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
