<?php   
    $host = $_SERVER["HTTP_HOST"];
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://'; 
    $part = explode("/", $_SERVER["REQUEST_URI"]); 
    $base = $protocol . $host . '/' . $part[1];
?>


