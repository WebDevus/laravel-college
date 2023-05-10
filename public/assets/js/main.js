$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#registerButton').click(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "/register/next",
        data: $('#formRegister').serialize(),
        success: function (response) {
            if(response.success) {
                window.location.href = '/'
            }

            if(!response.success) {
                $('#errorResponse').text(response.message)
            }
        }
    });
});

$('a#addToCartButton').click(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "/cart/add",
        data: {
            id: $(this).data('product')
        },
        success: function (response) {
            if(response.success) {
                window.location.href = '/cart'
            }

            if(!response.success) {
                $('#errorResponse').text(response.message)
            }
        }
    });
});

$('#cartSubmitButton').click(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "/cart/next",
        data: $('#cartNextForm').serialize(),
        success: function (response) {
            if(response.success) {
                window.location.href = '/cart'
            }

            if(!response.success) {
                $('#errorResponse').text(response.message)
            }
        }
    });
});