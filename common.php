<?php

$ini = parse_ini_file("api.ini",true);
$base_url = $ini["base_url"];

function mydump($fname,$data){
    ob_start();
    var_dump($data);
    $out = ob_get_contents();
    ob_end_clean();
    file_put_contents($fname,date(DATE_RFC2822)." ".$out.PHP_EOL,FILE_APPEND);
}

function pushData($text){
    require_once('external/Pusher.php');
    $pusher_ini = parse_ini_file("api.ini",true)["pusher"];
    $pusher = new Pusher(
        $pusher_ini["key"],
        $pusher_ini["secret"],
        $pusher_ini["app_id"],
        ['encrypted'=>true]
    );
    $data['message'] = $text;
    $pusher->trigger('test_channel', 'my_event', $data);
}