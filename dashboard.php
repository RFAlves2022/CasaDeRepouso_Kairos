<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard • Kairós</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Tema (mesmo do index) -->
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
          <a class="link-nav active" aria-current="page" href="dashboard.html">Dashboard</a>
          <a class="link-nav" href="residents.html">Residentes</a>
          <a class="link-nav" href="schedule.html">Agenda</a>
          <a class="link-nav" href="meds.html">Medicação</a>
          <a class="link-nav" href="incidents.html">Ocorrências</a>
          <a class="btn btn-sm btn-brand ms-1" href="login.html">Sair</a>
        </nav>
      </div>

      <header class="mb-4">
        <h1 class="h2 fw-bold" style="color:var(--brand)">Dashboard</h1>
        <p class="text-muted mb-0">Bem‑vindo à Casa de Repouso! Acompanhe suas rotinas do dia.</p>
      </header>

      <div class="row g-4">
        <!-- Consultas -->
        <div class="col-lg-6">
          <div class="card-soft p-3">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <div class="d-flex align-items-center gap-2">
                <span class="badge badge-soft">Consultas</span>
                <span class="text-muted small">Hoje</span>
              </div>
              <a href="schedule.html" class="btn btn-sm btn-brand">Cadastrar consulta</a>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Maria Oliveira <span class="text-muted">10:00–11:00 • <span class="badge bg-success-subtle text-success">Confirmada</span></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                João Sousa <span class="text-muted">14:00–15:00 • <span class="badge bg-warning-subtle text-warning">Aguardando</span></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Ana Lima <span class="text-muted">09:30–10:30 • <span class="badge bg-secondary-subtle text-secondary">Remarcada</span></span>
              </li>
            </ul>
          </div>
        </div>

        <!-- Medicação diária -->
        <div class="col-lg-6">
          <div class="card-soft p-3">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <div class="d-flex align-items-center gap-2">
                <span class="badge badge-soft">Medicação diária</span>
                <span class="text-muted small">Turno manhã</span>
              </div>
              <a href="meds.html" class="btn btn-sm btn-outline-success">Ver tudo</a>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between">
                Antônio Rocha <span class="text-muted">Lisinopril, 10 mg — 08:00</span>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                Vera Martins <span class="text-muted">Metformina, 500 mg — 09:00</span>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                José Costa <span class="text-muted">Sinvastatina, 20 mg — 10:00</span>
              </li>
            </ul>
          </div>
        </div>

        <!-- Ocorrências recentes -->
        <div class="col-lg-6">
          <div class="card-soft p-3">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <span class="badge badge-soft">Ocorrências</span>
              <a href="incidents.html" class="btn btn-sm btn-outline-success">Nova ocorrência</a>
            </div>
            <div class="table-responsive">
              <table class="table align-middle mb-0">
                <thead class="small text-muted">
                  <tr><th>Data</th><th>Residente</th><th>Categoria</th><th>Ações</th></tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Hoje • 08:20</td>
                    <td>Maria Oliveira</td>
                    <td><span class="badge bg-danger-subtle text-danger">Queda</span></td>
                    <td class="text-end"><a class="btn btn-sm btn-outline-success" href="incidents.html">Ver</a></td>
                  </tr>
                  <tr>
                    <td>Ontem • 17:10</td>
                    <td>João Sousa</td>
                    <td><span class="badge bg-info-subtle text-info">Clínica</span></td>
                    <td class="text-end"><a class="btn btn-sm btn-outline-success" href="incidents.html">Ver</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Sinais vitais (resumo) -->
        <div class="col-lg-6">
          <div class="card-soft p-3">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <span class="badge badge-soft">Sinais vitais</span>
              <a href="vitals.html" class="btn btn-sm btn-outline-success">Ver detalhes</a>
            </div>
            <div class="table-responsive">
              <table class="table align-middle mb-0">
                <thead class="small text-muted">
                  <tr><th>Residente</th><th>PA</th><th>FC</th><th>Glicemia</th></tr>
                </thead>
                <tbody>
                  <tr><td>Maria Oliveira</td><td>130/80</td><td>75</td><td>98 mg/dL</td></tr>
                  <tr><td>João Sousa</td><td>128/78</td><td>72</td><td>101 mg/dL</td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
