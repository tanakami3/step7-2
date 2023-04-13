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
        <h1>商品一覧</h1>
        @if (session('err_msg'))
                <p class="text-danger">
                    {{ session('err_msg') }}
                </p>
        @endif
<!--検索機能-->
<div class="col-md-8 col-md-offset-2">
    <div class="input-group">
        <table>
        
            <form action="{{ route('products') }}" method="GET">
                <tr>
                <!--value="@if (isset($search)) {{ $search }} @endif"←ここで入力されたキーワードを保持する-->
                <td><input type="text" id="txt-search" class="form-control input-group-prepend" placeholder="キーワードを入力" name="keyword" value="@if (isset($search)) {{ $search }} @endif"></input></td>
                    <div class="form-group-sm clearfix">
                        <td><label for="formGroupExampleInput2" class="mt-3 mb-0">企業名</label><td>
                            <div class="product-info width-control">
                                <td> <select class="content-half-width form-control-sm d-inline" id="changeSelect" name="company_id" onchange="entryChange2();">
                                    <option value="">未選択</option>
                                        @foreach ($companies as $company)
                                        <!--$companyでcompaniesテーブルのcompany_nameの値を取得する-->
                                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                        @endforeach
                                    </select>
                            </div></td>
                    </div>
            
                    <div class="clearfix">
                         <td><button>
                            <a href="{{ route('products') }}" class="text-black">
                                クリア
                            </a>
                        </button></td>
                    </div>
                </tr>
                <tr>
                    <td><input type="text" id="price-search" class="form-control input-group-prepend" placeholder="価格を入力" name="price_number" value="@if (isset($search)) {{ $search }} @endif"></input></td>
                </tr>
                <tr>
                    <span class="input-group-btn input-group-append">
                        <td><input type="button" id="btn-search" class="btn btn-primary" value="検索"><i class="fas fa-search"></i> </input></td>
                    </span>
                </tr>
            </form>
        </table>
        <script src="{{ asset('/js/search.js') }}"></script>
       
    </div>
    <!--検索結果を表示-->

    <div>
        <h3>検索結果</h3>
        <table id="search_result"></table>
    </div>
</div>
        <table class="table table-striped">
            <tr>
                <th scope="col">@sortablelink('id', 'ID')</th>
                <th scope="col">@sortablelink('product_name', '商品名')</th>
                <th scope="col">@sortablelink('img_path', '画像')</th>
                <th scope="col">@sortablelink('price', '価格')</th>
                <th scope="col">@sortablelink('stock', '在庫数')</th>
                <th scope="col">@sortablelink('company_name', '企業')</th>
                <th scope="col">@sortablelink('comment', 'コメント')</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td><img src="{{ Storage::url($product->img_path) }}" width=100 height=100></td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->company_name }}</td>
                <td>{{ $product->comment }}</td>
                <td><a href="{{ route('detail', ['id'=>$product->id]) }}" class="btn btn-primary">詳細</a></td>
                <td><button type="button" class="btn btn-primary" onclick="location.href='/product/edit/{{ $product->id }}' ">編集</button></td>
                <form method="POST" action="{{ route('delete', $product->id) }}" id="delete-id" onSubmit="return checkDelete('削除しますか？')">
                    @csrf
                    <td><button type="submit" class="btn btn-primary" id="delete-btn" >削除</button></td>
                    <input type="hidden" value="{{$product->id}}" class="product-id">
                </form>
            </tr>
        @endforeach
        
        </table>
    </div>
</div>
<!-- <script>
function checkDelete(){
    if(window.confirm('削除してよろしいですか？')){
        return true;
    } else {
        return false;
    }   
}
</script> -->
<script src="{{ asset('/js/delete.js') }}"></script>

@endsection

