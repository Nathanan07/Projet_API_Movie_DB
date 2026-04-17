<?php require("header.php"); ?>
<?php require("fonctions.php"); ?>

<?php
$movies = [];
$query = '';
if (isset($_GET['query']) && !empty(trim($_GET['query']))) {
    $query  = trim($_GET['query']);
    $movies = rechercheFilm($query);
}
?>

<div class="page-section">
  <div class="container">
    <div class="section-heading">
      <h4>Films : «&nbsp;<?= htmlspecialchars($query); ?>&nbsp;»</h4>
    </div>

    <?php if (empty($movies)) { ?>
      <p style="color:#666; margin-top:1rem;">Aucun film trouvé pour cette recherche.</p>
    <?php } else { ?>
      <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3">
        <?php foreach ($movies as $movie) { ?>
          <div class="col">
            <div class="film-card">
              <?php if ($movie['poster_path']) { ?>
                <img src="https://image.tmdb.org/t/p/w500/<?= $movie['poster_path']; ?>"
                     alt="<?= htmlspecialchars($movie['title']); ?>">
              <?php } else { ?>
                <div style="aspect-ratio:2/3; background:#1a1a1a; display:flex; align-items:center; justify-content:center; color:#333;">
                  <i class="bi-film" style="font-size:2.5rem;"></i>
                </div>
              <?php } ?>
              <div class="film-body">
                <p class="film-title"><?= $movie['title']; ?></p>
                <a href="view.php?id=<?= $movie['id']; ?>" class="btn-voir">Voir</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</div>

<?php require("footer.php"); ?>