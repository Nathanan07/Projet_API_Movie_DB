<?php
/*
 * get-proxy.php
 * Ce fichier contient la fonction getProxy() qui sert d'intermédiaire
 * pour effectuer des requêtes HTTP vers l'API TMDB.
 *
 * Il existe deux versions :
 *   - La version commentée (avec proxy réseau) était utilisée au lycée,
 *     où les connexions HTTPS sortantes passent obligatoirement par un
 *     serveur proxy (172.16.0.54:8080). Sans ça, file_get_contents()
 *     échouerait silencieusement sur les URL https://.
 *   - La version active utilise directement file_get_contents(), ce qui
 *     fonctionne chez soi ou sur un hébergement classique.
 *
 * Avoir cette abstraction dans un fichier séparé permet de n'avoir qu'un
 * seul endroit à modifier si l'on change d'environnement.
 */

/* Version lycée (proxy obligatoire) — laissée en commentaire pour référence :
function getProxy($url){
    $options = [
        'http' => [
            'proxy'           => 'tcp://172.16.0.54:8080', // adresse du proxy réseau du lycée
            'request_fulluri' => true,                      // envoie l'URL complète dans la requête
        ],
    ];
    $context  = stream_context_create($options); // crée un "contexte" PHP contenant les options réseau
    $response = file_get_contents($url, false, $context); // effectue la requête HTTP en passant par le proxy

    if ($response === false) {
        echo "Failed to get data from $url"; // en cas d'erreur réseau, affiche un message
    } else {
        return $response; // retourne le corps de la réponse (chaîne JSON brute)
    }
}
*/

// Version simple (utilisation à domicile ou sur hébergement)
// file_get_contents() envoie une requête GET à l'URL et retourne le corps
// de la réponse sous forme de chaîne de caractères (ici du JSON).
function getProxy($url){
    return file_get_contents($url);
}
?>