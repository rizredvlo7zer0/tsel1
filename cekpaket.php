<?php
$cut_bearer = "/rMMNXB3RGwmiZ0c4EQdOmx/UTmibigQudNBg/WJ/QNoWJBGqn3+2oniW0h/ZDiUArB1P37Bdr7F1SolPgKtKIiTQNFlelkx5CvCt4W5eB546/f9Ub1nV0P1XYHYxxJo/fAXO6ErXPP4lR3mHOV33E2EYbBavz6vEclzzAIrYVJIQaB9N3CqOH7Z8W/nrYoJdY1Eps34Zx81BaBTD93rtbyztYhmMno2UgrHIXvnRZWRNSii7uguzqrbpHo2HK5dv0P1rm1SprYuHzUEF7Tg5YKdpVG8gNXOnNOnxanX48GfMJEd31RYOzv/8tuopguvo0b7WxkSze+Z3ciwkyHVOlE1AbmPuZ8vEIIgozm4/wC/laC8gSdt0R8fq4jnN4cu2yxzQVZAqijhhfn4paIVDJ6MtEB+8lPU3XO7SZ9KMFjDYAQwBNzUpc81vHyTmummSyx40xoxfhAqohJWq1ZJ8q8wktRbjJ+XfdC8icIyzvTbWP9HgwZoY12tmgWFxt9VJCNMjWDxlcKEn8gLBjE0cwmVgUrGG0qtqW/zn+pmltud87Aldxr6ZmnR7HuDNpL7jXTbqcHe7D6hs/IcUpjmTAqSTtvphSdcPIhQKMUL4cWmPQVuJUibhNt/ygVQHsEHYh/uZPfDTMVgoB9A1AJjY9QvviwvPTLMXZHGoNPdW2cRYwEZWWIkR7OlJCb64lP7xH43avR/2r/wfvMWjo2Ee77/x7flgRgfuKFbFlwdjbzu6EAkOAELno6UMvlXJrtgAT5beFeNbMXhDFUjKD/Xtjn8j2EKHgs7cr8LRb+rd8+Eum/mpDR9MWMw2Pvhd+W/BoPL4IKj787G1gb4vU/zY5VEAj6wbPxSLPnEZVQQ15dwBc/lvwpC7I3+pmQsWKNPRBYsMw3t8wWWFWDRVbZE3ME3z8N9/a4JYbmJ1Gq+FkXcLzWIkp1/SCu0hJVDd9OxoKibzJWmGJayFGzt2njxfjSfV/9u0JMNqIdYnoqJFTjVwjzwBl8YxupcC4tWBGXuJMgSBkehno1kqKjKTcjfhg2jAdIpD0V1mRsEP+WiO3IQnV2Tt85gP6YRVIN7/gqmcxWKt2wrJAtxySVXzVy4t7id3my/eXKKANKjP/g+UAoHQ0F1vnRT/QxsaRO1/z+c";
for($i = 10000; $i < 15000; ++$i) {
    // $ch1 = curl_init();
    // $header2 = array(
    //     'Host: my.telkomsel.com',
    //     'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:68.0) Gecko/20100101 Firefox/68.0',
    //     'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
    //     'Accept-Language: en-US,en;q=0.5',
    //     'Accept-Encoding: gzip, deflate, br',
    //     'Connection: keep-alive',
    //     'Cookie: _ga=GA1.2.473214796.1563697812; ins-mig-done=1; insdrSV=71; _fbp=fb.1.1563697814628.2114003511; ins-price-plan=; _gid=GA1.2.1063007221.1565266929; scs=%7B%22t%22%3A1%7D; current-currency=IDR; ins-product-id=ML4_BP_152702; TS015db38c=012914cdb5564da78156000b499fd39132f5a713c93b1b5cc61369e623735b6e699d76ceaa51f0c5149631e4f3a2a6f9f80c1b70df; ins-gaSSId=b0f5a602-9e27-11fd-5ef2-8728c5f976da_1565521667; total-cart-amount=0',
    //     'Upgrade-Insecure-Requests: 1',
    //     'If-Modified-Since: Thu, 01 Aug 2019 15:17:46 GMT',
    //     'If-None-Match: W/"5d43029a-144c"',
    //     'Cache-Control: max-age=0'
    // );	
    // curl_setopt($ch1, CURLOPT_URL, "https://my.telkomsel.com/app/package-details/ML4_BP_$i");
    // curl_setopt($ch1, CURLOPT_HTTPHEADER, $header2);
    // curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "GET");
    // curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($ch1, CURLOPT_COOKIEJAR, 'cookie.txt');
    // curl_setopt($ch1, CURLOPT_COOKIEFILE, 'cookie.txt');
    // $hasil1 = curl_exec($ch1);

    $ch = curl_init();
    $header1 = array(
        'Host: tdw.telkomsel.com',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:68.0) Gecko/20100101 Firefox/68.0',
        'Accept: application/json',
        'Accept-Language: en-US,en;q=0.5',
        'Accept-Encoding: gzip, deflate, br',
        "Referer: https://my.telkomsel.com/app/package-details/ML4_BP_$i",
        'Content-Type: application/json',
        'TRANSACTIONID: A302190811184118835383440',
        'MYTELKOMSEL-WEB-APP-VERSION: 1.5.0',
        'CHANNELID: WEB',
        'Authorization: Bearer '.$cut_bearer.'',
        'Origin: https://my.telkomsel.com',
        'Connection: keep-alive'
    );	
    curl_setopt($ch, CURLOPT_URL, "https://tdw.telkomsel.com/api/paket-details/ML4_BP_$i");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    $hasil = curl_exec($ch);
    echo "$hasil";
    $json_a = json_decode($hasil, true);     
    $id = $json_a['id'];
    $nama = $json_a['name'];
    $businesid = $json_a['businessproductid'];
    $price = $json_a['price'];
    echo "ID : $id\nNama : $nama\nBisnis ID : $businesid\nHarga : $price";
}
?>



