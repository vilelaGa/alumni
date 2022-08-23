<?php

namespace App\GeoLocalizacao;


class GeoLocalizacao
{
    public static function coleta_ip($ip_user)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://ip-api.com/php/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = @unserialize(curl_exec($curl));

        curl_close($curl);

        // print_r("<pre>");
        // print_r($response);
        // print_r("<pre>");

        // echo $response['country'] . "<br>";
        return $response['city'];
        // echo $response['isp'] . "<br>";
        // echo $response['regionName'] . "<br>";
        // echo $response['query'] . "<br>";
        // echo $response['lat'] . "<br>";
        // echo $response['lon'] . "<br>";
    }
}
