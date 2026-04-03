<?php

require_once("get-proxy.php");// au lycée pour faire des requêtes https vous avons besoin d'indiquer le proxy


    //fonction qui retourne dans un tableau asociatif les 20 films les plus populaires 
    function popularMovies(){
        $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
        $url = "https://api.themoviedb.org/3/movie/popular?api_key=$key&language=fr-FR";
        $response = getProxy($url);
        //$response = file_get_contents("https://api.themoviedb.org/3/movie/popular?api_key=$key&language=fr-FR");
       
        $result = json_decode($response, true);
        return $result['results'];
      }
    
    function topRated(){
      $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
      $url = "https://api.themoviedb.org/3/movie/top_rated?api_key=$key&language=fr-FR";
      $response = getProxy($url);
      //$response = file_get_contents("https://api.themoviedb.org/3/movie/top_rated?api_key=$key&language=fr-FR");
 
      $result = json_decode($response, true);
      return $result['results'];
    }

    function filmParGenre($id){
      $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
      $url = "https://api.themoviedb.org/3/discover/movie?api_key=$key&language=fr-FR&with_genres=$id";
      $response = getProxy($url);
      //$response = file_get_contents("https://api.themoviedb.org/3/discover/movie?api_key=$key&language=fr-FR&with_genres=16");

      $result = json_decode($response, true);
      return $result['results'];
    }

    function infoFilm($id){
      $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
      $url = "https://api.themoviedb.org/3/movie/$id?api_key=$key&language=fr-FR";
      $response = getProxy($url);
      $result = json_decode($response, true);
      return $result;
    }

    function acteurFilm($id){
    /*acteurs dans un film : 939243 -> id du film*/
      $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
      $url = "https://api.themoviedb.org/3/movie/$id/credits?api_key=$key&language=fr-FR";
      $response = getProxy($url);
      //$response = file_get_contents("https://api.themoviedb.org/3/movie/939243/credits?api_key=$key");
      $result = json_decode($response, true);
      return array_slice($result['cast'], 0, 4);
    }

    function detailActeur($id){
    /*détails sur un acteur : id -> 206 Jim Carrey*/
      $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
      $url = "https://api.themoviedb.org/3/person/$id?api_key=$key&language=fr-FR";
      $response = getProxy($url);
      //$response = file_get_contents("https://api.themoviedb.org/3/person/206?api_key=$key&language=fr-FR");
      $result = json_decode($response, true);
      return $result['cast'];
    }

    function mainFilmAc($id){
    /*principaux films d'un acteur : id -> 206 Jim Carrey */
      $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
      $url = "https://api.themoviedb.org/3/person/$id/combined_credits?api_key=$key&language=fr-FR";
      $response = getProxy($url);
      //$response = file_get_contents("https://api.themoviedb.org/3/person/206/combined_credits?api_key=$key&language=fr-FR");
      $result = json_decode($response, true);
      return array_slice($result['cast'], 0, 8); // 8 films
    }

    function trailer($id){
      $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
      $url = "https://api.themoviedb.org/3/movie/$id/videos?api_key=$key&language=fr-FR";

      $response = getProxy($url);
      $result = json_decode($response, true);

      if (!empty($result['results'])) {
          foreach ($result['results'] as $video) {
              if ($video['type'] == "Trailer" && $video['site'] == "YouTube") {
                  return $video['key']; // ID YouTube
             }
         }
      }

      return null;
      }
    
?>

