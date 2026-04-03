<?php require("header.php"); ?>
<?php require("fonctions.php"); ?>

<?php 
if (isset($_GET['id']) && !empty($_GET['id'])) { 
    $id = $_GET['id'];
    $acteur = detailActeur($id);
    $films = acteurFilm($id);
} else {
    echo "Aucun acteur sélectionné";
    exit;
}
?>

<div class="container mt-5">

    <div class="row">
        
        <div class="col-md-4">
            <img src="https://image.tmdb.org/t/p/w500/<?=$acteur['profile_path'];?>" class="img-fluid">
        </div>

        
        <div class="col-md-8">
            <div class="card p-3 shadow-sm text-center">
                <h2><?= $acteur['name']; ?></h2>

                <div class="bg-primary text-white p-2 mt-3">
                    Biographie
                </div>

                <p class="mt-3">
                    <?= $acteur['biography'] ? $acteur['biography'] : "Biographie non disponible"; ?>
                </p>
            </div>
        </div>
    </div>
