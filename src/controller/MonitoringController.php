<?php   
class MonitoringController
{   
    //create constructor for accessing api layer 
    public function __construct( private StudentAPI $studentApi, private MonitoringAPI $monitoringApi ) {       
    }  
   
    public function processRequestMethod(string $method, ?string $id) : void
    {
        if (strlen($id) != 11 || !$id) { 

            http_response_code(404);
            echo json_encode([ "message" => "Student not exist" ]);      
            return;     
        } else {
            $this->processRequestSingle($method, $id);
        }
    }  

    private function processRequestSingle(string $method, string $rfid_number) : void
    {   
        if($rfid_number) 
        {   
                $student_info = $this->studentApi->GetValidateByRfidTag($rfid_number);   
                $attendance_info = $this->monitoringApi->GetValidateAttendance($rfid_number); 
              
                switch ($method) {
                    case "GET": 
                        echo json_encode($attendance_info); 
                break;    
            } 
        }  
    } 

    private function processByRequest(string $method) : void
    {
        switch ($method) {
            case "GET":
               echo json_encode($this->studentApi->GetAllStudent()); 
               break;        
      }
    } 
    private function validateAttendanceIfExist($student_number) {
       
        if($student_number) {

        }   
    }



}

?>