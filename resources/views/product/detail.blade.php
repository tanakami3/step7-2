<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>商品詳細</h2>
        <table class="table table-striped">
            <tr>
                <th>商品ID</th>
                <th>日付</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>メーカー</th>              
                <th>価格</th>
                <th>在庫数</th>
                <th>コメント</th>
            </tr>
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->updated_at }}</td>
                <td>{{ $product->img_path }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->company_name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->comment }}</td>
                <!-- <td><button type="button" class="btn btn-primary" onclick="location.href='/product/edit/{{ $product->id }}' ">編集</button></td> -->
                <td><a class="btn btn-secondary" href="{{ route('products') }}">戻る</a><td>
            </tr>
        </table>
    </div>
</div>