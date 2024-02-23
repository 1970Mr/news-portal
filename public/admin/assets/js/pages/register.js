$("#advanced-form").validate({
    rules: {
        name: {
            required: true,
            minlength: 2
        },
        password: {
            required: true,
            // minlength: 5
        },
        password_confirmation: {
            required: true,
            // minlength: 5,
            equalTo: "#password"
        },
        email: {
            required: true,
            email: true
        },
        agree: "required"
    },
    messages: {
        name: {
            required: "نام خود را وارد نمائید",
            minlength: "نام باید دست کم 2 کاراکتر باشد"
        },
        password: {
            required: "رمز عبور را وارد نمائید",
            // minlength: "رمز عبور دست کم باید 5 کاراکتر باشد"
        },
        password_confirmation: {
            required: "تائید رمزعبور را وارد نمائید",
            // minlength: "تائید رمز عبور دست کم باید 5 کاراکتر باشد",
            equalTo: "رمزهای عبور یکسان نیستند"
        },
        email: {
            required: "ایمیل خود را وارد نمائید",
            email: "نشانی ایمیل صحیح نیست",
        },
        agree: "تیک تائید قوانین را بزنید"
    },
    errorElement: "span",
    errorPlacement: function (error, element) {
        error.addClass("help-block");

        if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else if (element.prop("type") === "checkbox") {
            error.insertAfter(document.getElementById('agree-label'));
        } else {
            error.insertAfter(element);
        }
    },

    highlight: function (element, errorClass, validClass) {
        $(element).parents(".form-group").addClass("has-error").removeClass("has-success");
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).parents(".form-group").addClass("has-success").removeClass("has-error");
    }
});
