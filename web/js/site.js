function updateFrendPovod(frend_id,povod_id){

        var c= $("#povod"+povod_id).prop('checked');

    //console.log(c);
    $.ajax({
        type:'post',
        url: '/pupdate',
        data:{
        'frend_id':frend_id,
        'povod_id':povod_id,
        'enable':c},

        success: function(html){
            $("#frend-povod").html(html);
        }
    });
}
