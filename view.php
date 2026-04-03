<?php 
require("header.php");
require("fonctions.php");

if (isset($_GET['id']) && !empty($_GET['id'])) { 
    $id = $_GET['id'];
    $movie = infoFilm($id); 
}
?>

<div class="container py-5">
  <div class="row">

    <!-- IMAGE -->
    <div class="col-md-4">
      <img class="img-fluid" src="<?php echo 'https://image.tmdb.org/t/p/w780/'.$movie['poster_path']; ?>">
    </div>

<!-- Front avec IA pour améliorer le décor -->




    <!-- INFOS -->
    <div class="col-md-8">
      <h2><?php echo $movie['title']; ?></h2>

      <p><?php echo $movie['overview']; ?></p>

      <h5>Genres</h5>
      <ul>
        <?php foreach($movie['genres'] as $genre): ?>
          <li><?php echo $genre['name']; ?></li>
        <?php endforeach; ?>
      </ul>

      <p><strong>Date de sortie :</strong> <?php echo $movie['release_date']; ?></p>
      <p><strong>Note :</strong> <?php echo $movie['vote_average']; ?>/10</p>

    </div>

  </div>
</div>

<?php require("footer.php"); ?>