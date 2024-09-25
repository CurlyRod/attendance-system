<?php
$parts  = explode("/", $_SERVER["REQUEST_URI"]);  
$baseurl = $parts[1]; 
echo $baseurl; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>client index</p> 
    <a href="./signup">register</a>
</body>
</html>