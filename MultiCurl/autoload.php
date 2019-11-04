<?php
require 'MultiCurl.php';

/*
* Example 1
*
    require 'autoload.php';
    use CepzDecoded\PhpMultiCurl\MultiCurl;
    $mc = MultiCurl::getInstance();


    $ch = curl_init('http://example.com');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
      
    
    // Add your cURL calls and begin non-blocking execution.
    $call = $mc->addCurl($ch);
      
    // Access response(s) from your cURL calls.
    $code = $call->code;
    $response = $call->response;
    $headers = $call->headers;
    $ascii =  $mc->getSequence()->renderAscii();
    
    echo $code;
    echo json_encode($call->headers);;
    echo $response;
    echo $ascii;
*/

/*
* Example 2
*
    require 'autoload.php';
    use CepzDecoded\PhpMultiCurl\MultiCurl;
    $mc = MultiCurl::getInstance();
    
    // Set up your cURL handle(s).
    $ch = curl_init('http://example.com');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $ch2 = curl_init('http://example.com');
    curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);

    // Add your cURL calls and begin non-blocking execution.
    $call = $mc->addCurl($ch);
    $call2 = $mc->addCurl($ch2);

    // Access response(s) from your cURL calls.
    $call->code;
    $call2->code;
    echo $mc->getSequence()->renderAscii();
*/

/*
* Example 3
*

    require 'autoload.php';
    use CepzDecoded\PhpMultiCurl\MultiCurl;

    $mc = MultiCurl::getInstance();


    $count = 5;
    $ch = array();

    // Set up your cURL handle(s).
    for ($i = 0; $i < $count; $i++) {
        $ch[$i] = curl_init('http://example.com');
        curl_setopt($ch[$i], CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, 1);
    
        // Add your cURL calls and begin non-blocking execution.
        $call[$i] = $mc->addCurl($ch[$i]);
    
        // Access response(s) from your cURL calls.
        $call[$i]->code;
        echo $mc->getSequence()->renderAscii();
    }
*/