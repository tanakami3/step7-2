$(document).on('click', '#delete-btn', function(){
    
    let id = $(this).parent().next().val();
    let remove = $(this).parent().parent();
    console.log(id);

    if(confirm("削除しますか？") == true){
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url:'/product/delete',
            type:'post',
            data:{'id':id},
            dataType: 'json',
        })   
        .done(function (data) {
            remove.remove();
        })
        .fail(function (err) {
        });
    };

});
