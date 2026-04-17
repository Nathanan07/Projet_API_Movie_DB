<?php require("header.php"); ?>
<?php require("fonctions.php"); ?>

<?php 
if (isset($_GET['id']) && !empty($_GET['id'])) { 
    $id     = $_GET['id'];
    $acteur = detailActeur($id);  // infos biographiques de la personne
    $films  = mainFilmAc($id);   // ses 8 principaux crédits (films + séries)
} else {
    // Protection : si on accède à la page sans paramètre id, on arrête proprement
    echo "<div class='container mt-5'><p>Aucun acteur sélectionné.</p></div>";
    require("footer.php");
    exit;
}
?>

<style>
  .acteur-hero { padding: 3rem 0 2.5rem; }
  .acteur-photo {
    border-radius: 10px;
    box-shadow: 0 30px 80px rgba(0,0,0,0.7);
    width: 100%;
    max-width: 280px;
    display: block;
  }
  .acteur-meta {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 12px;
    padding: 2rem;
  }
  .acteur-name {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2.4rem;
    letter-spacing: 2px;
    color: #fff;
    margin-bottom: 0.3rem;
  }
  .acteur-bio {
    color: #999;
    font-size: 0.9rem;
    line-height: 1.8;
    margin-top: 1rem;
    max-height: 240px;
    overflow-y: auto;
    padding-right: 6px;
  }
  .acteur-bio::-webkit-scrollbar { width: 4px; }
  .acteur-bio::-webkit-scrollbar-track { background: #1a1a1a; }
  .acteur-bio::-webkit-scrollbar-thumb { background: #e8b84b; border-radius: 2px; }

  .info-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(232,184,75,0.08);
    border: 1px solid rgba(232,184,75,0.2);
    color: #e8b84b;
    border-radius: 20px;
    padding: 4px 12px;
    font-size: 0.78rem;
    margin: 3px;
  }
</style>

<div class="acteur-hero">
  <div class="container">
    <div class="row align-items-start g-4">

      <!-- Photo -->
      <div class="col-md-3 text-center">
        <?php if ($acteur['profile_path']) { ?>
          <img src="https://image.tmdb.org/t/p/w500/<?= $acteur['profile_path']; ?>"
               class="acteur-photo" alt="<?= htmlspecialchars($acteur['name']); ?>">
        <?php } else { ?>
          <div style="width:100%; max-width:280px; aspect-ratio:2/3; background:#1a1a1a; border-radius:10px; display:flex; align-items:center; justify-content:center; margin:auto; color:#444;">
            <i class="bi-person" style="font-size:4rem;"></i>
          </div>
        <?php } ?>
      </div>

      <!-- Infos -->
      <div class="col-md-9">
        <div class="acteur-meta">
          <h1 class="acteur-name"><?= $acteur['name']; ?></h1>

          <!-- Pills d'infos -->
          <div style="margin-bottom:1rem;">
            <?php if (!empty($acteur['birthday'])) { ?>
              <span class="info-pill">📅 Né(e) le <?= date('d/m/Y', strtotime($acteur['birthday'])); ?></span>
            <?php } ?>
            <?php if (!empty($acteur['place_of_birth'])) { ?>
              <span class="info-pill">📍 <?= $acteur['place_of_birth']; ?></span>
            <?php } ?>
            <?php if (!empty($acteur['known_for_department'])) { ?>
              <span class="info-pill">🎬 <?= $acteur['known_for_department']; ?></span>
            <?php } ?>
          </div>

          <!-- Biographie -->
          <div style="background:rgba(232,184,75,0.06); border-left:3px solid #e8b84b; padding:10px 16px; border-radius:0 6px 6px 0; margin-bottom:0.8rem;">
            <span style="font-family:'Bebas Neue',sans-serif; letter-spacing:1px; color:#e8b84b; font-size:0.9rem;">Biographie</span>
          </div>
          <div class="acteur-bio">
            <?= $acteur['biography'] ?: 'Biographie non disponible.'; ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Films de l'acteur -->
<div style="padding:2rem 0 4rem; border-top:1px solid rgba(255,255,255,0.05);">
  <div class="container">
    <div class="section-heading">
      <h4>Principaux films</h4>
    </div>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-3">
      <?php foreach ($films as $film) {
        if (empty($film['poster_path'])) continue; ?>
        <div class="col">
          <div class="film-card">
            <img src="https://image.tmdb.org/t/p/w300/<?= $film['poster_path']; ?>"
                 alt="<?= htmlspecialchars($film['title'] ?? $film['name'] ?? ''); ?>">
            <div class="film-body">
              <p class="film-title"><?= $film['title'] ?? $film['name']; ?></p>
              <a href="view.php?id=<?= $film['id']; ?>" class="btn-voir">Voir le film</a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

<?php require("footer.php"); ?>