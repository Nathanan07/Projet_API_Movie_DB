<?php

// On inclut get-proxy.php pour avoir accès à la fonction getProxy()
// qui est utilisée par toutes les fonctions ci-dessous.
require_once("get-proxy.php");

    /*
     * Clé API TMDB : identifiant personnel généré sur le site themoviedb.org.
     * Elle est répétée dans chaque fonction (plutôt qu'en variable globale)
     */

    // ─── FILMS POPULAIRES ──────────────────────────────────────────────────────
    function popularMovies(){
        $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
        // Endpoint TMDB : retourne les 20 films les plus populaires du moment,
        // triés par score de popularité décroissant. language=fr-FR : titres et
        // synopsis traduits en français si disponibles.
        $url = "https://api.themoviedb.org/3/movie/popular?api_key=$key&language=fr-FR";
        $response = getProxy($url);             // requête HTTP → chaîne JSON brute
        $result   = json_decode($response, true); // décode le JSON en tableau PHP associatif
        return $result['results'];              // on ne retourne que le tableau des films (clé 'results')
    }

    // ─── FILMS MIEUX NOTÉS ────────────────────────────────────────────────────
    function topRated(){
        $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
        // Endpoint différent : /top_rated → classement par note moyenne
        $url = "https://api.themoviedb.org/3/movie/top_rated?api_key=$key&language=fr-FR";
        $response = getProxy($url);
        $result   = json_decode($response, true);
        return $result['results'];
    }

    // ─── FILMS PAR GENRE ──────────────────────────────────────────────────────
    function filmParGenre($id){
        $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
        // L'endpoint /discover/movie permet de filtrer les films selon de nombreux
        // critères. Ici on filtre par genre grâce au paramètre with_genres=$id.
        // L'ID de genre est un entier défini par TMDB (ex: 28=Action, 878=Sci-Fi).
        $url = "https://api.themoviedb.org/3/discover/movie?api_key=$key&language=fr-FR&with_genres=$id";
        $response = getProxy($url);
        $result   = json_decode($response, true);
        return $result['results'];
    }

    // ─── DÉTAILS D'UN FILM ────────────────────────────────────────────────────
    function infoFilm($id){
        $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
        // Contrairement aux listes, cet endpoint retourne UN seul film complet :
        // synopsis, genres (tableau), durée, date de sortie, langue…
        // On retourne $result directement (pas $result['results']) car ce n'est
        // pas une liste mais un objet unique.
        $url = "https://api.themoviedb.org/3/movie/$id?api_key=$key&language=fr-FR";
        $response = getProxy($url);
        $result   = json_decode($response, true);
        return $result; // tableau associatif représentant UN film
    }

    // ─── ACTEURS D'UN FILM ────────────────────────────────────────────────────
    function acteurFilm($id){
        $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
        // /credits retourne le casting complet (cast) et l'équipe technique (crew).
        // On ne garde que les 4 premiers acteurs du casting avec array_slice(),
        // pour afficher une fiche compacte sur la page d'un film.
        $url = "https://api.themoviedb.org/3/movie/$id/credits?api_key=$key&language=fr-FR";
        $response = getProxy($url);
        $result   = json_decode($response, true);
        return array_slice($result['cast'], 0, 4); // 4 premiers acteurs uniquement
    }

    // ─── DÉTAILS D'UN ACTEUR ──────────────────────────────────────────────────
    function detailActeur($id){
        $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
        // /person/$id retourne les informations biographiques d'une personne :
        // nom, photo, date et lieu de naissance, biographie, département principal.
        // ATTENTION : on retourne $result (l'objet entier), PAS $result['cast']
        // qui n'existe pas sur cet endpoint 
        $url = "https://api.themoviedb.org/3/person/$id?api_key=$key&language=fr-FR";
        $response = getProxy($url);
        $result   = json_decode($response, true);
        return $result;
    }

    // ─── FILMS PRINCIPAUX D'UN ACTEUR ─────────────────────────────────────────
    function mainFilmAc($id){
        $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
        // /combined_credits retourne à la fois les films (movie) et les séries (tv)
        // dans lesquels la personne a joué ou travaillé, sous la clé 'cast'.
        // On limite à 8 résultats avec array_slice() pour la fiche acteur.
        $url = "https://api.themoviedb.org/3/person/$id/combined_credits?api_key=$key&language=fr-FR";
        $response = getProxy($url);
        $result   = json_decode($response, true);
        return array_slice($result['cast'], 0, 8); // 8 premiers crédits
    }

    // ─── BANDE-ANNONCE D'UN FILM ──────────────────────────────────────────────
    function trailer($id){
        $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
        // /videos retourne la liste des vidéos associées au film (teasers, trailers,
        // clips, making-of, etc.), principalement hébergées sur YouTube.
        $url = "https://api.themoviedb.org/3/movie/$id/videos?api_key=$key&language=fr-FR";
        $response = getProxy($url);
        $result   = json_decode($response, true);

        // On parcourt les vidéos pour trouver la première qui soit :
        //   - de type "Trailer" (pas un teaser, pas un clip)
        //   - hébergée sur YouTube (on a besoin de la clé YouTube pour l'embed)
        if (!empty($result['results'])) {
            foreach ($result['results'] as $video) {
                if ($video['type'] == "Trailer" && $video['site'] == "YouTube") {
                    return $video['key']; // retourne l'identifiant YouTube (ex: "dQw4w9WgXcQ")
                }
            }
        }
        return null; // aucun trailer trouvé → la section bande-annonce ne s'affichera pas
    }

    // ─── RECHERCHE DE FILMS ───────────────────────────────────────────────────
    function rechercheFilm($query){
        $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
        // urlencode() est indispensable : il transforme les espaces en %20 et les
        // caractères spéciaux en séquences %XX pour que l'URL reste valide.
        // Ex: "Star Wars" → "Star%20Wars"
        $q   = urlencode($query);
        $url = "https://api.themoviedb.org/3/search/movie?api_key=$key&language=fr-FR&query=$q";
        $response = getProxy($url);
        $result   = json_decode($response, true);
        return $result['results'];
    }

    // ─── RECHERCHE D'ACTEURS ──────────────────────────────────────────────────
    function rechercheActeur($query){
        $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
        // Même logique que rechercheFilm() mais sur l'endpoint /search/person,
        // qui recherche dans les noms des personnes (acteurs, réalisateurs, etc.).
        $q   = urlencode($query);
        $url = "https://api.themoviedb.org/3/search/person?api_key=$key&language=fr-FR&query=$q";
        $response = getProxy($url);
        $result   = json_decode($response, true);
        return $result['results'];
    }
?>