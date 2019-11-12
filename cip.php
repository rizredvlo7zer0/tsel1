<?php
require_once('config.php');


function cip_enc($str)
{
    $password = 'tppgaming';
    $method = 'aes-256-cbc';
    $password = substr(hash('sha256', $password, true), 0, 32);
    $iv = chr(0x1) . chr(0x3) . chr(0x3) . chr(0x7) . chr(0x7) . chr(0x3) . chr(0x3) . chr(0x1) . chr(0x1) . chr(0x3) . chr(0x3) . chr(0x7) . chr(0x7) . chr(0x3) . chr(0x3) . chr(0x1);
    return base64_encode(openssl_encrypt($str, $method, $password, OPENSSL_RAW_DATA, $iv));
}

function cip_dec($str)
{
    $password = 'tppgaming';
    $method = 'aes-256-cbc';
    $password = substr(hash('sha256', $password, true), 0, 32);
    $iv = chr(0x1) . chr(0x3) . chr(0x3) . chr(0x7) . chr(0x7) . chr(0x3) . chr(0x3) . chr(0x1) . chr(0x1) . chr(0x3) . chr(0x3) . chr(0x7) . chr(0x7) . chr(0x3) . chr(0x3) . chr(0x1);
    return openssl_decrypt(base64_decode($str), $method, $password, OPENSSL_RAW_DATA, $iv);
}