<?php require("header.php"); ?> <!-- Inclut la navbar, le CSS global et ouvre la balise <main> -->
<?php require("fonctions.php"); ?> <!-- Donne accès à toutes les fonctions TMDB -->

<?php $popularMovies = popularMovies(); ?> <!-- Appel API : récupère le tableau des 20 films populaires -->

<div class="page-section">
  <div class="container">
    <div class="section-heading">
      <h4>Films populaires</h4>
    </div>

    <!-- Grille responsive Bootstrap : 2 colonnes sur mobile, 3 sur sm, 4 sur md, 5 sur lg -->
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3">
      <?php foreach ($popularMovies as $movie) { ?>
        <div class="col">
          <div class="film-card">
            <!-- poster_path : chemin relatif de l'affiche sur le CDN TMDB.
                 w500 = largeur 500px. On préfixe toujours avec l'URL de base. -->
            <img src="https://image.tmdb.org/t/p/w500/<?= $movie['poster_path']; ?>"
                 alt="<?= htmlspecialchars($movie['title']); ?>">
            <div class="film-body">
              <p class="film-title"><?= $movie['title']; ?></p>

              <?php
                // Conversion de la note /10 en étoiles /5
                // round() arrondit à l'entier le plus proche
                $s = round($movie['vote_average'] / 2);
                echo '<div style="...">';
                for ($i=0; $i<$s; $i++)  echo '<span style="color:#e8b84b;">★</span>'; // étoiles pleines (dorées)
                for ($i=$s; $i<5; $i++)  echo '<span style="color:#333;">★</span>';    // étoiles vides (grises)
                echo '<span ...>' . round($movie['vote_average'],1) . '/10</span>';     // note numérique
                echo '</div>';
              ?>

              <!-- Lien vers la page détail du film, avec l'id TMDB en paramètre GET -->
              <a href="view.php?id=<?= $movie['id']; ?>" class="btn-voir">Voir</a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

<?php require("footer.php"); ?> <!-- Ferme <main>, affiche le footer, inclut Bootstrap JS -->s