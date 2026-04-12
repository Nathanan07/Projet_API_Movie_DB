<?php 
require("header.php");
require("fonctions.php");

if (isset($_GET['id']) && !empty($_GET['id'])) { 
    $id = $_GET['id'];
    $movie = infoFilm($id);
    // BUG CORRIGÉ : acteurFilm() récupère le casting du film (pas infoFilm)
    $actors = acteurFilm($id);
    // BUG CORRIGÉ : $trailer n'était pas défini avant utilisation
    $trailer = trailer($id);
} else {
    echo "Aucun film sélectionné";
    exit;
}
?>

<div class="container mt-5">

    <div class="row">
        
        <div class="col-md-4">
            <img src="https://image.tmdb.org/t/p/w500/<?=$movie['poster_path'];?>" class="img-fluid">
        </div>

        <div class="col-md-8">
            <div class="card p-3 shadow-sm">
                <h2 class="text-center"><?= $movie['title']; ?></h2>
                <p class="text-center"><?= $movie['overview']; ?></p>

                <p class="text-center text-muted">
                    <strong>Date de sortie :</strong> <?= $movie['release_date']; ?> &nbsp;|&nbsp;
                    <strong>Note :</strong> <?= round($movie['vote_average'], 1); ?>/10
                </p>

                <div class="mt-3">
                    <div class="bg-primary text-white text-center p-2">Genre</div>
                    <?php foreach ($movie['genres'] as $genre) { ?>
                        <div class="border text-center p-2">
                            <?= $genre['name']; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Acteurs -->
    <div class="mt-5 p-4 bg-light">
        <h4 class="text-primary mb-4">Principaux acteurs</h4>

        <div class="row">
            <?php foreach ($actors as $actor) { ?>
                <div class="col-md-3 text-center mb-4">
                    <?php if ($actor['profile_path']) { ?>
                        <img src="https://image.tmdb.org/t/p/w300/<?= $actor['profile_path']; ?>" class="img-fluid mb-2">
                    <?php } else { ?>
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center mb-2" style="height:200px;">Photo indisponible</div>
                    <?php } ?>
                    <h6><?= $actor['name']; ?></h6>
                    <p class="text-muted small"><?= $actor['character']; ?></p>
                    <!-- BUG CORRIGÉ : lien vers acteurDetails.php (et non acteur.php) -->
                    <a href="acteurDetails.php?id=<?= $actor['id']; ?>" class="btn btn-primary btn-sm">Read More</a>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Bande annonce -->
    <?php if ($trailer) { ?>
    <div class="mt-4 text-center">
        <h4>Bande annonce</h4>
        <iframe width="50%" height="400"
            src="https://www.youtube.com/embed/<?= $trailer; ?>"
            frameborder="0"
            allowfullscreen>
        </iframe>
    </div>
    <?php } ?>

</div>

<?php require("footer.php"); ?>