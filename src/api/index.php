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
$studentInformation =  new Student($database);
  


    $parts  = explode("/", $_SERVER["REQUEST_URI"]); 

    $id = $parts[4] ?? NULL;  

    if ($parts[3] == 'student') {
      
        $studentController = new StudentController($studentApi);  
        $studentController->processRequestMethod($_SERVER["REQUEST_METHOD"], $id);  
    }   
    if ($parts[3] == 'monitoring') { 
        $monitoringController = new MonitoringController($monitoringApi, $studentApi);
        $monitoringController->processRequestMethod($_SERVER["REQUEST_METHOD"], $id);  
    } 

    if( $parts[3] === 'test')
    {
       $studentsController = new StudentsController($studentInformation);
       $studentsController->processRequestMethod($_SERVER["REQUEST_METHOD"], $id);  

    }

   

    
?>