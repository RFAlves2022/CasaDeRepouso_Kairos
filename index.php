<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kairós • Casa de Repouso</title>

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
    .brand-logo{width:72px; height:72px; border-radius:50%; background:
      radial-gradient(circle at 30% 28%, var(--accent), #a7c5a7 65%);
      display:inline-flex; align-items:center; justify-content:center; overflow:hidden;}
    .brand-svg{width:56px; height:56px;}
    .link-nav{color:var(--brand-2); text-decoration:none; padding:.25rem .5rem; border-radius:.5rem;}
    .link-nav.active, .link-nav:hover{color:var(--brand); background:transparent;}
    .btn-brand{background:var(--brand); color:#fff; border:none; padding:.9rem 1.25rem; font-weight:600;}
    .btn-brand:hover{background:#234533; color:#fff;}
    .hero-illus{border-radius:1rem; min-height:360px; display:flex; align-items:center; justify-content:center;}
    .lead-muted{color:#3a5b4e;}
  </style>
</head>
<body>
  <main class="container py-4 py-md-5">
    <section class="shell p-4 p-md-5">
      <!-- Barra de navegação no topo direito -->
      <div class="d-flex justify-content-end mb-3 mb-md-4">
        <nav class="nav gap-3 align-items-center">
          <a class="link-nav active" aria-current="page" href="#">Início</a>
          <a class="link-nav" href="#">Sobre</a>
          <a class="link-nav" href="#">Contato</a>
          <a class="btn btn-sm btn-brand ms-1" href="login.html">Entrar</a>
        </nav>
      </div>

      <div class="row g-4 g-xl-5 align-items-center">
        <!-- Coluna esquerda: marca + texto + CTA -->
        <div class="col-lg-6">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="brand-logo">
              <!-- Ícone simples em SVG no estilo “folhas/pessoas” -->
              <svg class="brand-svg" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                <circle cx="20" cy="22" r="4" fill="#2f6b52"/>
                <circle cx="32" cy="16" r="4" fill="#2f6b52"/>
                <circle cx="44" cy="22" r="4" fill="#2f6b52"/>
                <path d="M32 28c10 6 14 16 14 16s-8-4-14-4-14 4-14 4 4-10 14-16Z" fill="#2f6b52"/>
              </svg>
            </div>
            <div>
              <div class="h1 m-0 fw-bold" style="color:var(--brand)">Kairós</div>
              <div class="fs-5 text-muted">Casa de Repouso</div>
            </div>
          </div>

          <h1 class="display-4 fw-bold mt-2" style="color:var(--brand)">Bem‑vindo</h1>
          <p class="lead lead-muted mt-3">
            Bem‑vindo ao Kairós: Casa de Repouso. Oferecemos cuidados com excelência em um ambiente acolhedor.
          </p>

          <a href="#" class="btn btn-brand btn-lg mt-2">Saiba mais</a>
        </div>

        <!-- Coluna direita: ilustração -->
        <div class="col-lg-6">
          <div class="hero-illus p-0 bg-transparent shadow-none">
            <img
              src="img/img3.png"
              alt="Ilustração de cuidado em ambiente acolhedor"
              class="img-fluid border-0 shadow-none rounded-0"
              style="object-fit: contain; width:100%; height:auto;"
            >
          </div>
        </div>
      </div>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
