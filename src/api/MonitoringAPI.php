<?php   
class MonitoringAPI{
    private PDO $conn; 
    
    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }   

    
    public function getValidateAttendance(string $student_number) : array | false {
        
        $query = "SELECT student_number, firstname, lastname, section FROM students WHERE student_number = :student_number";  
        $stmt = $this->conn->prepare($query);  
        $stmt->bindValue(":student_number", $student_number, PDO::PARAM_STR);  
        $stmt->execute(); 

        $data = [];
        if($stmt->rowCount() > 0){           
            $data = $stmt->fetch(PDO:: FETCH_ASSOC);  
            return $data;
        }else{
            $data = [ "status" => false, "message" => "Student not exist." ];
            return $data;
        }
    }
    
   
}