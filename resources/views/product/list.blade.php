<!--
①共通テンプレlayout.blade.phpを作る
②共通ヘッダーを作る
③共通フッターを作る
④共通テンプレをを継承したリストを作る
--->

 
    @extends('product.layout')
    
    @section('top-page')
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <h2>商品一覧</h2>
                @if (session('err_msg'))
                        <p class="text-danger">
                            {{ session('err_msg') }}
                        </p>
                @endif
                <table class="table table-striped">
                    <tr>
                        <th>商品ID</th>
                        <th>日付</th>
                        <th>商品名</th>
                        <th>商品画像</th>
                        <th>価格</th>
                        <th>在庫数</th>
                        <th>企業名</th>
                        <th>コメント</th>
                        <th></th>
                        <th></th>
                    </tr>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->img_path }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->company_id }}</td>
                        <td>{{ $product->comment }}</td>
                        <td><a href="{{ route('detail', ['id'=>$product->id]) }}" class="btn btn-primary">詳細</a></td>
                        <td><button type="button" class="btn btn-primary" onclick="location.href='/product/edit/{{ $product->id }}' ">編集</button></td>
                    </tr>
                @endforeach
                
                </table>
            </div>
        </div>
        <script>
        function checkDelete(){
            if(window.confirm('削除してよろしいですか？')){
                return true;
            } else {
                return false;
            }   
        }
        </script>
    @endsection

