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
        var data_stringify = JSON.stringify(data);
        var data = JSON.parse(data_stringify);

        console.log(data);
        
        let html =`
        <div class="flex-center position-ref full-height">
       
        <!--商品一覧表示-->

            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">商品ID</th>
                    <th scope="col">商品名</th>
                    <th scope="col">商品画像</th>
                    <th scope="col">価格</th>
                    <th scope="col">在庫数</th>
                    <th scope="col">企業名</th>
                    <th scope="col">コメント</th> 
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>${data.data[0].id}<td>
                    <td>${data.data[0].product_name}<td>
                    <td><img src="/step7-2/public/storage/${data.data[0].img_path}" width=100 height=100></td>
                    <td>${data.data[0].price}<td>
                    <td>${data.data[0].stock}<td>
                    <td>${data.data[0].company_name}<td>
                    <td>${data.data[0].comment}<td>
                </tr>
                </tbody>
            </table>
        </div>
         `;
        $('#search_result').append(html);
        })
        .fail(function (err) {
        // 通信失敗時の処理
        alert('ファイルの取得に失敗しました。');

        });

    });
});
