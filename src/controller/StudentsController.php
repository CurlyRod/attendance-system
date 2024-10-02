<?php

class StudentsController
{   
    //create constructor for accessing api layer 
    public function __construct(private Student $student) {    
    }    

    public function processRequestMethod(string $method, ?string $id) : void
    {
        if (!$id) { 
            $this->processByRequest($method);
        }
    }  

    private function processRequestSingle(string $method, string $student_number) : void
    {
        $student_number = $this->student->getValidateByStudentNumber($student_number); 
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

    private function processByRequest(string $method) : void
    {
         switch ($method) {
             case "GET":
                echo json_encode($this->student->GetAllStudent()); 
                break; 
      }
    }

}
?>