<?php require("header.php"); ?>
<?php require("fonctions.php"); ?>

<?php
$acteurs = [];
$query = '';
if (isset($_GET['query']) && !empty(trim($_GET['query']))) {
    $query   = trim($_GET['query']);
    $acteurs = rechercheActeur($query);
}
?>

<div class="page-section">
  <div class="container">
    <div class="section-heading">
      <h4>Acteurs : «&nbsp;<?= htmlspecialchars($query); ?>&nbsp;»</h4>
    </div>

    <?php if (empty($acteurs)) { ?>
      <p style="color:#666; margin-top:1rem;">Aucun acteur trouvé pour cette recherche.</p>
    <?php } else { ?>
      <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3">
        <?php foreach ($acteurs as $acteur) { ?>
          <div class="col text-center">
            <?php if ($acteur['profile_path']) { ?>
              <img src="https://image.tmdb.org/t/p/w185/<?= $acteur['profile_path']; ?>"
                   style="width:100%; aspect-ratio:2/3; object-fit:cover; object-position:top; border-radius:10px; margin-bottom:8px; border:2px solid rgba(255,255,255,0.05);"
                   alt="<?= htmlspecialchars($acteur['name']); ?>">
            <?php } else { ?>
              <div style="aspect-ratio:2/3; background:#1a1a1a; border-radius:10px; display:flex; align-items:center; justify-content:center; color:#333; margin-bottom:8px;">
                <i class="bi-person" style="font-size:2.5rem;"></i>
              </div>
            <?php } ?>
            <p style="font-size:0.85rem; font-weight:600; color:#ddd; margin-bottom:6px;">
              <?= $acteur['name']; ?>
            </p>
            <a href="acteurDetails.php?id=<?= $acteur['id']; ?>" class="btn-voir">Voir la fiche</a>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</div>

<?php require("footer.php"); ?>