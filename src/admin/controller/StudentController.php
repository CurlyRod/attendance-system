<?php

class StudentController
{   
    //create constructor for accessing api layer 
    public function __construct(private StudentAPI $studentApi) {
        
    }

    public function processRequestMethod(string $method, ?string $id) : void
    {
        // process Base on Request -- rod 
        if ($id) { 
            $this->processRequestSingle($method, $id);
        }else {
            $this->processByRequest($method);
        }
    } 

    private function processRequestSingle(string $method, string $student_number) : void
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
            case "PATCH" : 
                $data = (array) json_decode(file_get_contents("php://input"), true); 
                
                $errors = $this->getValidationRequest($data, false); 
                if(! empty($errors)) { 
                    http_response_code(422);
                    echo json_encode([ "errors" => $errors ]);    
                    break;
                }
                $rows =  $this->studentApi->updateStudent($student_number, $data); 
                $studNumber =  $student_number['student_number'];
                echo json_encode([   
                    "message" => "Update  Successfully",  
                    "studentnumber:" => $studNumber,
                    "rows" => $rows
                ]);
            break;  
        }
    }
    
    private function processByRequest(string $method) : void
    {
         switch ($method) {
             case "GET":
                echo json_encode($this->studentApi->getAllStudent()); 
                break; 
             case "POST":    
                $data = (array) json_decode(file_get_contents("php://input"), true); 
                
                    $errors = $this->getValidationRequest($data, false); 
                    if(! empty($errors)) { 
                        http_response_code(422);
                        echo json_encode([ "errors" => $errors ]);    
                        break;
                    }
                    $id =  $this->studentApi->registerStudent($data); 
                    http_response_code(201);
                    echo json_encode([
                        "message" => "Register Successfully", 
                        "id" => $id
                    ]);
                break;  
            default :  
                http_response_code(405);  
                header("Allow: GET, POST");
         } 
    }  

    private function getValidationRequest(array $data, bool $new_data = true) : array {
         $errors = [];
        if ($new_data && empty($data["student_number"]) && empty($data["firstname"]) && empty($data["lastname"]) && empty($data["section"]) ) {
             $errors = array( "error" => "Invalid Request",  "message" => "All fields are required to fill" );  
        }   
        return $errors;
    }
    
    
}
?>