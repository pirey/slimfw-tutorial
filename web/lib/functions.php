<?php

function api_call(
    $url,
    $method = 'get',
    $postfields = array()
) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    switch (strtolower($method)) {
        case 'get':
            curl_setopt($ch, CURLOPT_HTTPGET, 1);
            break;
        case 'post':
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
            break;
        case 'put':
            curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
            break;
        case 'delete':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            break;
    }
    $response    = curl_exec($ch);
    curl_close($ch);

		return $response;
}

