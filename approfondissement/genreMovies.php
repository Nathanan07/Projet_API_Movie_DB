<?php require("header.php"); ?>
<?php require("fonctions.php"); ?>

<?php
// Sécurisation de la récupération du paramètre GET 'id' :
// isset() vérifie que la clé existe dans $_GET (évite le PHP Notice)
// !empty() vérifie qu'elle n'est pas vide ou nulle
$genres = [];
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id     = $_GET['id'];           // ex: 28 (Action), 878 (Science-Fiction)
    $genres = filmParGenre($id);     // appel API avec l'id de genre
}

// Tableau de correspondance id_genre → nom lisible.
// Permet d'afficher "Films — Action" plutôt que "Films — 28".
$nomGenre = [
    28=>'Action', 12=>'Aventure', 16=>'Animation', 35=>'Comédie',
    80=>'Crime', 99=>'Documentaire', 18=>'Drame', 10751=>'Famille',
    14=>'Fantaisie', 36=>'Histoire', 27=>'Horreur', 10402=>'Musique',
    878=>'Science-Fiction', 53=>'Thriller', 10752=>'Guerre', 37=>'Western'
];
// Si l'id est dans le tableau, on prend son nom ; sinon on affiche 'Genre' par défaut
$titre = isset($nomGenre[$id]) ? $nomGenre[$id] : 'Genre';
?>

<div class="page-section">
  <div class="container">
    <div class="section-heading">
      <h4>Films — <?= $titre ?></h4> <!-- Affiche ex: "Films — Science-Fiction" -->
    </div>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3">
      <?php foreach ($genres as $movie) { ?>
        <div class="col">
          <div class="film-card">
            <img src="https://image.tmdb.org/t/p/w500/<?= $movie['poster_path']; ?>"
                 alt="<?= htmlspecialchars($movie['title']); ?>">
            <div class="film-body">
              <p class="film-title"><?= $movie['title']; ?></p>
              <?php /* Étoiles et note identiques aux autres pages liste */ ?>
              <a href="view.php?id=<?= $movie['id']; ?>" class="btn-voir">Voir</a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

<?php require("footer.php"); ?>