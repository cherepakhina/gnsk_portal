
$(document).ready(function(){
    $('.btn').attr('disabled',true);

    $('#fileToUpload, #role').change(function(){
        if($(this).val()==''){
            $('.btn').attr('disabled',true)
        } 
        else{
          $('.btn').attr('disabled',false);
        }
    })
    $('#fname, #lname, #password').change(function(){
        if($(this).val().length !=0){
            $('.btn').attr('disabled', false);
        }
        else
        {
            $('.btn').attr('disabled', true);        
        }
    })
});