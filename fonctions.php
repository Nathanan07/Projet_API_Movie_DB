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

    function infoFilm($movieId){
      $key = "9e43f45f94705cc8e1d5a0400d19a7b7";
      $url = "https://api.themoviedb.org/3/movie/$movieId?api_key=$key&language=fr-FR";
      $response = getProxy($url);
      $result = json_decode($response, true);
      return $result;
    }

    
?>

