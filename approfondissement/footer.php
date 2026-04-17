</main>

<footer style="background:#080808; border-top:1px solid rgba(232,184,75,0.12); margin-top:4rem; padding:2.5rem 0 1.8rem; font-family:'DM Sans',sans-serif;">
  <div style="max-width:1200px; margin:0 auto; padding:0 2rem; display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:1.2rem;">

    <!-- Logo -->
    <div style="display:flex; align-items:center; gap:10px;">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#e8b84b" viewBox="0 0 16 16">
        <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z"/>
      </svg>
      <span style="font-family:'Bebas Neue',sans-serif; font-size:1.3rem; letter-spacing:3px; color:#e8b84b;">Naily</span>
    </div>

    <!-- Nav rapide -->
    <nav style="display:flex; gap:1.4rem; flex-wrap:wrap;">
      <a href="popular.php"    style="color:#777; text-decoration:none; font-size:0.82rem; letter-spacing:0.5px; transition:color 0.2s;" onmouseover="this.style.color='#e8b84b'" onmouseout="this.style.color='#777'">Populaires</a>
      <a href="topRated.php"   style="color:#777; text-decoration:none; font-size:0.82rem; letter-spacing:0.5px;" onmouseover="this.style.color='#e8b84b'" onmouseout="this.style.color='#777'">Mieux notés</a>
      <a href="genreMovies.php?id=28" style="color:#777; text-decoration:none; font-size:0.82rem; letter-spacing:0.5px;" onmouseover="this.style.color='#e8b84b'" onmouseout="this.style.color='#777'">Action</a>
      <a href="genreMovies.php?id=878" style="color:#777; text-decoration:none; font-size:0.82rem; letter-spacing:0.5px;" onmouseover="this.style.color='#e8b84b'" onmouseout="this.style.color='#777'">Science-Fiction</a>
      <a href="genreMovies.php?id=18"  style="color:#777; text-decoration:none; font-size:0.82rem; letter-spacing:0.5px;" onmouseover="this.style.color='#e8b84b'" onmouseout="this.style.color='#777'">Drame</a>
    </nav>

    <!-- Portfolio -->
    <a href="https://nathanan07.github.io/" target="_blank"
       style="display:flex; align-items:center; gap:7px; background:rgba(232,184,75,0.08); border:1px solid rgba(232,184,75,0.3); border-radius:20px; padding:7px 16px; color:#e8b84b; text-decoration:none; font-size:0.8rem; font-weight:600; letter-spacing:0.5px; transition:all 0.2s;"
       onmouseover="this.style.background='rgba(232,184,75,0.18)'; this.style.borderColor='#e8b84b';"
       onmouseout="this.style.background='rgba(232,184,75,0.08)'; this.style.borderColor='rgba(232,184,75,0.3)';">
      <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
      </svg>
      Portfolio · Nathanan SONGCHAROENKUL
    </a>

  </div>

  <!-- Séparateur -->
  <div style="max-width:1200px; margin:1.5rem auto 0; padding:0 2rem; border-top:1px solid rgba(255,255,255,0.04); padding-top:1.2rem; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:0.5rem;">
    <p style="margin:0; font-size:0.75rem; color:#444;">
      © <?= date('Y'); ?> Naily — Données fournies par 
      <a href="https://www.themoviedb.org" target="_blank" style="color:#e8b84b; text-decoration:none;">The Movie Database (TMDB)</a>
    </p>
    <a href="#top" style="color:#555; font-size:0.75rem; text-decoration:none; display:flex; align-items:center; gap:4px;"
       onmouseover="this.style.color='#e8b84b'" onmouseout="this.style.color='#555'">
      ↑ Retour en haut
    </a>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>