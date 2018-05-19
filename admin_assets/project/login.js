$('#admin_login_form').on('submit',function(e){
    e.preventDefault();
    str=true;
    $('#email_error,#password_error').html('');
    var email=$('#email').val();
    var password=$('#password').val();
    if(email==''){str=false;$('#email_error').html('Enter email!');}
    else if(!emailpattern.test(email)){str=false;$('#email_error').html('Invalid Email!');}
    if(password==''){str=false;$('#password_error').html('Enter password!');}
    else if(!passwordpattern.test('password')){str=false;$('#password_error').html('Invalid Password!');}
    if(str==true)
    {
        var formdetails = JSON.stringify($('#admin_login_form').serializeObject());
        // $('#form-submit').hide();
        $('.submissionMessage').html('Please wait..').css({'color':'blue'});
        $.ajax({
            dataType:"JSON",
            type:"POST",
            data: formdetails,
            url:actionLink,
            contentType:false,
            cache:false,
            processData:false,
            success:function(s){
                console.log(s);
                switch(s.code)
                {
                case 200:
                        $('.submissionMessage').html(s.description).css({'color':'green','font-size':'15px'});
                        setTimeout(function() {
                        window.location=redirectionURL;
                    }, 2000);
                        break;
                case 204:
                case 575:
                case 422:
                    $('.submissionMessage').html(s.description).css({'color':'red','font-size':'15px'});
                    $('.btn_section').show();
                    break;
                case 301:
                            $('.submissionMessage').html(s.description).css({'color':'red','font-size':'15px'});
                        $('.btn_section').show();
                    break;
                }
            },
            error:function(er){
                console.log(er);
            }
        });
    }
    return str;
});   