<?php   
class MonitoringController
{   
    //create constructor for accessing api layer 
    public function __construct(private MonitoringAPI $monitoringApi,   
                                private StudentAPI $studentApi) {
        
    }  
   
    public function processRequestMethod(string $method, ?string $id) : void
    {
        if($id) {
            $this->processAttendance($method, $id);
        }       
    } 

    private function processByRequest(string $method) : void
    {
         switch ($method) {
             case "GET":
                echo json_encode($this->studentApi->getAllStudent()); 
             break;
         }
    }  

    private function processAttendance(string $method, string $student_number) : void
    {
        $student_number = $this->studentApi->getValidateByStudentNumber($student_number); 
        if( !$student_number )
        {
            http_response_code(404);
            echo json_encode([ "message" => "Student not exist" ]);      
            return;    
        }
        switch ($method) {
            case "GET": 
                echo json_encode($student_number); 
                break;
        }
    }



}

?>