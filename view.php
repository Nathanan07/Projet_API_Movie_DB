<?php 
require("header.php");
require("fonctions.php");

if (isset($_GET['id']) && !empty($_GET['id'])) { 
    $id = $_GET['id'];
    $movie = infoFilm($id); 
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
            <?php 
            $actors = infoFilm($id); 

            foreach ($actors as $actor) { ?>
                <div class="col-md-3 text-center mb-4">
                    <img src="https://image.tmdb.org/t/p/w300/<?=$actor['profile_path'];?>" class="img-fluid mb-2">

                    <h6><?= $actor['name']; ?></h6>

                    <a href="acteur.php?id=<?=$actor['id']?>" class="btn btn-primary btn-sm">Read More</a>
                </div>
            <?php } ?>
        </div>
    </div>

<center><?php if ($trailer) { ?>
    <div class="mt-4">
        <h4>Bande annonce</h4>

        <iframe width="50%" height="400"
            src="https://www.youtube.com/embed/<?= $trailer; ?>"
            frameborder="0"
            allowfullscreen>
        </iframe>
    </div>
<?php } ?></center>


</div>
<!-- 
          <p><strong>Date de sortie :</strong> <?php echo $movie['release_date']; ?></p>
          <p><strong>Note :</strong> <?php echo $movie['vote_average']; ?>/10</p> -->

<?php require("footer.php"); ?>