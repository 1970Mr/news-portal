$.validator.setDefaults({
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error').removeClass("has-success");
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass("has-success");
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});

$("#simple-form").validate();
$("#validate-form").validate();


$( "#advanced-form" ).validate( {
    rules: {
        firstname: "required",
        lastname: "required",
        username: {
                required: true,
                minlength: 2
        },
        password: {
                required: true,
                minlength: 5
        },
        confirm_password: {
                required: true,
                minlength: 5,
                equalTo: "#password"
        },
        email: {
                required: true,
                email: true
        },
        agree: "required"
    },
    messages: {
        firstname: "لطفا نام را وارد کنید",
        lastname: "لطفا نام خانوادگی را وارد کنید",
        username: {
                required: "نام کاربری اجباری است",
                minlength: "نام کاربری باید دست کم 2 کاراکتر باشد"
        },
        password: {
                required: "رمز عبور را وارد نمائید",
                minlength: "رمز عبور دست کم باید 5 کاراکتر باشد"
        },
        confirm_password: {
                required: "تائید رمز عبور را وارد نمائید",
                minlength: "تائید رمز عبور دست کم باید 5 کاراکتر باشد",
                equalTo: "رمزهای عبور یکسان نیستند"
        },
        email: "نشانی رایانامه صحیح نیست",
        agree: "تیک تائید قوانین را بزنید"
    },
    errorElement: "em",
    errorPlacement: function ( error, element ) {
        error.addClass( "help-block" );

        if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
        } else {
                error.insertAfter( element );
        }
    },
    highlight: function ( element, errorClass, validClass ) {
        $( element ).parents( ".col-sm-6" ).addClass( "has-error" ).removeClass( "has-success" );
    },
    unhighlight: function (element, errorClass, validClass) {
        $( element ).parents( ".col-sm-6" ).addClass( "has-success" ).removeClass( "has-error" );
    }
} );
