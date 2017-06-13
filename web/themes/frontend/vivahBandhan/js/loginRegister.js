$('#register-button').on('click', function () {
    var form = $('form#registerForm');        
    $.ajax({
        url    : form.attr('action'),
        type   : 'post',
        data   : form.serialize(), 
        dataType: 'json',
		beforeSend: function(){
			$('#register-button').attr('disabled', 'disabled');
			$('#register-button').html('Please wait...');
		},
        success: function (response) 
        { 
            $('#responseRegisterMessage').html(response.message); 
			$('#register-button').removeAttr('disabled');
			$('#register-button').html('Register');
            console.log(response);
        },
        error  : function (e) 
        {
            console.log('internal server error');
        }
    });
    return false;
 });

$('#login-button').on('click', function () {
    var form = $('form#loginForm');        
    $.ajax({
        url    : form.attr('action'),
        type   : 'post',
        data   : form.serialize(), 
        dataType: 'json',           
        success: function (response) 
        { 
            if(response.success == 1){
                window.location.href = response.redirectUrl;
            }
            $('#login-message').html(response.message);              
            console.log(response);
        },
        error  : function () 
        {              
            console.log('internal server error');
        }
    });
    return false;
 });