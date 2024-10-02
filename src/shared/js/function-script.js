$(document).ready(function(){
    RenderAllRecord();
    TotalUser();
    TotalSection(); 
    TotalLate();
    TotalVerified();
    function RenderAllRecord() {
        $.ajax({
            url: "../controller/ActionController.php",
            type: "POST",
            data: {
                action: "view"
            },
            success: function(response) {
                
                $("#showUser").html(response);
                $('#user_datatable').DataTable({
                    order: [0, "desc"],
                    responsive: true
                }); 
                
            }
        });
    }

    function TotalUser() {
        $.ajax({
            url: "../controller/ActionController.php",
            type: "POST",
            data: {
                action: "countuser"
            },
            success: function(response) {
                var data = JSON.parse(response);
                $("#total-user").html(data.total_user);
            }
        });
    }   

    function TotalSection() {
        $.ajax({
            url: "../controller/ActionController.php",
            type: "POST",
            data: {
                action: "countsection"
            },
            success: function(response) {
                var data = JSON.parse(response); 
              
                $("#total-section").html(data.total_section);
            }
        });
    }  

    function TotalLate() {
        $.ajax({
            url: "../controller/ActionController.php",
            type: "POST",
            data: {
                action: "countlate"
            },
            success: function(response) {
                var data = JSON.parse(response); 
                console.log(data);
                $("#total-late").html(data.total_late);
            }
        });
    }  

    function TotalVerified() {
        $.ajax({
            url: "../controller/ActionController.php",
            type: "POST",
            data: {
                action: "countverified"
            },
            success: function(response) {
                var data = JSON.parse(response); 
                console.log(data);
                $("#total-verified").html(data.total_verified);
            }
        });
    } 
 

//view
    $('body').on("click", ".viewBtn" , function(e){   

        e.preventDefault();
         var userId = $(this).attr('id');  
        $.ajax({ 
            url:"../controller/ActionController.php", 
            type:"POST", 
            data:{view_id: userId ,action: "viewinfo"},
            success:function(response){
            var data = JSON.parse(response);  
            console.log(data); 
            $("#view_user_Id").val(data[0].id); 
            $("#view_student_number").val(data[0].student_number);  
            $("#view_rfid").val(data[0].verify_tag); 
            $("#view_section").val(data[0].sid); 
            $("#view_fname").val(data[0].first_name); 
            $("#view_mname").val(data[0].middle_name); 
            $("#view_lname").val(data[0].last_name); 
            $("#view_email").val(data[0].email); 
            }
        });
    }); 
}); 

