<?php

function generateMeme(){
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://meme-api.com/gimme",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
        return $response;
}

if (isset($_GET["action"])){
    $valor = generateMeme();
    
} else {
    $valor = "Ha ocurrido un error";
}
exit($valor);

?>