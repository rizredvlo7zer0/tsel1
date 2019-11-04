<?php
//date_default_timezone_set('Asia/Jakarta');

//session_start(); #list: key, msisdn, otp, secret_token

require_once('config.php');
require('cip.php');
//require_once('data.php');

require 'MultiCurl/autoload.php';
use CepzDecoded\PhpMultiCurl\MultiCurl;

/*
 *
 * MYTelkomsel DarkVersion classes
 * @author CepzDecoded
 * @recoded by Insider
 * @copyright 2018 {author}
 * @description Made it simple for newboy, even though the code is complicated like your love with him.
 * @version @BUILD@
 * 
*/

class MyTsel{
    
    //4p6TEhBC3zsljISp1sqKbj80ZMEWoY44 //APK
    //Xlj9pkfK6yYumf6G8KE2S5TDWgTtczb0 //WEB
    const clientid = '9yUwRUZirC0DXZyjMeQF4zCr6KO2R0Ub';
    
    const transactionid = 'A901190719192442969383440'; #old one: A301180820190025065878810 (random from apk android)
    
    private $id_token = '';
    
    
    public function __construct(){
        
    }
    
    public function get_otp($Msisdn) {
        
        // $ch0 = curl_init();
        // curl_setopt_array($ch0, array(
        //     CURLOPT_URL => "https://tdwidm.telkomsel.com/passwordless/start",
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_HTTPHEADER => array(
        //         'Accept: application/json', 
        //         'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
        //         'Accept-Encoding: gzip, deflate, br',
        //         'X-NewRelic-ID: VQ8GVFVVChAEUlJRBAcOUQ==',
        //         'content-length: 87',
        //         'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'
        //     ),
        //     CURLOPT_RETURNTRANSFER => 1
        // ));
        // curl_exec($ch0);
        // curl_close($ch0);
        
        
        $bahan = 'client_id=9yUwRUZirC0DXZyjMeQF4zCr6KO2R0Ub&connection=sms&phone_number=%2B';
        $body = "$bahan$Msisdn";
        $header = array(
            'Accept: application/json', 
            'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
            'Accept-Encoding: gzip, deflate, br', 'X-NewRelic-ID: VQ8GVFVVChAEUlJRBAcOUQ==',
            'content-length: 87',
            'User-Agent: Mozilla/5.0 (Linux; U; Android 4.4; xx-xx; SM-J110F Build/KTU84P) AppleWebKit/537.16 (KHTML, like Gecko) Version/4.0 Mobile Safari/537.16 Chrome/33.0.0.0'
        );

        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, "https://tdwidm.telkomsel.com/passwordless/start");
        curl_setopt($ch1, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch1, CURLOPT_COOKIEFILE, 'cookie.txt');
        curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch1, CURLOPT_POSTFIELDS, $body);
        $out = curl_exec($ch1);

        $ip = file_get_contents('https://api.ipify.org');
        $ch2 = curl_init();
        $header1 = array(
            'accept : application/json',
            "x-forwarded-for: $ip",
            'authorization: Bearer [object Object]',
            'transactionid: A901190719192442969383440',
            'channelid: VMP',
            'Connection: keep-alive',
            'Accept-Encoding: gzip',
            'User-Agent: Mozilla/5.0 (Linux; U; Android 4.4; xx-xx; SM-J110F Build/KTU84P) AppleWebKit/537.16 (KHTML, like Gecko) Version/4.0 Mobile Safari/537.16 Chrome/33.0.0.0',
            'X-NewRelic-ID: VQ8GVFVVChAEUlJRBAcOUQ==');
            
        curl_setopt($ch2, CURLOPT_URL, 'https://vmp.telkomsel.com/api/sys/forwardIp');
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $header1);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch2, CURLOPT_COOKIEFILE, 'cookie.txt');
        $hasil = curl_exec($ch2);
        if(strlen($hasil) > 0)
            return "SUKSES";
        else
            return NULL;
    }
    
    public function login($Msisdn, $otp, $tipe) {
 
        $l = 'client_id='.self::clientid.'&connection=sms&grant_type=password&username=%2B';
        $l1 = "$Msisdn&password=$otp";
        $l2 = '&scope=openid%20offline_access&device=string';
        $login3 = "$l$l1$l2";

        $ch = curl_init();
        $header = array(
            'Accept: application/json', 
            'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
            'Accept-Encoding: gzip, deflate, br', 'X-NewRelic-ID: VQ8GVFVVChAEUlJRBAcOUQ==',
            'content-length: 161',
            'User-Agent: Mozilla/5.0 (Linux; U; Android 4.4; xx-xx; SM-J110F Build/KTU84P) AppleWebKit/537.16 (KHTML, like Gecko) Version/4.0 Mobile Safari/537.16 Chrome/33.0.0.0'
        );
        curl_setopt($ch, CURLOPT_URL, "https://tdwidm.telkomsel.com/oauth/ro");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $login3);
        $hasil = curl_exec($ch);
            // $json_a = json_decode($hasil, true);
            // if (strlen($json_a['id_token']) > 0) {
            //     $token = $json_a['id_token'];
            //     return $token;
            // } else {
            //     echo "Jangan kelamaan masukin otp anjeng juga otp jangan salah";
            // }
        $json = json_decode( $hasil );
        #echo $out."<br><br>";

        switch(true){
            
            #otp kosong
            case($out == '{"error":"invalid_request","error_description":"missing password parameter"}'):{
                return("Error: OTP Kosong");
            }
            break;
            
            #otp salah
            case($out == '{"error":"invalid_user_password","error_description":"Wrong phone number or verification code."}'):{
                return("Error: OTP salah");
            }
            break;
            
            #sukses
            case(isset($json->id_token)):{
                $this->id_token = $json->{'id_token'};
                #echo $json->{'id_token'}."<br><br>";
                #echo $this->id_token."<br><br>";
                
                
                ############################################################ 1
                $ch2 = curl_init();
                curl_setopt_array($ch2, array(
                    CURLOPT_URL => "https://tdwidm.telkomsel.com/tokeninfo",
                    CURLOPT_POST => TRUE,
                    CURLOPT_POSTFIELDS => "id_token=".$this->id_token."",
                    CURLOPT_HTTPHEADER => array(
                        'accept: application/json',
                        'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
                        'Content-Length: 292',
                        'Connection: Keep-Alive',
                        'Accept-Encoding: gzip',
                        'User-Agent: Mozilla/5.0 (Linux; U; Android 4.4; xx-xx; SM-J110F Build/KTU84P) AppleWebKit/537.16 (KHTML, like Gecko) Version/4.0 Mobile Safari/537.16 Chrome/33.0.0.0',
                        'X-NewRelic-ID: VQ8GVFVVChAEUlJRBAcOUQ=='
                    ),
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_COOKIEJAR, 'cookie.txt',
                    CURLOPT_COOKIEFILE, 'cookie.txt'
                ));
                $out2 = curl_exec($ch2);
                $json2 = json_decode( $out2 );
                curl_close($ch2);
                #echo $out2."<br><br>";
                
                
                ############################################################ 2
                $payload3 = '{"msisdn":"'.$Msisdn.'"}';
                
                #echo $payload3."<br><br>";
                /*
                $ch3 = curl_init();
                curl_setopt_array($ch3, array(
                    CURLOPT_URL => "https://$tipe/api/user/",
                    CURLOPT_HEADER => 1,
                    CURLOPT_CUSTOMREQUEST => "PATCH",
                    CURLOPT_POSTFIELDS => $payload3,
                    CURLOPT_HTTPHEADER => array(
                        "Host: tdw.telkomsel.com",
                        "Content-Length: ".strlen($payload3)."",
                        "Authorization: Bearer ".$this->id_token."",
                        "Origin: file://",
                        "Content-Type: application/json",
                        "Accept: application/json",
                        "CHANNELID: UX",
                        "MYTELKOMSEL-MOBILE-APP-VERSION: 3.14.1",
                        "X-REQUESTED-WITH: com.telkomsel.mytelkomsel",
                        "Accept-Encoding: gzip, deflate",
                        "Accept-Language: id-ID,en-US;q=0.8"
                    ),
                    CURLOPT_ENCODING => "gzip, deflate",
                    CURLOPT_RETURNTRANSFER => 1
                ));
                $out3 = curl_exec($ch3);
                
                $header_size = curl_getinfo($ch3, CURLINFO_HEADER_SIZE);
                $Header = substr($out3, 0, $header_size);
                
                curl_close($ch3);
                
                if ($out3 == '{"status":false}')
                {
                    
                    $cut = substr($Header, 0, strpos($Header, "vary:"));
	                $cut2 = str_replace("authorization: Bearer ", "", $cut);
	                $final = str_replace("HTTP/1.1 200 OK", "", $cut2);
	                $cut_space = trim(preg_replace('/\s+/', ' ', $final));
	                
	                return $cut_space;
                    
                } else {
                    return $out3;
                }
                */
                
                
                
                $mc = MultiCurl::getInstance();
    
                // Set up your cURL handle(s).
                $ch = curl_init("https://$tipe/api/user/");
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload3);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, TRUE);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        "Content-Length: ".strlen($payload3)."",
                        "Authorization: Bearer ".$this->id_token."",
                        "TRANSACTIONID: ".self::transactionid."",
                        'channelid: VMP',
                        'Content-Type: application/json;charset=utf-8',
                        'Connection: Keep-Alive',
                        'Accept-Encoding: gzip',
                        'User-Agent: Mozilla/5.0 (Linux; U; Android 4.4; xx-xx; SM-J110F Build/KTU84P) AppleWebKit/537.16 (KHTML, like Gecko) Version/4.0 Mobile Safari/537.16 Chrome/33.0.0.0',
                        'X-NewRelic-ID: VQ8GVFVVChAEUlJRBAcOUQ=='
                    
                ));
                curl_setopt($ch, CURLOPT_ENCODING, "gzip, deflate");
                // Add your cURL calls and begin non-blocking execution.
                $call = $mc->addCurl($ch);
                $call->code;
                $response = $call->response;
                
                if ($call->code == 200) {
                    $array          = json_encode( $call->headers );
                    $json           = json_decode( $array );
                    $bearer         = $json->authorization;
                    $cut_bearer     = str_replace("Bearer", "", $bearer);
                    //$cut_allblank   = trim(preg_replace('/\s+/', ' ', $cut_bearer));
                    
                    return $cut_bearer;
                    
                } else {
                    
                    return "Gadapet Token"; //Error: Msisdn/OTP salah
                    
                }


            }
            break;
            
            default: "something wrong call Dokter as the developer to fix it."; die(); break;
        }
    
            
    }
    
    public function logout($Bearer, $tipe) {
        $payload4 = '{"refreshToken":"pt7paNO-zsALy9mpoWHAMOQl1uxzWyISrcxYVUzxFL5oh"}';
        $mc = MultiCurl::getInstance();
    
        // Set up your cURL handle(s).
        $ch = curl_init("https://$tipe/api/user/logout");
              curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
              curl_setopt($ch, CURLOPT_POSTFIELDS, $payload4);
              curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Length: ".strlen($payload4)."",
                "Authorization: Bearer ".$Bearer."",
                "TRANSACTIONID: ".self::transactionid."",
                'channelid: VMP',
                'Content-Type: application/json;charset=utf-8',
                'Connection: Keep-Alive',
                'Accept-Encoding: gzip',
                'User-Agent: Mozilla/5.0 (Linux; U; Android 4.4; xx-xx; SM-J110F Build/KTU84P) AppleWebKit/537.16 (KHTML, like Gecko) Version/4.0 Mobile Safari/537.16 Chrome/33.0.0.0',
                'X-NewRelic-ID: VQ8GVFVVChAEUlJRBAcOUQ=='
              ));
              curl_setopt($ch, CURLOPT_ENCODING, "gzip");

        // Add your cURL calls and begin non-blocking execution.
        $call = $mc->addCurl($ch);
        $call->code;
        $response = $call->response;
    }
    
    public function buy_pkg($Bearer, $pkgid, $transactionid, $tipe) {
        
        $mc = MultiCurl::getInstance();
    
        // Set up your cURL handle(s).
        $ch = curl_init("https://$tipe/api/packages/".$pkgid);
              curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
              curl_setopt($ch, CURLOPT_POSTFIELDS, '{"toBeSubscribedTo":false}');
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
              curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Length: 26',
		            'Connection: Keep-Alive',
                    "Authorization: Bearer ".$Bearer."",
                    "Content-Type: application/json;charset=utf-8",
                    "Accept: application/json",
                    "CHANNELID: VMP",
                    "TRANSACTIONID: ".$transactionid."",
                    'User-Agent: Mozilla/5.0 (Linux; U; Android 4.4; xx-xx; SM-J110F Build/KTU84P) AppleWebKit/537.16 (KHTML, like Gecko) Version/4.0 Mobile Safari/537.16 Chrome/33.0.0.0',
                    'X-NewRelic-ID: VQ8GVFVVChAEUlJRBAcOUQ=='
              ));
              curl_setopt($ch, CURLOPT_ENCODING, "gzip");

        // Add your cURL calls and begin non-blocking execution.
        $call = $mc->addCurl($ch);
        $call->code;
        $response = $call->response;
        $json = json_decode( $response );
        
        //return("PKGID: ".$pkgid."<br>");
        if (strlen($json->message) > 0)
		{
			$meseg = $json->message;
			if ($meseg == "BIZ-UXP-0001") { echo "\n$pkgid Paket tidak tersedia saat ini. Silakan coba beberapa saat lagi. (PRE-0001)"; ; }
			else if ($meseg == "BIZ-UXP-0002") { echo "\n$pkgid Maaf,anda tidak memiliki cukup pulsa untuk membeli paket ini. Silakan isi ulang pulsa untuk melanjutkan. (PRE-0002)"; ; }
			else if ($meseg == "BIZ-UXP-0003") { echo "\n$pkgid Kami tidak dapat menemukan paket yang cocok berdasarkan lokasi Anda saat ini. (PRE-0003)"; ; }
			else if ($meseg == "BIZ-UXP-0006") { echo "\n$pkgid Paket tidak tersedia untuk hari ini. Silakan coba kembali. (PRE-0006)"; ;}
			else if ($meseg == "BIZ-UXP-0007") { echo "\n$pkgid Paket tidak tersedia saat ini. Silakan coba kembali. (PRE-0007)"; ;}
			else if ($meseg == "BIZ-UXP-0008") { echo "\n$pkgid Maaf, kuota paket ini sudah habis untuk hari ini. (PRE-0008)";  ; }
			else if ($meseg == "BIZ-UXP-0009") { echo "\n$pkgid Anda telah melebihi jumlah kuota Anda untuk dapat membeli paket ini. Silakan pilih paket lainnya. (PRE-0009)"; ;}
			else if ($meseg == "BIZ-UXP-0010") { echo "\n$pkgid Nomor ponsel Anda tidak cocok dengan skema tarif untuk paket ini. Silakan pilih paket lainnya. (PRE-0010)"; ;}
			else if ($meseg == "BIZ-UXP-0011") { echo "\n$pkgid Nomor ponsel Anda tidak memenuhi syarat untuk paket ini. Silakan pilih paket lainnya. (PRE-0011)"; ;}
			else if ($meseg == "BIZ-UXP-0013") { echo "\n$pkgid Maaf,saat ini kami tidak dapat menemukan rincian info akun Anda. Silakan coba beberapa saat lagi. (PRE-0013)"; ;}
			else if ($meseg == "BIZ-UXP-0014") { echo "\n$pkgid Maaf! Kami tidak dapat menemukan rincian dari akun Anda. Silakan coba beberapa saat lagi. (PRE-0014)"; ;}
			else if ($meseg == "BIZ-UXP-0015") { echo "\n$pkgid Maaf, paket ini tidak tersedia untuk nomor ponsel Anda. Silakan pilih paket lainnya. (PRE-0015)"; ;}
			else if ($meseg == "BIZ-UXP-0016") { echo "\n$pkgid Maaf, nomor ponsel Anda dalam masa tenggang. Silakan isi ulang pulsa untuk melanjutkan. (PRE-0016)"; ;}
			else if ($meseg == "BIZ-UXP-0017") { echo "\n$pkgid Maaf, kuota untuk paket ini sudah habis. Silakan pilih paket lainnya. (PRE-0017)"; ;}
			else if ($meseg == "BIZ-UXP-1101") { echo "\n$pkgid Transaksi Anda sebelumnya masih dalam proses. Silakan tunggu beberapa saat lagi.(PRE-1101)"; ;}
			else if ($meseg == "BIZ-UXP-1102") { echo "\n$pkgid Maaf,saat ini paket tidak.....HILANG)"; ;}
			else { echo "\nID Paket tidak ditemukan"; ;}
		}
		else if ($json->notification)
		{ 
			$ddd = $json->notification;
			echo "\n$pkgid $ddd";
			$prin = fopen('hasil.txt', "w");
			fputs ($prin, "$pkgid <== Sukses");
		}
		else
		{
			echo "\n$json Javascrip eror";
		}
        
        switch(true){
            
            case(isset($json->transactionstatus) and $json->transactionstatus == "Success" and isset($json->transactiondesc) and $json->transactiondesc == "TDW-OK00-01"):{
                return("SUKSES");
            } 
            break;
            
            case(isset($json->statusCode) and $json->statusCode == 404 and isset($json->error) and $json->error == "Not Found"):{
                return("PKGID or TRANSACTIONID Can't Empty.");
            }
            break;
            
            
            default: return $response; break;
            
        }
        
        
        
        
    }
    
}
