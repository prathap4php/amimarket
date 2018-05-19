$('#add_animation_type').on('submit', function(e){
    e.preventDefault();
    str=true;
    $('#title_error,#description_error').html('');
    var title = $('#title').val();
    var description = $('#description').val();
    if(title==''){str=false;$('#title_error').html('Enter title!');}
    if(description==''){str=false;$('#description_error').html('Enter description!');}
    // else if(!name_num_pattern.test(title)){str=false;$('#title_error').html('Invalid title!');}
    if(str==true)
    {
        var formDetails = JSON.stringify($('#add_animation_type').serializeObject());
        $('.btn_section').hide();
        $('.submissionMessage').html('Please wait..').css({'color':'blue'});
        $.ajax({
            dataType:"JSON",
            type:"POST",
            data: formDetails,
            url: baseURL+'admin/Admin/insert_animation_type',
            contentType:false,
            cache:false,
            processData:false,
            success:function(s){
            console.log(s);
                switch(s.code)
                {
                    case 200:
                        $('.submissionMessage').html(s.description).css({'color':'green','font-size':'15px'});
                        setTimeout(function(){
                            window.location=redirectionURL;
                        }, 2000);
                        break;
                    case 204:
                        $('.submissionMessage').html(s.description).css({'color':'red','font-size':'15px'});
                        $('.btn_section').show();
                        break;
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
            error: function(er){
                console.log(er);
            }
        });
    }
    return str;
});

$('#edit_animation_type').on('submit', function(e){
    e.preventDefault();
    str=true;
    $('#title_error').html('');
    var title = $('#title').val();
    var description = $('#description').val();    
    var type_id = $('#type_id').val();
    if(title==''){str=false;$('#title_error').html('Enter title!');}
    if(description==''){str=false;$('#description_error').html('Enter description!');}
    // else if(!name_num_pattern.test(title)){str=false;$('#title_error').html('Invalid title!');}
    if(str==true)
    {
        var formDetails = JSON.stringify($('#edit_animation_type').serializeObject());
        $('.btn_section').hide();
        $('.submissionMessage').html('Please wait..').css({'color':'blue'});
        $.ajax({
            dataType:"JSON",
            type:"POST",
            data: formDetails,
            url: baseURL+'admin/Admin/update_animation_type',
            contentType:false,
            cache:false,
            processData:false,
            success:function(s){
            console.log(s);
                switch(s.code)
                {
                    case 200:
                        $('.submissionMessage').html(s.description).css({'color':'green','font-size':'15px'});
                        setTimeout(function(){
                            window.location=redirectionURL;
                        }, 2000);
                        break;
                    case 204:
                        $('.submissionMessage').html(s.description).css({'color':'red','font-size':'15px'});
                        $('.btn_section').show();
                        break;
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
            error: function(er){
                console.log(er);
            }
        });
    }
    return str;
});