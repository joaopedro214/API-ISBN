<?php
function buscarLivroPorISBN($isbn10, $isbn13) { 
    if (!empty($isbn10)) {
        $isbn = $isbn10;
        $tipoISBN = "isbn-10";
    } elseif (!empty($isbn13)) {
        $isbn = $isbn13;
        $tipoISBN = "isbn-13";
    } else {
        return "ISBN não recebido.";
    }

    $url = "http://openlibrary.org/api/books?bibkeys=ISBN:" . $isbn . "&format=json";
    
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) { 
        echo 'Erro:' . curl_error($ch); 
    }
    
    curl_close($ch);

    $dadosLivro = json_decode($response, true);
    
    if (empty($dadosLivro)) { 
        return "Nenhum dado encontrado para " . $tipoISBN . ": " . $isbn; 
    }
    
    $image = $dadosLivro["ISBN:$isbn"]['thumbnail_url'];

    return $image;

}
?>