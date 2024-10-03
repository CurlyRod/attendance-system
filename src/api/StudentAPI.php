<?php   
class StudentAPI{
    private PDO $conn; 
    
    public function __construct(Database $database)
    {
        $this->conn = $database->GetConnection();
    }

    public function GetAllStudent() : array {
        $query = "SELECT rfidtag, student_number, firstname, middlename, lastname, section, email FROM student_information" ;
        $stmt = $this->conn->query($query);  

        $data = []; 
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
            //if have "bool type need to cast to return in bool. 
            // $rowp["name_column_bool"] = (bool) $rowp["name_column_bool"];

          $data[] = $row;
        }
        return $data;
    } 

    public function registerStudent(array $data) : string {
        $query  = "INSERT INTO students (student_number, firstname, lastname, section)
                   VALUES (:student_number, :firstname, :lastname, :section)"; 
        
        //use prepare statement  use prepare function not query --rod
        $stmt = $this->conn->prepare($query);

        // pattern -> (placeholder, targetrow, data type)
        $stmt->bindValue(":student_number", $data["student_number"], PDO::PARAM_STR); 
        $stmt->bindValue(":firstname", $data["firstname"], PDO::PARAM_STR); 
        $stmt->bindValue(":lastname", $data["lastname"], PDO::PARAM_STR); 
        $stmt->bindValue(":section", $data["section"], PDO::PARAM_STR);  

        $stmt->execute(); 
        return $data["student_number"]; // to get last inserted student then --do the return of image by student id
    }   

    public function updateStudent(array $currentdata,  array $newdata) : int {
        
        $query = "UPDATE students 
                  SET firstname = :firstname, lastname = :lastname, section = :section 
                  WHERE student_number = :student_number "; 

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":firstname",$newdata["firstname"] ?? $currentdata["firstname"], PDO::PARAM_STR);  
        $stmt->bindValue(":lastname",$newdata["lastname"] ?? $currentdata["lastname"], PDO::PARAM_STR);  
        $stmt->bindValue(":section",$newdata["section"] ?? $currentdata["section"], PDO::PARAM_STR);   

        $stmt->bindValue(":student_number",$newdata["student_number"] ?? $currentdata["student_number"], PDO::PARAM_STR);   

        $stmt->execute();
        return $stmt->rowCount();
    }


    public function GetValidateByRfidTag(string $student_number) : array | false {
        
        $query = "SELECT rfidtag, student_number, firstname, middlename, lastname, section, email 
                  FROM student_information
                  WHERE rfidtag = :rfidtag";   

        $stmt = $this->conn->prepare($query);  
        $stmt->bindValue(":rfidtag", $student_number, PDO::PARAM_STR);  
        $stmt->execute(); 

        $data = [];
        if( $stmt->rowCount() > 0){           
            $data = $stmt->fetch(PDO:: FETCH_ASSOC);  
            return $data;
        }else{
            $data = [ "status" => false, "message" => "Student not exist" ];
            return $data;
        }
    }
}
?>