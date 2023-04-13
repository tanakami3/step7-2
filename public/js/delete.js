$(function(){
    $(document).on('click', '#delete-btn', function ()
    {
    // 何かの処理
        let id = $(this).next().val();
        console.log(id);


        if(confirm("削除しますか？") == true){
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url:'delete',
                type:'post',
                data:{'id':id},
                dataType: 'json',
                success: function(data) {
                    alert(data.success);
                    return redirect(route('products'));
                    }
            });
        }

    });
});