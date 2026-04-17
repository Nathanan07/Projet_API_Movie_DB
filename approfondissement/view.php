<?php 
require("header.php");
require("fonctions.php");

if (isset($_GET['id']) && !empty($_GET['id'])) { 
    $id = $_GET['id'];
    $movie  = infoFilm($id);
    $actors = acteurFilm($id);
    $trailer = trailer($id);
} else {
    echo "<div class='container mt-5'><p>Aucun film sélectionné.</p></div>";
    require("footer.php");
    exit;
}

// Calcul étoiles (sur 5)
$note = round($movie['vote_average'], 1);
$stars = round($note / 2);          // note /10 → /5
$emptyStars = 5 - $stars;

// Couleur de la note
function noteColor($n) {
    if ($n >= 7.5) return '#4caf7d';
    if ($n >= 5)   return '#e8b84b';
    return '#e05c5c';
}
$noteCol = noteColor($note);
?>

<style>
  /* ── VIEW PAGE SPECIFIC ── */
  .view-hero {
    background: linear-gradient(to right, #0a0a0a 40%, rgba(10,10,10,0.6));
    padding: 3rem 0 2rem;
  }
  .view-poster {
    border-radius: 10px;
    box-shadow: 0 30px 80px rgba(0,0,0,0.7);
    width: 100%;
    max-width: 300px;
    display: block;
  }
  .film-meta-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 12px;
    padding: 2rem;
  }
  .film-title-big {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2.6rem;
    letter-spacing: 2px;
    color: #fff;
    margin-bottom: 0.4rem;
    line-height: 1.1;
  }
  .genre-pill {
    display: inline-block;
    background: rgba(232,184,75,0.1);
    border: 1px solid rgba(232,184,75,0.3);
    color: #e8b84b;
    border-radius: 20px;
    padding: 4px 12px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin: 3px;
  }

  /* ── NOTE BLOC ── */
  .note-bloc {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 12px;
    padding: 1.2rem 1.5rem;
    margin: 1.5rem 0;
    flex-wrap: wrap;
  }
  .note-circle {
    width: 72px; height: 72px;
    border-radius: 50%;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    font-family: 'Bebas Neue', sans-serif;
    flex-shrink: 0;
    position: relative;
  }
  .note-circle .score {
    font-size: 1.6rem;
    line-height: 1;
  }
  .note-circle .max {
    font-size: 0.65rem;
    color: #888;
  }
  .note-stars { font-size: 1.1rem; letter-spacing: 2px; }
  .note-votes { font-size: 0.8rem; color: #666; margin-top: 2px; }
  .note-label {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1.1rem;
    letter-spacing: 2px;
  }

  /* ── ACTORS ── */
  .actors-section {
    padding: 3rem 0;
    border-top: 1px solid rgba(255,255,255,0.05);
  }
  .actor-card {
    text-align: center;
  }
  .actor-card img {
    width: 100%;
    aspect-ratio: 2/3;
    object-fit: cover;
    object-position: top;
    border-radius: 10px;
    margin-bottom: 10px;
    border: 2px solid rgba(255,255,255,0.05);
    transition: border-color 0.2s;
  }
  .actor-card:hover img { border-color: rgba(232,184,75,0.4); }
  .actor-name { font-size: 0.88rem; font-weight: 600; color: #ddd; margin-bottom: 2px; }
  .actor-role { font-size: 0.75rem; color: #666; margin-bottom: 8px; font-style: italic; }

  /* ── TRAILER ── */
  .trailer-section {
    padding: 3rem 0;
    border-top: 1px solid rgba(255,255,255,0.05);
  }
  .trailer-wrapper {
    position: relative;
    width: 100%;
    padding-bottom: 50%;   /* 16:9 large */
    height: 0;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.6);
  }
  .trailer-wrapper iframe {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    border: none;
  }
</style>

<div class="view-hero">
  <div class="container">
    <div class="row align-items-start g-4">

      <!-- Affiche -->
      <div class="col-md-3 text-center">
        <img src="https://image.tmdb.org/t/p/w500/<?= $movie['poster_path']; ?>"
             class="view-poster" alt="<?= htmlspecialchars($movie['title']); ?>">
      </div>

      <!-- Infos -->
      <div class="col-md-9">
        <div class="film-meta-card">
          <h1 class="film-title-big"><?= $movie['title']; ?></h1>

          <?php if (!empty($movie['tagline'])) { ?>
            <p style="color:#666; font-style:italic; font-size:0.9rem; margin-bottom:1rem;">
              « <?= $movie['tagline']; ?> »
            </p>
          <?php } ?>

          <!-- Genres -->
          <div style="margin-bottom:1rem;">
            <?php foreach ($movie['genres'] as $g) { ?>
              <span class="genre-pill"><?= $g['name']; ?></span>
            <?php } ?>
          </div>

          <!-- Synopsis -->
          <p style="color:#aaa; font-size:0.92rem; line-height:1.7; margin-bottom:0;">
            <?= $movie['overview'] ?: 'Synopsis non disponible.'; ?>
          </p>

          <!-- NOTE BLOC -->
          <div class="note-bloc">
            <!-- Cercle note -->
            <div class="note-circle"
                 style="border: 3px solid <?= $noteCol ?>; color:<?= $noteCol ?>;">
              <span class="score"><?= $note; ?></span>
              <span class="max">/10</span>
            </div>

            <!-- Étoiles + votes -->
            <div>
              <div class="note-label" style="color:<?= $noteCol ?>;">
                <?php
                  if ($note >= 8)      echo 'Excellent';
                  elseif ($note >= 7)  echo 'Très bon';
                  elseif ($note >= 5)  echo 'Correct';
                  else                 echo 'Médiocre';
                ?>
              </div>
              <div class="note-stars">
                <?php
                  for ($i = 0; $i < $stars; $i++)      echo '<span style="color:#e8b84b;">★</span>';
                  for ($i = 0; $i < $emptyStars; $i++) echo '<span style="color:#333;">★</span>';
                ?>
              </div>
              <div class="note-votes"><?= number_format($movie['vote_count'], 0, ',', ' '); ?> votes</div>
            </div>

            <!-- Infos supplémentaires -->
            <div style="margin-left:auto; text-align:right; font-size:0.82rem; color:#666; line-height:1.9;">
              <?php if (!empty($movie['release_date'])) { ?>
                <div>📅 <?= date('d/m/Y', strtotime($movie['release_date'])); ?></div>
              <?php } ?>
              <?php if (!empty($movie['runtime']) && $movie['runtime'] > 0) { ?>
                <div>⏱ <?= $movie['runtime']; ?> min</div>
              <?php } ?>
              <?php if (!empty($movie['original_language'])) { ?>
                <div>🌐 <?= strtoupper($movie['original_language']); ?></div>
              <?php } ?>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<!-- ── ACTEURS ── -->
<div class="actors-section">
  <div class="container">
    <div class="section-heading">
      <h4>Principaux acteurs</h4>
    </div>
    <div class="row row-cols-2 row-cols-md-4 g-3">
      <?php foreach ($actors as $actor) { ?>
        <div class="col">
          <div class="actor-card">
            <?php if ($actor['profile_path']) { ?>
              <img src="https://image.tmdb.org/t/p/w300/<?= $actor['profile_path']; ?>"
                   alt="<?= htmlspecialchars($actor['name']); ?>">
            <?php } else { ?>
              <div style="aspect-ratio:2/3; background:#1a1a1a; border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:10px; color:#444;">
                <i class="bi-person" style="font-size:2rem;"></i>
              </div>
            <?php } ?>
            <p class="actor-name"><?= $actor['name']; ?></p>
            <p class="actor-role"><?= $actor['character']; ?></p>
            <a href="acteurDetails.php?id=<?= $actor['id']; ?>" class="btn-voir">Voir la fiche</a>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

<!-- ── BANDE-ANNONCE ── -->
<?php if ($trailer) { ?>
<div class="trailer-section">
  <div class="container">
    <div class="section-heading">
      <h4>Bande-annonce</h4>
    </div>
    <div class="trailer-wrapper">
      <iframe src="https://www.youtube.com/embed/<?= $trailer; ?>?rel=0"
              allowfullscreen
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
      </iframe>
    </div>
  </div>
</div>
<?php } ?>

<?php require("footer.php"); ?>