<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Configurações • Kairós</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Tema -->
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
          <a class="link-nav" href="residents.html">Residentes</a>
          <a class="link-nav" href="schedule.html">Agenda</a>
          <a class="link-nav" href="meds.html">Medicação</a>
          <a class="link-nav" href="incidents.html">Ocorrências</a>
          <a class="link-nav active" aria-current="page" href="settings.html">Configurações</a>
          <a class="btn btn-sm btn-brand ms-1" href="login.html">Sair</a>
        </nav>
      </div>

      <div class="row g-4">
        <!-- Navegação lateral -->
        <div class="col-12 col-lg-3">
          <div class="card-soft p-3">
            <ul class="nav nav-pills flex-lg-column gap-2" id="settingsTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-instituicao" type="button" role="tab">Instituição</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-preferencias" type="button" role="tab">Preferências</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-notificacoes" type="button" role="tab">Notificações</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-conta" type="button" role="tab">Conta</button>
              </li>
            </ul>
          </div>
        </div>

        <!-- Conteúdo -->
        <div class="col-12 col-lg-9">
          <div class="tab-content">

            <!-- Instituição -->
            <div class="tab-pane fade show active" id="tab-instituicao" role="tabpanel">
              <form class="card-soft p-4">
                <h2 class="h5 mb-3">Dados da instituição</h2>
                <div class="row g-3">
                  <div class="col-md-8">
                    <label class="form-label">Nome</label>
                    <input class="form-control" placeholder="Kairós Casa de Repouso" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">CNPJ</label>
                    <input class="form-control" placeholder="00.000.000/0000-00">
                  </div>
                  <div class="col-12">
                    <label class="form-label">Endereço</label>
                    <input class="form-control" placeholder="Rua, número, bairro, cidade/UF">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Telefone</label>
                    <input class="form-control" placeholder="(00) 0000-0000">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">E-mail</label>
                    <input type="email" class="form-control" placeholder="contato@exemplo.com">
                  </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-4">
                  <button class="btn btn-outline-success" type="reset">Cancelar</button>
                  <button class="btn btn-brand" type="submit">Salvar</button>
                </div>
              </form>
            </div>

            <!-- Preferências -->
            <div class="tab-pane fade" id="tab-preferencias" role="tabpanel">
              <form class="card-soft p-4">
                <h2 class="h5 mb-3">Preferências de interface</h2>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Tema</label>
                    <select class="form-select">
                      <option selected>Claro (padrão)</option>
                      <option>Escuro</option>
                      <option>Automático</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Idioma</label>
                    <select class="form-select" required>
                      <option value="">Selecione…</option>
                      <option selected>Português (Brasil)</option>
                      <option>Inglês</option>
                      <option>Espanhol</option>
                    </select>
                  </div>
                </div>

                <hr class="my-4">

                <h2 class="h6 mb-3">Acessibilidade</h2>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="altoContraste">
                  <label class="form-check-label" for="altoContraste">Alto contraste</label>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="fonteMaior">
                  <label class="form-check-label" for="fonteMaior">Aumentar tamanho da fonte</label>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                  <button class="btn btn-outline-success" type="reset">Restaurar</button>
                  <button class="btn btn-brand" type="submit">Salvar</button>
                </div>
              </form>
            </div>

            <!-- Notificações -->
            <div class="tab-pane fade" id="tab-notificacoes" role="tabpanel">
              <form class="card-soft p-4">
                <h2 class="h5 mb-3">Notificações</h2>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="notifAgenda" checked>
                  <label class="form-check-label" for="notifAgenda">Lembretes de agenda</label>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="notifMedicacao" checked>
                  <label class="form-check-label" for="notifMedicacao">Alertas de medicação</label>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="notifOcorrencias">
                  <label class="form-check-label" for="notifOcorrencias">Ocorrências registradas</label>
                </div>

                <div class="row g-3 mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Canal preferencial</label>
                    <select class="form-select">
                      <option>E-mail</option>
                      <option>SMS</option>
                      <option>Push</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Horário silencioso</label>
                    <div class="input-group">
                      <span class="input-group-text">De</span>
                      <input type="time" class="form-control" value="22:00">
                      <span class="input-group-text">Até</span>
                      <input type="time" class="form-control" value="06:00">
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                  <button class="btn btn-outline-success" type="reset">Cancelar</button>
                  <button class="btn btn-brand" type="submit">Salvar</button>
                </div>
              </form>
            </div>

            <!-- Conta -->
            <div class="tab-pane fade" id="tab-conta" role="tabpanel">
              <form class="card-soft p-4">
                <h2 class="h5 mb-3">Dados da conta</h2>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Nome</label>
                    <input class="form-control" value="Usuário Kairós">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">E-mail</label>
                    <input type="email" class="form-control" value="usuario@exemplo.com">
                  </div>
                </div>

                <hr class="my-4">

                <h2 class="h6 mb-3">Alterar senha</h2>
                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label">Senha atual</label>
                    <input type="password" class="form-control" placeholder="••••••••">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Nova senha</label>
                    <input type="password" class="form-control" placeholder="••••••••">
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Confirmar nova senha</label>
                    <input type="password" class="form-control" placeholder="••••••••">
                  </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                  <button class="btn btn-outline-danger">Encerrar sessão</button>
                  <div class="d-flex gap-2">
                    <button class="btn btn-outline-success" type="reset">Cancelar</button>
                    <button class="btn btn-brand" type="submit">Salvar</button>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>

    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
