
    $(document).on('click', '#delete-btn', function ()
    // $('#delete-btn').on('click', function ()
    {
    // 何かの処理
        let id = $('#product-id').val();
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
                    }
            });
        };

    });
