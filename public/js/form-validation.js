$(function () {
    $('#form_validation').validate({
        rules: {
            'checkbox': {
                required: true
            },
            'gender': {
                required: true
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });


    //Register Form
    // $('#registerform').validate({
    //     rules: {
    //         'fname' : {
    //             required: true,
    //             maxlength: 40
    //         },
    //         'lname' : {
    //             required: true,
    //             maxlength: 40
    //         },
    //         'contact_no' : {
    //             required: true,
    //             // contact: true
    //         },
    //         'location': {
    //             required: true
    //         },
    //         'email': {
    //             email: true
    //         },
    //         'password' : {
    //             required: true
    //         },
    //         'password_confirmation' : {
    //             equalTo: #password
    //         },
    //         'bday' : {
    //             required: true,
    //             date: true  
    //         },
    //         'weight' : {
    //             required: true,
    //         },
    //         'height' : {
    //             required: true
    //         }
    //     }
    // });
    //Contact Number

    //  $.validator.addMethod('contact', function (value, element) {
    //     return value.match(/^\d\d\d\d?-\d\d?-\d\d$/);
    // },
    //     'Please enter a date in the format YYYY-MM-DD.'
    // );
    
    $('#add_dish').validate({
        rules: {
            'img' : { required: true},
            'dish_name' : {required: true},
            'serving' : {required: true},  
            'duration' : {required: true},
            'price' : {required: true},
            'signDish' : { checked: true },
            'price' : {required: true}

        },
         highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });

    $.validator.addMethod("checked", function(value, elem, param) {
    if($(".roles:checkbox:checked").length > 0){
       return true;
   }else {
       return false;
   }
    },"You must select at least one!");
    //Advanced Form Validation
    $('#form_advanced_validation').validate({
        rules: {
            'date': {
                customdate: true
            },
            'creditcard': {
                creditcard: true
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });

    //Custom Validations ===============================================================================
    //Date
    $.validator.addMethod('customdate', function (value, element) {
        return value.match(/^\d\d\d\d?-\d\d?-\d\d$/);
    },
        'Please enter a date in the format YYYY-MM-DD.'
    );

    //Credit card
    $.validator.addMethod('creditcard', function (value, element) {
        return value.match(/^\d\d\d\d?-\d\d\d\d?-\d\d\d\d?-\d\d\d\d$/);
    },
        'Please enter a credit card in the format XXXX-XXXX-XXXX-XXXX.'
    );
    //==================================================================================================
});