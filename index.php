<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['url'])) {
    $url = $_POST['url'];
    
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://instagram-downloader-download-instagram-videos-stories1.p.rapidapi.com/get-info-rapidapi?url=" . urlencode($url),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: instagram-downloader-download-instagram-videos-stories1.p.rapidapi.com",
            "x-rapidapi-key: cd2a6f4a2cmshb5e9d5458f5c208p1f07b4jsn01e0ecb0ad9e"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo json_encode(["error" => $err]);
    } else {
        // Assuming the response is a JSON, you can decode and return the necessary info
        echo $response;  // Return the whole response or process it before sending.
    }
}
?>
