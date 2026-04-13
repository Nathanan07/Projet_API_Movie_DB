<?php require("header.php"); ?>
<?php require("fonctions.php"); ?>

<?php
$movies = [];
if (isset($_GET['query']) && !empty(trim($_GET['query']))) {
    $query = trim($_GET['query']);
    $movies = rechercheFilm($query);
}
?>

<div class="album py-5 bg-body-tertiary">
  <div class="container">
    <h4>Résultats de recherche pour : <em><?= htmlspecialchars($query ?? ''); ?></em></h4>

    <?php if (empty($movies)) { ?>
      <p class="mt-3">Aucun film trouvé.</p>
    <?php } else { ?>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 mt-2">
        <?php foreach ($movies as $movie) { ?>
          <div class="d-flex align-items-stretch">
            <div class="card shadow-sm">
              <?php if ($movie['poster_path']) { ?>
                <img src="https://image.tmdb.org/t/p/w780/<?= $movie['poster_path']; ?>">
              <?php } else { ?>
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height:200px;">No image</div>
              <?php } ?>
              <div class="card-body lh-sm d-flex flex-column">
                <p class="lh-sm"><strong><?= $movie['title']; ?></strong></p>
                <a href="view.php?id=<?= $movie['id']; ?>" class="btn btn-primary mt-auto">View</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</div>

<?php require("footer.php"); ?>