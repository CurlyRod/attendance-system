<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>dashboard</p> 
    <a href="./logout.php"> logout</a> 
    <?php    
    session_start();
            var_dump($_SESSION);
    ?>
</body>
</html>