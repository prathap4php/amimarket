$('#add_compition').on('submit', function(e){
    e.preventDefault();
    str = true;
    $('#category_error,#casting_error,#title_error,#date_error,#starttime_error,#end_error,#description_error').html();
    var category = $('#category').val();
    var casting = $('#casting').val();
    var title = $('#title').val();
    var date = $('#datepicker').val();
    var starttime = $('#start_time');
    var endtime = $('#end_time');
    var description = $('#description').val();
    if(category==''){str=false;$('#category_error').html('Select category!');}
    if(casting==''){str=false;$('#casting_error').html('Enter casting!');}
    if(title==''){str=false;$('#title_error').html('Enter title!');}
    if(date==''){str=false;$('#date_error').html('Enter date!');}
    if(starttime==''){str=false;$('starttime_error').html('Select start time!');}
    if(endtime==''){str=false;$('#endtime_error').html('Select end time!');}
    if(str==true){
        var formDetails = JSON.stringify($('#add_compition').serializeObject());
        // $('.btn_section').hide();
        $('.submissionMessage').html('Please wait...').css({'color':'blue'});
        $.ajax({
            dataType: "JSON",
            type: "POST",
            data: formDetails,
            url: baseURL+'admin/Admin/insert_compition',
            contentType: false,
            cache: false,
            processData: false,
            success:function(s){
                console.log(s);
                switch(s.code){
                    case 200:
                        $('.submissionMessage').html(s.description).css({'color':'green','font-size':'15px'});
                        setTimeout(function(){window.location=redirectionURL;},2000);
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