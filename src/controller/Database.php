<?php   

class Database {    

    private string $host ="localhost";
    private string $username ="root"; 
    private string $password ="";
    private string $dbname ="e-atms-db";
    protected $conn; 

    public function __construct() {

        //ref: https://www.php.net/manual/en/pdo.connections.php 
        //https://www.php.net/manual/en/book.pdo.php 
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8";
        $this->conn = new PDO($dsn, $this->username, $this->password, [
            PDO::ATTR_EMULATE_PREPARES => false, 
            PDO::ATTR_STRINGIFY_FETCHES => false
        ]);  

    }  

    public function GetConnection() : PDO { 
       return $this->conn;     
    }
} 
// $database =  new Database(); 
// $database->getConnection();
?>