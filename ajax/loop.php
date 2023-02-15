<?php

include_once("../config/global_config_includes.php");

$x = 0;

while ($x < 10) {
    echo $x;
    $y = random_int(1,3);

    $html = "";
    $html2 = "";
    $html3 = "";

    if($y == 1){
        $html = file_get_contents('https://siat.sat.gob.mx/app/qr/faces/pages/mobile/validadorqr.jsf?D1=10&D2=1&D3=18010244598_AALD710129KU2');
    }
    if($y == 2){
        $html2 = file_get_contents('https://siat.sat.gob.mx/app/qr/faces/pages/mobile/validadorqr.jsf?D1=10&D2=1&D3=15050546420_TEM000809TE2');
    }
    if($y == 3){
        $html3 = file_get_contents('https://siat.sat.gob.mx/app/qr/faces/pages/mobile/validadorqr.jsf?D1=10&D2=1&D3=22020506489_MUMO851203IA8');
    }

    $html = substr($html, strpos($html, 'Nombre:') + 64, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Nombre:')) - strpos($html, 'Nombre:') - 64);
    $html2 = substr($html2, strpos($html2, 'n Social:') + 66, strpos($html2, '</td></tr><tr data-ri=', strpos($html2, 'n Social:')) - strpos($html2, 'n Social:') - 66);
    $html3 = substr($html3, strpos($html3, 'Nombre:') + 64, strpos($html3, '</td></tr><tr data-ri=', strpos($html3, 'Nombre:')) - strpos($html3, 'Nombre:') - 64);

    echo $html; 
    // echo "<br>";
    echo $html2;
    // echo "<br>";
    echo $html3;
    // echo "<br>";

    // $c = curl_init('https://siat.sat.gob.mx/app/qr/faces/pages/mobile/validadorqr.jsf?D1=10&D2=1&D3=18010244598_AALD710129KU2');
    // curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    // //curl_setopt(... other options you want...)

    // $html = curl_exec($c);

    // if (curl_error($c)) {
    //     die(curl_error($c));
    // }

    // // Get the status code
    // $status = curl_getinfo($c, CURLINFO_HTTP_CODE);

    // curl_close($c);

    // $html = substr($html, strpos($html, 'Nombre:') + 64, strpos($html, '</td></tr><tr data-ri=', strpos($html, 'Nombre:')) - strpos($html, 'Nombre:') - 64);
    // echo $html;
    $x = ($x + 1);
}
