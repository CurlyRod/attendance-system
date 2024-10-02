<?php   
class Student {

    private PDO $conn; 
    
    public function __construct(Database $database)
    {
        $this->conn = $database->GetConnection();
    }  


   public function GetAllStudent() : array {
        $query = "SELECT * FROM student_information" ;
        $stmt = $this->conn->query($query);  

        $data = []; 
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
            //if have "bool type need to cast to return in bool. 
            // $rowp["name_column_bool"] = (bool) $rowp["name_column_bool"];

            $data[] = $row;
        }
        return $data;
    } 


}

?>