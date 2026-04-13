<?php require("header.php"); ?>
<?php require("fonctions.php"); ?>

<?php 
if (isset($_GET['id']) && !empty($_GET['id'])) { 
    $id = $_GET['id'];
    $acteur = detailActeur($id);
    // BUG CORRIGÉ : acteurFilm($id) récupère les acteurs d'un FILM, pas les films d'un acteur
    // Il faut utiliser mainFilmAc($id) pour les principaux films d'un acteur
    $films = mainFilmAc($id);
} else {
    echo "Aucun acteur sélectionné";
    exit;
}
?>

<div class="container mt-5">

    <div class="row">
        
        <div class="col-md-4">
            <?php if ($acteur['profile_path']) { ?>
                <img src="https://image.tmdb.org/t/p/w500/<?= $acteur['profile_path']; ?>" class="img-fluid">
            <?php } else { ?>
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height:300px;">Photo indisponible</div>
            <?php } ?>
        </div>

        <div class="col-md-8">
            <div class="card p-3 shadow-sm text-center">
                <h2><?= $acteur['name']; ?></h2>

                <?php if (!empty($acteur['birthday'])) { ?>
                    <p class="text-muted">Né(e) le : <?= $acteur['birthday']; ?>
                    <?php if (!empty($acteur['place_of_birth'])) { echo ' à ' . $acteur['place_of_birth']; } ?>
                    </p>
                <?php } ?>

                <div class="bg-primary text-white p-2 mt-3">
                    Biographie
                </div>

                <p class="mt-3 text-start">
                    <?= $acteur['biography'] ? $acteur['biography'] : "Biographie non disponible"; ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Principaux films de l'acteur -->
    <div class="mt-5 p-4 bg-light">
        <h4 class="text-primary mb-4">Principaux films</h4>
        <div class="row row-cols-2 row-cols-md-4 g-3">
            <?php foreach ($films as $film) { ?>
                <?php if (!empty($film['poster_path'])) { ?>
                <div class="col text-center">
                    <img src="https://image.tmdb.org/t/p/w300/<?= $film['poster_path']; ?>" class="img-fluid mb-2">
                    <p class="small"><?= $film['title'] ?? $film['name']; ?></p>
                    <a href="view.php?id=<?= $film['id']; ?>" class="btn btn-primary btn-sm">Voir le film</a>
                </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>

</div>

<?php require("footer.php"); ?>