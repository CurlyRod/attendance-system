<?php    
    declare(strict_types=1); 
    //https://www.php.net/manual/en/function.spl-autoload-register.php
    spl_autoload_register(function ($class) {
        $baseDirs = [
            dirname(__DIR__) . "/controller/",
            dirname(__DIR__)  . "/api/",
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


    $database = new Database; 
    $database->GetConnection();  
    $studentApi = new StudentAPI($database); 
    $monitoringApi = new MonitoringAPI($database); 
   

  
    $parts  = explode("/", $_SERVER["REQUEST_URI"]); 
    if( $parts[3] != 'monitoring')
    {
        http_response_code(404); 
        exit;
    } 
    $id = $parts[5] ??  NULL;

    if( !empty($parts[4]) ) {

    $monitorController = new MonitoringController( $studentApi , $monitoringApi );
    $monitorController->processRequestMethod($_SERVER["REQUEST_METHOD"], $id);  

    }


   

    
?>