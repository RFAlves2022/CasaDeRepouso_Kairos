<?php
session_start();

// Monta a lista de imagens existentes de img01.png até img08.png
$imagens = [];
for ($i = 1; $i <= 8; $i++) {
    $arquivo = 'img' . str_pad($i, 2, '0', STR_PAD_LEFT) . '.png';
    $caminhoFisico = __DIR__ . '/uploads/feed/' . $arquivo; // /var/www/html/kairos/uploads/feed/img0X.png
    if (file_exists($caminhoFisico)) {
        $imagens[] = $arquivo;
    }
}

// Verifica se está logado
$estaLogado = !empty($_SESSION['user_id']);

// Legendas das imagens (sem "Imagem demonstrativa")
$legendas = [
    'img01.png' => 'Tarde de Jogos e Convivência',
    'img02.png' => 'Momentos de Reflexão e Memórias',
    'img03.png' => 'Terapia no Jardim e Cuidado',
    'img04.png' => 'Oficina de Arte e Criatividade',
    'img05.png' => 'Música e Alegria no Lar',
    'img06.png' => 'Almoço Compartilhado',
    'img07.png' => 'Conexão entre Gerações',
    'img08.png' => 'Tarde de Relaxamento ao Ar Livre',
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Casa de Repouso | Página Institucional</title>

  <!-- Bootstrap 5.3.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">

  <style>
    body {
      background: #f7f9f8;
      color: #1f2937;
    }

    .navbar-brand {
      font-weight: 700;
      letter-spacing: .3px;
    }

    .hero {
      background: linear-gradient(135deg, #1f5b36 0%, #3b7d52 100%);
      color: #fff;
      padding: 84px 0;
    }

    .hero .btn {
      border-radius: 999px;
      padding: 10px 22px;
    }

    .section-pad {
      padding: 72px 0;
    }

    .card-soft {
      border: 1px solid #e5e7eb;
      border-radius: 18px;
      box-shadow: 0 10px 28px rgba(0,0,0,.06);
      background: #fff;
    }

    .gallery-figure {
      margin-bottom: 0;
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 10px 24px rgba(0,0,0,.06);
      height: 100%;
    }

    .gallery-figure img {
      width: 100%;
      height: auto;
      display: block;
    }

    .figure-caption {
      padding: 12px 14px 16px;
      text-align: center;
      color: #6b7280;
    }

    .badge-soft {
      background: rgba(255,255,255,.16);
      border: 1px solid rgba(255,255,255,.2);
      color: #fff;
    }

    footer {
      background: #0f172a;
      color: #cbd5e1;
    }

    .icon-box {
      width: 56px;
      height: 56px;
      border-radius: 14px;
      display: grid;
      place-items: center;
      background: #eaf4ee;
      color: #1f5b36;
      font-weight: 700;
      margin-bottom: 14px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background:#1f5b36;">
  <div class="container">
    <a class="navbar-brand" href="#">Casa de Repouso</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuTopo" aria-controls="menuTopo" aria-expanded="false" aria-label="Alternar navegação">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuTopo">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="#sobre">Sobre</a></li>
        <li class="nav-item"><a class="nav-link" href="#servicos">Serviços</a></li>
        <li class="nav-item"><a class="nav-link" href="#diferenciais">Diferenciais</a></li>
        <li class="nav-item"><a class="nav-link" href="#galeria">Galeria</a></li>
        <li class="nav-item"><a class="nav-link" href="#contato">Contato</a></li>
      </ul>

      <!-- Botão login/dashboard -->
      <div class="d-flex">
        <?php if ($estaLogado): ?>
          <a href="dashboard.php" class="btn btn-outline-light btn-sm">
            Ir para o painel
          </a>
        <?php else: ?>
          <a href="login.php" class="btn btn-light btn-sm text-success">
            Acesso administrativo
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<header class="hero">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-lg-7">
        <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">Cuidado, acolhimento e segurança</span>
        <h1 class="display-5 fw-bold mb-3">Um ambiente tranquilo para o bem-estar da pessoa idosa</h1>
        <p class="lead mb-4">
          Nossa casa de repouso oferece hospedagem, acompanhamento diário e uma rotina pensada para proporcionar conforto, dignidade e qualidade de vida.
        </p>

        <a href="#galeria" class="btn btn-light fw-semibold me-2">Ver galeria</a>

        <?php if ($estaLogado): ?>
          <a href="dashboard.php" class="btn btn-outline-light fw-semibold">
            Ir para o painel
          </a>
        <?php else: ?>
          <a href="login.php" class="btn btn-outline-light fw-semibold">
            Acesso administrativo
          </a>
        <?php endif; ?>
      </div>
      <div class="col-lg-5">
        <div class="card card-soft p-4">
          <h2 class="h4 mb-3">Atendimento humanizado</h2>
          <p class="mb-0">
            Acolhemos cada residente com atenção individual, suporte da equipe e um ambiente preparado para oferecer tranquilidade à família.
          </p>
        </div>
      </div>
    </div>
  </div>
</header>

<section id="sobre" class="section-pad">
  <div class="container">
    <div class="row justify-content-center mb-4">
      <div class="col-lg-8 text-center">
        <h2 class="fw-bold">Sobre a casa de repouso</h2>
        <p class="text-muted mb-0">
          Somos uma instituição dedicada ao cuidado integral da pessoa idosa, com foco em segurança, convivência e bem-estar.
        </p>
      </div>
    </div>

    <div class="row g-4 align-items-stretch">
      <div class="col-md-6">
        <div class="card card-soft h-100 p-4">
          <div class="icon-box">01</div>
          <h3 class="h5">Nossa missão</h3>
          <p class="mb-0">
            Proporcionar assistência contínua e acolhedora, oferecendo suporte nas atividades diárias, alimentação balanceada, acompanhamento e um ambiente organizado para viver com mais tranquilidade.
          </p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card card-soft h-100 p-4">
          <div class="icon-box">02</div>
          <h3 class="h5">Nossa visão</h3>
          <p class="mb-0">
            Ser referência em cuidado institucional para idosos, com atendimento respeitoso, convivência saudável e estrutura adequada para cada fase da vida.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="servicos" class="section-pad bg-white">
  <div class="container">
    <div class="row justify-content-center mb-4">
      <div class="col-lg-8 text-center">
        <h2 class="fw-bold">Serviços oferecidos</h2>
        <p class="text-muted mb-0">
          Estrutura pensada para oferecer conforto, rotina organizada e apoio diário aos residentes.
        </p>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="card card-soft h-100 p-4">
          <h3 class="h5">Hospedagem</h3>
          <p class="mb-0">Alojamento confortável e seguro, com ambientes preparados para o dia a dia.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card card-soft h-100 p-4">
          <h3 class="h5">Alimentação</h3>
          <p class="mb-0">Refeições servidas de forma regular, com atenção às necessidades nutricionais.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card card-soft h-100 p-4">
          <h3 class="h5">Acompanhamento</h3>
          <p class="mb-0">Suporte nas rotinas diárias, com cuidado individual e observação constante.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="card card-soft h-100 p-4">
          <h3 class="h5">Convivência</h3>
          <p class="mb-0">Atividades e interação social para estimular bem-estar e qualidade de vida.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="diferenciais" class="section-pad">
  <div class="container">
    <div class="row justify-content-center mb-4">
      <div class="col-lg-8 text-center">
        <h2 class="fw-bold">Diferenciais</h2>
        <p class="text-muted mb-0">
          O cuidado vai além da hospedagem: oferecemos um ambiente acolhedor, rotina estável e atenção à família.
        </p>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card card-soft h-100 p-4">
          <h3 class="h5">Ambiente seguro</h3>
          <p class="mb-0">Espaços organizados para circulação, descanso e convivência com conforto.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card card-soft h-100 p-4">
          <h3 class="h5">Equipe dedicada</h3>
          <p class="mb-0">Profissionais comprometidos com atenção, respeito e suporte diário.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card card-soft h-100 p-4">
          <h3 class="h5">Tranquilidade familiar</h3>
          <p class="mb-0">A família acompanha com mais serenidade sabendo que há cuidado contínuo.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="galeria" class="section-pad bg-white">
  <div class="container">
    <div class="row justify-content-center mb-4">
      <div class="col-lg-8 text-center">
        <h2 class="fw-bold">Galeria</h2>
        <p class="text-muted mb-0">
          As imagens abaixo representam os ambientes e momentos da casa de repouso.
        </p>
      </div>
    </div>

    <div class="row g-4">
      <?php foreach ($imagens as $arquivo): ?>
        <div class="col-12 col-md-6 col-lg-4">
          <figure class="gallery-figure">
            <img src="/kairos/uploads/feed/<?php echo htmlspecialchars($arquivo); ?>"
                 class="figure-img img-fluid"
                 alt="<?php echo htmlspecialchars($legendas[$arquivo] ?? 'Imagem da galeria'); ?>">
            <figcaption class="figure-caption">
              <?php echo htmlspecialchars($legendas[$arquivo] ?? 'Imagem da galeria'); ?>
            </figcaption>
          </figure>
        </div>
      <?php endforeach; ?>

      <?php if (empty($imagens)): ?>
        <div class="col-12">
          <div class="alert alert-warning text-center mb-0">
            Nenhuma imagem encontrada em uploads/feed.
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section id="contato" class="section-pad">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center mb-4">
        <h2 class="fw-bold">Contato</h2>
        <p class="text-muted mb-0">
          Entre em contato para saber mais sobre vagas, rotina, visitas e informações sobre acolhimento.
        </p>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card card-soft h-100 p-4 text-center">
          <h3 class="h5">Telefone</h3>
          <p class="mb-0">(11) 0000-0000</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card card-soft h-100 p-4 text-center">
          <h3 class="h5">E-mail</h3>
          <p class="mb-0">contato@casaderepouso.com.br</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card card-soft h-100 p-4 text-center">
          <h3 class="h5">Endereço</h3>
          <p class="mb-0">Rua Exemplo, 123 - Centro</p>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="py-4">
  <div class="container text-center">
    <small>© 2026 Casa de Repouso. Todos os direitos reservados.</small>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>
</html>
