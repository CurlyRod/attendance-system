<?php    
declare(strict_types=1); 
//https://www.php.net/manual/en/function.spl-autoload-register.php
spl_autoload_register(function ($class) {
    $baseDirs = [
        dirname(__DIR__) . "/Controller/",
        dirname(__DIR__)  . "/Api/",
    ];
   
    foreach ($baseDirs as $baseDir) { 
        $file = $baseDir . str_replace('\\', '/', $class) . '.php';
       // echo  json_encode(["path" => $file]); to check if correct the path
        if (file_exists($file)) {
            require $file;
            return;  
        }   
 
    }
});

set_error_handler('ErrorHandler::handleError');
set_exception_handler('ErrorHandler::handleException');

header("Content-type: application/json; charset=UTF-8");

$parts  = explode("/", $_SERVER["REQUEST_URI"]);    

    if ($parts[4] != 'student') {
        http_response_code(404); 
        exit;
    }   
    $id = $parts[5] ?? NULL;  


$database = new Database; 
$database->getConnection(); 
$studentApi = new StudentAPI($database); 
$controller = new StudentController($studentApi);  
$controller->processRequestMethod($_SERVER["REQUEST_METHOD"], $id);
    
    
?>