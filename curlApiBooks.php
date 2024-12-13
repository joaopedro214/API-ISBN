<?php
function buscarLivroPorISBN($isbn) { 
    $url = "http://openlibrary.org/api/books?bibkeys=ISBN:" . $isbn . "&format=json&jscmd=data"; 
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) { 
        echo 'Erro:' . curl_error($ch);
    }

    curl_close($ch);

    $dadosLivro = json_decode($response, true);
    
    return $dadosLivro; }
?>