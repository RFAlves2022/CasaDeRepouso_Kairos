<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Medicação • Kairós</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Tema (igual às outras páginas) -->
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
          <a class="link-nav" href="schedule.html">Agenda</a>
          <a class="link-nav active" aria-current="page" href="meds.html">Medicação</a>
          <a class="link-nav" href="incidents.html">Ocorrências</a>
          <a class="btn btn-sm btn-brand ms-1" href="login.html">Sair</a>
        </nav>
      </div>

      <!-- Cabeçalho -->
      <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div>
          <h1 class="h2 fw-bold m-0" style="color:var(--brand)">Medicação diária</h1>
          <small class="text-muted">Checagem de doses por residente e horário.</small>
        </div>
        <div class="mt-3 mt-md-0 d-flex gap-2">
          <button class="btn btn-outline-success">Imprimir</button>
          <button class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#novaPresc">Nova prescrição</button>
        </div>
      </div>

      <!-- Abas de turno -->
      <ul class="nav nav-pills mb-3">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#turnoManha">Manhã</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#turnoTarde">Tarde</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#turnoNoite">Noite</button></li>
      </ul>

      <div class="tab-content">
        <!-- Turno Manhã -->
        <div class="tab-pane fade show active" id="turnoManha">
          <div class="card-soft p-0">
            <div class="table-responsive">
              <table class="table align-middle mb-0">
                <thead class="small text-muted">
                  <tr><th>Horário</th><th>Residente</th><th>Medicação</th><th>Dose</th><th>Status</th><th class="text-end">Ação</th></tr>
                </thead>
                <tbody>
                  <tr>
                    <td>08:00</td>
                    <td>Antônio Rocha</td>
                    <td>Lisinopril</td>
                    <td>10 mg</td>
                    <td><span class="badge bg-warning-subtle text-warning">Pendente</span></td>
                    <td class="text-end">
                      <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#administrar">Registrar</button>
                    </td>
                  </tr>
                  <tr>
                    <td>09:00</td>
                    <td>Vera Martins</td>
                    <td>Metformina</td>
                    <td>500 mg</td>
                    <td><span class="badge bg-success-subtle text-success">Feito</span></td>
                    <td class="text-end">
                      <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#administrar">Editar</button>
                    </td>
                  </tr>
                  <tr>
                    <td>10:00</td>
                    <td>José Costa</td>
                    <td>Sinvastatina</td>
                    <td>20 mg</td>
                    <td><span class="badge bg-danger-subtle text-danger">Falha</span></td>
                    <td class="text-end">
                      <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#administrar">Registrar</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="d-flex justify-content-between align-items-center p-3">
              <small class="text-muted">3 itens no turno da manhã</small>
              <nav>
                <ul class="pagination pagination-sm mb-0">
                  <li class="page-item disabled"><span class="page-link">Anterior</span></li>
                  <li class="page-item active"><span class="page-link">1</span></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">Próximo</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>

        <!-- Turno Tarde -->
        <div class="tab-pane fade" id="turnoTarde">
          <div class="alert alert-secondary mb-0">Sem itens para este turno.</div>
        </div>

        <!-- Turno Noite -->
        <div class="tab-pane fade" id="turnoNoite">
          <div class="alert alert-secondary mb-0">Sem itens para este turno.</div>
        </div>
      </div>

      <!-- Modal registrar administração -->
      <div class="modal fade" id="administrar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content" style="border-radius:1rem;">
            <div class="modal-header">
              <h5 class="modal-title">Registrar administração</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
              <form class="row g-3">
                <div class="col-6">
                  <label class="form-label">Data</label>
                  <input type="date" class="form-control">
                </div>
                <div class="col-6">
                  <label class="form-label">Horário</label>
                  <input type="time" class="form-control">
                </div>
                <div class="col-12">
                  <label class="form-label">Status</label>
                  <select class="form-select">
                    <option>Feito</option>
                    <option>Pendente</option>
                    <option>Falha</option>
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

      <!-- Modal nova prescrição -->
      <div class="modal fade" id="novaPresc" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content" style="border-radius:1rem;">
            <div class="modal-header">
              <h5 class="modal-title">Nova prescrição</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
              <form class="row g-3">
                <div class="col-12">
                  <label class="form-label">Residente</label>
                  <select class="form-select">
                    <option>Antônio Rocha</option>
                    <option>Vera Martins</option>
                    <option>José Costa</option>
                  </select>
                </div>
                <div class="col-8">
                  <label class="form-label">Medicação</label>
                  <input class="form-control" placeholder="Ex.: Metformina">
                </div>
                <div class="col-4">
                  <label class="form-label">Dose</label>
                  <input class="form-control" placeholder="500 mg">
                </div>
                <div class="col-6">
                  <label class="form-label">Frequência</label>
                  <input class="form-control" placeholder="8/8h">
                </div>
                <div class="col-6">
                  <label class="form-label">Via</label>
                  <input class="form-control" placeholder="VO">
                </div>
                <div class="col-6">
                  <label class="form-label">Início</label>
                  <input type="date" class="form-control">
                </div>
                <div class="col-6">
                  <label class="form-label">Fim</label>
                  <input type="date" class="form-control">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button class="btn btn-outline-success" data-bs-dismiss="modal">Cancelar</button>
              <button class="btn btn-brand">Adicionar</button>
            </div>
          </div>
        </div>
      </div>

    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
