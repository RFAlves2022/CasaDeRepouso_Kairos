<?php
include_once "header.php";

$posts = [
  [
    'imagem' => 'uploads/feed/feed1.jpg',
    'data' => '02/06/2026',
    'titulo' => 'Manhã de acolhimento',
    'descricao' => 'Café da manhã com acompanhamento da equipe e ambiente tranquilo.'
  ],
  [
    'imagem' => 'uploads/feed/feed2.jpg',
    'data' => '01/06/2026',
    'titulo' => 'Atividade em grupo',
    'descricao' => 'Momento de convivência com música, conversa e integração entre os residentes.'
  ],
  [
    'imagem' => 'uploads/feed/feed3.jpg',
    'data' => '31/05/2026',
    'titulo' => 'Cuidado diário',
    'descricao' => 'Atenção especial à rotina, conforto e bem-estar dos residentes.'
  ],
  [
    'imagem' => 'uploads/feed/feed4.jpg',
    'data' => '30/05/2026',
    'titulo' => 'Espaço de descanso',
    'descricao' => 'Ambientes preparados para oferecer segurança, calma e acolhimento.'
  ]
];
?>

<style>
  body{
    background:#E5F2E8;
  }

  .home-shell{
    max-width:1200px;
    margin:0 auto;
    padding:24px 16px 48px;
  }

  .hero-card{
    position:relative;
    overflow:hidden;
    border-radius:28px;
    background:linear-gradient(135deg, rgba(31,91,54,.96), rgba(93,115,126,.90));
    color:#fff;
    box-shadow:0 18px 40px rgba(12,39,26,0.16);
  }

  .hero-inner{
    padding:48px 28px;
    min-height:360px;
    display:flex;
    align-items:center;
  }

  .hero-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:8px 14px;
    border-radius:999px;
    background:rgba(255,255,255,.14);
    font-size:.9rem;
    margin-bottom:18px;
  }

  .hero-title{
    font-size:clamp(2rem, 4vw, 3.5rem);
    font-weight:800;
    line-height:1.05;
    margin-bottom:16px;
  }

  .hero-text{
    max-width:620px;
    font-size:1.05rem;
    color:rgba(255,255,255,.92);
    margin-bottom:24px;
  }

  .btn-login{
    border-radius:999px;
    background:#fff;
    color:#1F5B36;
    border:none;
    font-weight:700;
    padding:12px 22px;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:8px;
  }

  .btn-login:hover{
    background:#F3F9F6;
    color:#18452A;
  }

  .btn-outline-home{
    border-radius:999px;
    border:1px solid rgba(255,255,255,.45);
    color:#fff;
    padding:12px 22px;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:8px;
    margin-left:10px;
  }

  .btn-outline-home:hover{
    background:rgba(255,255,255,.10);
    color:#fff;
  }

  .section-title{
    font-size:1.4rem;
    font-weight:700;
    color:#1F5B36;
    margin-bottom:10px;
  }

  .section-sub{
    color:#71827A;
    margin-bottom:18px;
  }

  .info-card{
    background:#fff;
    border-radius:22px;
    border:1px solid #D5E3DC;
    box-shadow:0 10px 24px rgba(12,39,26,0.08);
    padding:22px;
    height:100%;
  }

  .feed-card{
    background:#fff;
    border-radius:22px;
    border:1px solid #D5E3DC;
    overflow:hidden;
    box-shadow:0 10px 24px rgba(12,39,26,0.08);
    height:100%;
  }

  .feed-img{
    width:100%;
    aspect-ratio: 4 / 5;
    object-fit:cover;
    object-position:center top;
    display:block;
    background:#E7F1EB;
  }

  .feed-body{
    padding:16px 16px 18px;
  }

  .feed-date{
    font-size:.85rem;
    color:#819089;
    margin-bottom:6px;
  }

  .feed-title{
    font-size:1rem;
    font-weight:700;
    color:#1F2E29;
    margin-bottom:6px;
  }

  .feed-desc{
    font-size:.92rem;
    color:#556861;
    margin-bottom:0;
  }

  .mini-stat{
    display:flex;
    align-items:flex-start;
    gap:12px;
    margin-bottom:14px;
  }

  .mini-icon{
    width:42px;
    height:42px;
    border-radius:12px;
    background:#E7F1EB;
    color:#1F5B36;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
  }

  .mini-icon i{
    font-size:1.1rem;
  }

  .mini-title{
    font-weight:700;
    color:#1F2E29;
    margin-bottom:2px;
  }

  .mini-text{
    color:#71827A;
    font-size:.92rem;
    margin-bottom:0;
  }

  .section-gap{
    margin-top:28px;
  }

  @media (max-width: 767.98px){
    .hero-inner{
      padding:36px 18px;
      min-height:auto;
    }

    .btn-outline-home{
      margin-left:0;
      margin-top:10px;
    }
  }
</style>

<main>
  <div class="home-shell">

    <section class="hero-card mb-4">
      <div class="hero-inner">
        <div>
          <div class="hero-badge">
            <i class="bi bi-heart-pulse-fill"></i>
            Kairos Casa de Repouso
          </div>

          <h1 class="hero-title">Acolhimento, cuidado e tranquilidade para quem você ama.</h1>

          <p class="hero-text">
            Um ambiente preparado para oferecer atenção humanizada, conforto, segurança e rotina de bem-estar aos residentes.
          </p>

          <a href="login.php" class="btn-login">
            <i class="bi bi-box-arrow-in-right"></i>
            Acessar sistema
          </a>

          <a href="#galeria" class="btn-outline-home">
            <i class="bi bi-images"></i>
            Ver galeria
          </a>
        </div>
      </div>
    </section>

    <section class="row g-4">
      <div class="col-12 col-lg-4">
        <div class="info-card">
          <div class="mini-stat">
            <div class="mini-icon"><i class="bi bi-house-heart"></i></div>
            <div>
              <div class="mini-title">Ambiente acolhedor</div>
              <p class="mini-text">Espaços pensados para conforto, rotina e segurança.</p>
            </div>
          </div>

          <div class="mini-stat">
            <div class="mini-icon"><i class="bi bi-people"></i></div>
            <div>
              <div class="mini-title">Equipe dedicada</div>
              <p class="mini-text">Cuidado diário com atenção personalizada.</p>
            </div>
          </div>

          <div class="mini-stat mb-0">
            <div class="mini-icon"><i class="bi bi-shield-check"></i></div>
            <div>
              <div class="mini-title">Segurança e rotina</div>
              <p class="mini-text">Acompanhamento com organização e tranquilidade.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-8">
        <div class="info-card">
          <h2 class="section-title">Sobre a Kairos</h2>
          <p class="section-sub">
            A Kairos Casa de Repouso oferece uma experiência de cuidado com foco na dignidade, convivência e bem-estar dos residentes.
          </p>
          <p class="mb-0" style="color:#556861;">
            Nossa proposta é unir acolhimento, estrutura e acompanhamento próximo, para que cada residente se sinta seguro e respeitado em sua rotina.
          </p>
        </div>
      </div>
    </section>

    <section class="section-gap" id="galeria">
      <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-3">
        <div>
          <h2 class="section-title mb-1">Galeria da casa</h2>
          <p class="section-sub mb-0">Um feed com registros do dia a dia, no estilo Instagram.</p>
        </div>
      </div>

      <div class="row g-4">
        <?php foreach ($posts as $post): ?>
          <div class="col-12 col-sm-6 col-lg-3">
            <article class="feed-card">
              <img src="<?= htmlspecialchars($post['imagem']) ?>" alt="<?= htmlspecialchars($post['titulo']) ?>" class="feed-img">
              <div class="feed-body">
                <div class="feed-date"><?= htmlspecialchars($post['data']) ?></div>
                <div class="feed-title"><?= htmlspecialchars($post['titulo']) ?></div>
                <p class="feed-desc"><?= htmlspecialchars($post['descricao']) ?></p>
              </div>
            </article>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

  </div>
</main>

<?php include_once "footer.php"; ?>
