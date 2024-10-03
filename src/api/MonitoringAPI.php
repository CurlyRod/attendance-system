<?php   
class MonitoringAPI{
    private PDO $conn; 
    
    public function __construct( Database $database)
    {
        $this->conn = $database->getConnection();
    }   

    public function GetValidateAttendance(string $rfidtag) : array | false {
        
        $query = "SELECT * FROM monitoring_information 
                  WHERE rfidtag = :rfidtag
                  AND DATE(time_in) = :timenow"; 

        $stmt = $this->conn->prepare($query);   
        $timeNow = date("Y-m-d");
        $stmt->bindValue(":rfidtag", $rfidtag, PDO::PARAM_STR);  
        $stmt->bindValue(":timenow",$timeNow, PDO::PARAM_STR ); 
        $stmt->execute(); 

        $data = [];
        if( $stmt->rowCount() > 0){           
            $studentIno = 
            $data = [ "status" => true, "message" => "Already Time In." ];
            return $data; 
        }else {
            $data = [ "status" => false, "message" => "No Time in yet." ];
            return $data;
        }
    }
    
   
}