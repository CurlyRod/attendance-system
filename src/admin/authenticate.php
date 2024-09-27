<?php       
// header("Content-Type: application/json");

// // Read the JSON input
// $jsonData = file_get_contents('php://input');

// // Decode the JSON data into a PHP associative array
// $data = json_decode($jsonData, true);

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {   
    require_once("./controller/Database.php");
    $database = new Database();
    $mysqli = $database->getConnection(); 

  
    $checkIfExist = "SELECT * FROM admin WHERE email = :email";  
    $stmt = $mysqli->prepare($checkIfExist); 
    $stmt->bindParam(':email', $_POST["email"], PDO::PARAM_STR);
    $stmt->execute(); 

    // Fetch the result
    $userAccount = $stmt->fetch(PDO::FETCH_ASSOC);  

    if ($userAccount) {   
        if (password_verify($_POST["password"], $userAccount["password"])) {   
            session_start();  
            session_regenerate_id();
            $_SESSION["user_id"] = $userAccount["id"];    
            header("Location: ./dashboard");
            exit;
        } else {
            $is_invalid = true; 
        }
    } else {
        $is_invalid = true; 
    }

}
?>
