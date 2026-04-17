<?php require("header.php"); ?>
<?php require("fonctions.php"); ?>

<?php $toprated = topRated(); ?> <!-- Appel à la fonction topRated() → films classés par note -->

<!-- Structure identique à popular.php, seul l'appel de fonction et le titre changent.
     Cette répétition de structure est volontaire pour la lisibilité du projet. -->

<div class="page-section">
  <div class="container">
    <div class="section-heading">
      <h4>Mieux notés</h4>
    </div>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3">
      <?php foreach ($toprated as $movie) { ?>
        <div class="col">
          <div class="film-card">
            <img src="https://image.tmdb.org/t/p/w500/<?= $movie['poster_path']; ?>"
                 alt="<?= htmlspecialchars($movie['title']); ?>">
            <div class="film-body">
              <p class="film-title"><?= $movie['title']; ?></p>
              <?php /* Même logique de conversion étoiles que popular.php */ ?>
              <a href="view.php?id=<?= $movie['id']; ?>" class="btn-voir">Voir</a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

<?php require("footer.php"); ?>