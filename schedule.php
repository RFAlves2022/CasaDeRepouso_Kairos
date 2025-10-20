<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agenda • Kairós</title>

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
          <a class="link-nav" href="residents.html">Residentes</a>
          <a class="link-nav active" aria-current="page" href="schedule.html">Agenda</a>
          <a class="link-nav" href="meds.html">Medicação</a>
          <a class="link-nav" href="incidents.html">Ocorrências</a>
          <a class="btn btn-sm btn-brand ms-1" href="login.html">Sair</a>
        </nav>
      </div>

      <!-- Cabeçalho -->
      <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div>
          <h1 class="h2 fw-bold m-0" style="color:var(--brand)">Agenda</h1>
          <small class="text-muted">Compromissos do dia por horário e tipo.</small>
        </div>
        <div class="mt-3 mt-md-0 d-flex gap-2">
          <button class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#novoItem">Novo compromisso</button>
          <button class="btn btn-outline-success">Exportar</button>
        </div>
      </div>

      <!-- Filtros rápidos -->
      <div class="card-soft p-3 mb-4">
        <form class="row g-2">
          <div class="col-12 col-md-4">
            <input type="date" class="form-control" value="">
          </div>
          <div class="col-6 col-md-4">
            <select class="form-select">
              <option value="">Todos os tipos</option>
              <option>Consulta</option>
              <option>Atividade</option>
              <option>Exame</option>
            </select>
          </div>
          <div class="col-6 col-md-4">
            <select class="form-select">
              <option value="">Todos os residentes</option>
              <option>Maria Oliveira</option>
              <option>João Sousa</option>
              <option>Ana Lima</option>
            </select>
          </div>
        </form>
      </div>

      <!-- Lista do dia -->
      <div class="card-soft p-0">
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead class="small text-muted">
              <tr><th>Horário</th><th>Residente</th><th>Título</th><th>Tipo</th><th class="text-end">Ações</th></tr>
            </thead>
            <tbody>
              <tr>
                <td>09:00</td>
                <td>Maria Oliveira</td>
                <td>Cardiologia</td>
                <td><span class="badge badge-soft">Consulta</span></td>
                <td class="text-end">
                  <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#novoItem">Editar</button>
                </td>
              </tr>
              <tr>
                <td>14:00</td>
                <td>João Sousa</td>
                <td>Fisioterapia</td>
                <td><span class="badge badge-soft">Atividade</span></td>
                <td class="text-end">
                  <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#novoItem">Editar</button>
                </td>
              </tr>
              <tr>
                <td>16:30</td>
                <td>Ana Lima</td>
                <td>Exame laboratorial</td>
                <td><span class="badge badge-soft">Exame</span></td>
                <td class="text-end">
                  <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#novoItem">Editar</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Rodapé -->
        <div class="d-flex justify-content-between align-items-center p-3">
          <small class="text-muted">3 compromissos hoje</small>
          <nav>
            <ul class="pagination pagination-sm mb-0">
              <li class="page-item disabled"><span class="page-link">Anterior</span></li>
              <li class="page-item active"><span class="page-link">Hoje</span></li>
              <li class="page-item"><a class="page-link" href="#">Amanhã</a></li>
            </ul>
          </nav>
        </div>
      </div>

      <!-- Modal novo/editar compromisso -->
      <div class="modal fade" id="novoItem" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content" style="border-radius:1rem;">
            <div class="modal-header">
              <h5 class="modal-title">Compromisso</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
              <form class="row g-3">
                <div class="col-12">
                  <label class="form-label">Título</label>
                  <input class="form-control" placeholder="Ex.: Cardiologia">
                </div>
                <div class="col-6">
                  <label class="form-label">Data</label>
                  <input type="date" class="form-control">
                </div>
                <div class="col-6">
                  <label class="form-label">Hora</label>
                  <input type="time" class="form-control">
                </div>
                <div class="col-6">
                  <label class="form-label">Residente</label>
                  <select class="form-select">
                    <option>Maria Oliveira</option>
                    <option>João Sousa</option>
                    <option>Ana Lima</option>
                  </select>
                </div>
                <div class="col-6">
                  <label class="form-label">Tipo</label>
                  <select class="form-select">
                    <option>Consulta</option>
                    <option>Atividade</option>
                    <option>Exame</option>
                  </select>
                </div>
                <div class="col-12">
                  <label class="form-label">Observações</label>
                  <textarea class="form-control" rows="3"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button class="btn btn-outline-success" data-bs-dismiss="modal">Cancelar</button>
              <button class="btn btn-brand">Salvar</button>
            </div>
          </div>
        </div>
      </div>

    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
