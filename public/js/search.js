$(function(){
    $('#btn-search').on('click', function (){
        let keyword = $('#txt-search').val();
        let company_id = $('#changeSelect').val();
        let lowLimitPrice = $('#lowLimitPrice').val();
        let upLimitPrice = $('#upLimitPrice').val();
        let upLimitStock = $('#upLimitStock').val();
        let lowLimitStock = $('#lowLimitStock').val();

        console.log(keyword);
        console.log(company_id);
        console.log(lowLimitPrice);
        console.log(upLimitPrice);
        console.log(upLimitStock);
        console.log(lowLimitStock);
        

        $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'get',
        url: '/product/search',
        data:{'keyword': keyword,
              'company_id': company_id ,
              'lowLimitPrice':lowLimitPrice,
              'upLimitPrice':upLimitPrice,
              'upLimitStock':upLimitStock,
              'lowLimitStock':lowLimitStock
            },
        dataType: 'json',
        
        })
        .done(function (data) {
            $(".list_data").remove();
            var table = $(".table-striped");
            var data_stringify = JSON.stringify(data);
            var data = JSON.parse(data_stringify);

            console.log(data);

            // console.log(Object.keys(data.data).length);
            // var len = Object.keys(data.data).length;          
            // for(i=0;i<len;i++){

            $.each(data.data, function(index,val) {   
            console.log(val); 
            let html =`
                    <tr>
                        <td>${val.id}</td>
                        <td>${val.product_name}</td>
                        <td><img src="${val.img_path}" width=100 height=100></td>
                        <td>${val.price}</td>
                        <td>${val.stock}</td>
                        <td>${val.company_name}</td>
                        <td>${val.comment}</td>
                        <td><a href="${val.detail_url}" class="btn btn-primary">詳細</a></td>
                        <td><button type="button" class="btn btn-primary" onclick="location.href='/product/edit/${val.id}' ">編集</button></td>
                        <form method="POST" action="{{ route('delete',${val.id} ) }}" id="delete-id" onSubmit="return checkDelete('削除しますか？')">
                            @csrf
                            <td><button type="button" class="btn btn-primary" id="delete-btn" >削除</button></td>
                            <input type="hidden" value="${val.id}" class="product-id" id="product-id" >
                         </form>
                    </tr>
            `;
            table.append(html);
            });
        })
        .fail(function (err) {
        // 通信失敗時の処理
        alert('ファイルの取得に失敗しました。');

        });

    });
});
