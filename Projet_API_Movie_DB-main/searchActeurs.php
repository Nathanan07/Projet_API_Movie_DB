<?php require("header.php"); ?>
<?php require("fonctions.php"); ?>

<?php
$acteurs = [];
if (isset($_GET['query']) && !empty(trim($_GET['query']))) {
    $query = trim($_GET['query']);
    $acteurs = rechercheActeur($query);
}
?>

<div class="album py-5 bg-body-tertiary">
  <div class="container">
    <h4>Résultats de recherche acteurs : <em><?= htmlspecialchars($query ?? ''); ?></em></h4>

    <?php if (empty($acteurs)) { ?>
      <p class="mt-3">Aucun acteur trouvé.</p>
    <?php } else { ?>
      <div class="row row-cols-2 row-cols-md-4 g-4 mt-2">
        <?php foreach ($acteurs as $acteur) { ?>
          <div class="col text-center">
            <?php if ($acteur['profile_path']) { ?>
              <img src="https://image.tmdb.org/t/p/w185/<?= $acteur['profile_path']; ?>" class="img-fluid rounded mb-2">
            <?php } else { ?>
              <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded mb-2" style="height:150px;">No image</div>
            <?php } ?>
            <p><a href="acteurDetails.php?id=<?= $acteur['id']; ?>"><?= $acteur['name']; ?></a></p>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</div>

<?php require("footer.php"); ?>