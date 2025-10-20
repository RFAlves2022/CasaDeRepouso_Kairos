<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Acessar • Kairós</title>

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
    html,body{background:var(--bg-soft); color:var(--ink); min-height:100%;}
    .brand-logo{width:88px; height:88px; border-radius:50%; background:
      radial-gradient(circle at 30% 28%, var(--accent), #a7c5a7 65%);
      display:inline-flex; align-items:center; justify-content:center;}
    .brand-svg{width:68px; height:68px;}
    .btn-brand{background:var(--brand); color:#fff; border:none;}
    .btn-brand:hover{background:#234533; color:#fff;}
    .input-soft{background:#fff; border:0; border-radius:.9rem; box-shadow:0 2px 0 rgba(0,0,0,.02) inset;}
    .card-clean{background:transparent; border:0;}
    .link-muted{color:var(--brand-2); text-decoration:none;}
    .link-muted:hover{color:var(--brand);}
  </style>
</head>
<body>
  <main class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-7">
        <div class="text-center mb-4">
          <div class="d-inline-flex align-items-center gap-3">
            <div class="brand-logo">
              <svg class="brand-svg" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                <circle cx="20" cy="22" r="4" fill="#2f6b52"/>
                <circle cx="32" cy="16" r="4" fill="#2f6b52"/>
                <circle cx="44" cy="22" r="4" fill="#2f6b52"/>
                <path d="M32 28c10 6 14 16 14 16s-8-4-14-4-14 4-14 4 4-10 14-16Z" fill="#2f6b52"/>
              </svg>
            </div>
            <div class="text-start">
              <div class="display-6 fw-bold" style="color:var(--brand)">Kairós</div>
              <div class="fs-4 text-muted">Casa de Repouso</div>
            </div>
          </div>
        </div>

        <div class="card-clean text-center">
          <h1 class="display-5 fw-bold mb-4" style="color:var(--brand)">Acessar</h1>

          <form class="mx-auto needs-validation" style="max-width:640px" novalidate>
            <div class="mb-3 px-3">
              <input type="email" class="form-control form-control-lg input-soft py-3"
                     placeholder="E-mail" required>
              <div class="invalid-feedback text-start px-1">Informe um e-mail válido.</div>
            </div>

            <div class="mb-3 px-3">
              <input type="password" class="form-control form-control-lg input-soft py-3"
                     placeholder="Senha" required minlength="6">
              <div class="invalid-feedback text-start px-1">Informe sua senha (mín. 6 caracteres).</div>
            </div>

            <div class="px-3">
              <button class="btn btn-brand btn-lg w-100 py-3 rounded-4" type="submit">Entrar</button>
            </div>

            <div class="mt-3">
              <a href="#" class="link-muted">Esqueci minha senha</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Validação Bootstrap 5 -->
  <script>
    (function () {
      'use strict';
      const forms = document.querySelectorAll('.needs-validation');
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
  </script>
</body>
</html>
