    $(document).ready(function(){
            // validate the comment form when it is submitted
            // $("#gen_form").validate();

        // general information
            $("#gen_form").validate({
                rules: {
                fname : {
                    required:true,
                    maxlength: 40,
                    minlength:2
                },
                lname : {
                    required:true,
                    maxlength: 40,
                    minlength:2
                },
                email: {
                    required:true,
                    email: true
                
                },
                contact_no: {
                  required:true,
                  digits:true,
                  minlength:6,
                  maxlength:13
                }
            },
                messages: {
                    fname: {
                        required:"Please enter your first name"
                    },
                     lname: {
                        required:"Please enter your last name"

                    },
                    email: "Please enter a valid email address"
                    
                }

                
            });
           
           //health information
              $("#health_form").validate({
                rules: {
                weight : {
                    required:true,
                    min:1

                },
                height : {
                    required:true,
                    min:1
                   
                }
             },
                messages: {
                    weight: {
                        required:"Please enter your weight",
                        min:"Invalid weight"
                    },
                     height: {
                        required:"Please enter your height",
                        min:"Invalid height"
                       
                    }
                    
                }
            });
              
        //add allergen form
            $("#addaller_form").validate({
                rules: {
                tol: {
                    required:true
                }
             
             }
                
            });

    });