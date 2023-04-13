// $(function() {
//     $('').on('click', function () {
//         // console.log('aaa');
//         $.ajax({
//             type: 'GET',
//             url: 'products', //ProductControllerのsearchメソッドにアクセス
//             data:{},//わたす検索ワードを設定
//             dataType: 'json', //Json形式で取得
//         })
//         .done(function (data) {
//             console.log(data);
//             let html =`
//             <div class="flex-center position-ref full-height">
//             <h1>検索結果</h1>
//             <!--商品一覧表示-->

//                 <table class="table table-striped">
//                     <thead>
//                         <tr>
//                         <th scope="col">ID</th>
//                         <th scope="col">商品名</th>
//                         <th scope="col">画像</th>
//                         <th scope="col">価格</th>
//                         <th scope="col">在庫数</th>
//                         <th scope="col">企業</th>
//                         <th scope="col">コメント</th>
//                         </tr>
//                     </thead>
//                     <tbody>
//                     <tr>
//                         <td>${data.data[0].id}<td>
//                         <td>${data.data[0].product_name}<td>
//                         <td><img src="${data.data[0].img_path}" width=100 height=100></td> 
//                         <td>${data.data[0].price}<td>
//                         <td>${data.data[0].stock}<td>
//                         <td>${data.data[0].company_name}<td>
//                         <td>${data.data[0].comment}<td>
//                     </tr>
//                     </tbody>
//                 </table>
//             </div>
//             `;
//             $("#showList").append(html);
//         })
//         .fail(function (err) {
//             // error
//             alert('ファイルの取得に失敗しました。');
//         });
//     });
// });


//                 // var productsData_stringify = JSON.stringify(productsData);
//                 // var data_json = JSON.parse(productsData_stringify);
//                 // //jsonデータから各データを取得
//                 // var data_id = data_json[0]["id"];
//                 // var data_updated_at = data_json[0]["updated_at"];
//                 // var data_product_name = data_json[0]["product_name"];
//                 // var data_img_path = data_json[0]["img_path"];
//                 // var data_price = data_json[0]["price"];
//                 // var data_stock = data_json[0]["stock"];
//                 // var data_company_name = data_json[0]["company_name"];
//                 // var data_comment = data_json[0]["comment"];
//                 // //出力
//                 // $("#id").text(data_id);
//                 // $("#updated_at").text(data_updated_at);
//                 // $("#product_name").text(data_product_name);
//                 // $("#img_path").text(data_img_path);
//                 // $("#price").text(data_price);
//                 // $("#stock").text(data_stock);
//                 // $("#company_name").text(data_company_name);
//                 // $("#comment").text(data_comment);

          
   


