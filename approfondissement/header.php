<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Naily</title>
  
  <style>
    :root {
      --gold: #e8b84b;
      --gold-dim: rgba(232,184,75,0.15);
      --dark: #0a0a0a;
      --dark-card: #141414;
      --dark-mid: #1c1c1c;
      --border: rgba(255,255,255,0.06);
      --text: #e0e0e0;
      --muted: #777;
    }

    *, *::before, *::after { box-sizing: border-box; }

    body {
      background: var(--dark);
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      margin: 0;
      padding-top: 68px;
    }

    /* ══ NAVBAR ══ */
    .cs-nav {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 1000;
      height: 68px;
      display: flex;
      align-items: center;
      padding: 0 2.5rem;
      gap: 2rem;
      background: rgba(8,8,8,0.96);
      border-bottom: 1px solid rgba(232,184,75,0.15);
      backdrop-filter: blur(16px);
    }

    .cs-brand {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 1.85rem;
      color: var(--gold);
      letter-spacing: 3px;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 9px;
      flex-shrink: 0;
      transition: color 0.2s;
    }
    .cs-brand:hover { color: #fff; }
    .cs-brand svg { fill: currentColor; }

    .cs-links {
      display: flex;
      align-items: center;
      gap: 2px;
      list-style: none;
      margin: 0; padding: 0;
    }
    .cs-links > li { position: relative; }

    .cs-links a, .cs-drop-toggle {
      color: #999;
      text-decoration: none;
      font-size: 0.78rem;
      font-weight: 500;
      letter-spacing: 1px;
      text-transform: uppercase;
      padding: 6px 16px;
      border-radius: 20px;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      gap: 5px;
      cursor: pointer;
      user-select: none;
    }
    .cs-links a:hover {
      color: var(--gold);
      background: var(--gold-dim);
    }

    /* ══ DROPDOWN — hover sur le LI parent ══ */
    .cs-links li:hover .cs-drop-toggle {
      color: var(--gold);
      background: var(--gold-dim);
    }
    .cs-drop-toggle .chevron {
      font-size: 0.65rem;
      transition: transform 0.2s;
    }
    .cs-links li:hover .chevron { transform: rotate(180deg); }

    /*
      Le menu est positionné en top:100% du LI (pas de gap entre LI et menu)
      Un padding-top interne recrée l'espace visuel sans zone morte
      → la souris reste toujours sur le LI pendant le trajet toggle→menu
    */
    .cs-drop-menu {
      visibility: hidden;
      opacity: 0;
      pointer-events: none;
      position: absolute;
      top: 100%;
      left: 0;
      z-index: 9999;
      padding-top: 8px;
      transition: opacity 0.15s;
    }
    .cs-links li:hover .cs-drop-menu {
      visibility: visible;
      opacity: 1;
      pointer-events: auto;
    }
    .cs-drop-inner {
      background: #111;
      border: 1px solid rgba(232,184,75,0.18);
      border-radius: 10px;
      min-width: 340px;
      padding: 10px;
      box-shadow: 0 24px 64px rgba(0,0,0,0.7);
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2px;
    }
    .cs-drop-menu a {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 7px 12px;
      color: #aaa;
      text-decoration: none;
      font-size: 0.8rem;
      border-radius: 6px;
      transition: all 0.15s;
    }
    .cs-drop-menu a:hover {
      color: var(--gold);
      background: var(--gold-dim);
    }
    .cs-drop-menu a::before {
      content: '';
      width: 5px; height: 5px;
      border-radius: 50%;
      background: var(--gold);
      opacity: 0.4;
      flex-shrink: 0;
    }
    .cs-drop-menu a:hover::before { opacity: 1; }

    /* ══ SEARCH ══ */
    .cs-searches {
      margin-left: auto;
      display: flex;
      gap: 8px;
      align-items: center;
    }
    .cs-search { position: relative; }
    .cs-search i {
      position: absolute;
      left: 11px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gold);
      font-size: 0.78rem;
      pointer-events: none;
    }
    .cs-search input {
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(232,184,75,0.18);
      border-radius: 20px;
      color: #eee;
      font-size: 0.8rem;
      font-family: 'DM Sans', sans-serif;
      padding: 7px 14px 7px 30px;
      width: 155px;
      transition: all 0.25s;
    }
    .cs-search input::placeholder { color: #444; }
    .cs-search input:focus {
      outline: none;
      border-color: var(--gold);
      background: rgba(232,184,75,0.04);
      width: 195px;
    }

    /* ══ SHARED CONTENT STYLES ══ */
    .page-section { padding: 2.5rem 0 4rem; }

    .section-heading {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 2rem;
    }
    .section-heading::before {
      content: '';
      display: block;
      width: 4px;
      height: 32px;
      background: var(--gold);
      border-radius: 2px;
    }
    .section-heading h4 {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 1.8rem;
      letter-spacing: 2px;
      color: #fff;
      margin: 0;
    }

    .film-card {
      background: var(--dark-card);
      border-radius: 10px;
      overflow: hidden;
      border: 1px solid var(--border);
      transition: transform 0.25s ease, box-shadow 0.25s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
    }
    .film-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 50px rgba(0,0,0,0.55);
      border-color: rgba(232,184,75,0.2);
    }
    .film-card img {
      width: 100%;
      aspect-ratio: 2/3;
      object-fit: cover;
      display: block;
    }
    .film-card .film-body {
      padding: 12px 14px 16px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .film-card .film-title {
      font-size: 0.88rem;
      font-weight: 600;
      color: #ddd;
      margin-bottom: 10px;
      line-height: 1.3;
      flex: 1;
    }
    .btn-voir {
      display: inline-block;
      background: var(--gold);
      color: #000;
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      text-decoration: none;
      padding: 6px 16px;
      border-radius: 20px;
      transition: background 0.2s, transform 0.15s;
      align-self: flex-start;
      border: none;
      cursor: pointer;
    }
    .btn-voir:hover {
      background: #fff;
      color: #000;
      transform: scale(1.04);
    }

    main { min-height: 80vh; }
  </style>
  </head>
  <body>
         
  <nav class="cs-nav">
    <a href="popular.php" class="cs-brand">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 16">
        <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z"/>
      </svg>
      Naily
    </a>

    <ul class="cs-links">
      <li><a href="popular.php">Populaires</a></li>
      <li><a href="topRated.php">Mieux notés</a></li>
      <li>
        <span class="cs-drop-toggle">Genres <span class="chevron">▾</span></span>
        <div class="cs-drop-menu">
          <div class="cs-drop-inner">
            <a href="genreMovies.php?id=28">Action</a>
            <a href="genreMovies.php?id=12">Aventure</a>
            <a href="genreMovies.php?id=16">Animation</a>
            <a href="genreMovies.php?id=35">Comédie</a>
            <a href="genreMovies.php?id=80">Crime</a>
            <a href="genreMovies.php?id=99">Documentaire</a>
            <a href="genreMovies.php?id=18">Drame</a>
            <a href="genreMovies.php?id=10751">Famille</a>
            <a href="genreMovies.php?id=14">Fantaisie</a>
            <a href="genreMovies.php?id=36">Histoire</a>
            <a href="genreMovies.php?id=27">Horreur</a>
            <a href="genreMovies.php?id=10402">Musique</a>
            <a href="genreMovies.php?id=878">Science-Fiction</a>
            <a href="genreMovies.php?id=53">Thriller</a>
            <a href="genreMovies.php?id=10752">Guerre</a>
            <a href="genreMovies.php?id=37">Western</a>
          </div>
        </div>
      </li>
    </ul>

    <div class="cs-searches">
      <div class="cs-search">
        <form action="searchMovies.php" method="get">
          <i class="bi-film"></i>
          <input type="text" placeholder="Rechercher un film…" name="query">
        </form>
      </div>
      <div class="cs-search">
        <form action="searchActeurs.php" method="get">
          <i class="bi-person"></i>
          <input type="text" placeholder="Rechercher un acteur…" name="query">
        </form>
      </div>
    </div>
  </nav>

<main>