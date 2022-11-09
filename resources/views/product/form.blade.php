@extends('product.layout')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>商品登録フォーム</h2>
        <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="product_name">商品名</label>
                <input
                    id="product_name"
                    name="product_name"
                    class="form-control"
                    value="{{ old('product_name') }}"
                    type="text"
                >
                @if ($errors->has('product_name'))
                    <div class="text-danger">
                        {{ $errors->first('product_name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="company_id">メーカー</label>
                <select name="company_id" id="company_id" class="form-control">
                    @foreach($company_name as $items)
                    <option value="{{ $items->id }}" id="company_id" name="company_id">{{ $items -> company_name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('company_name'))
                    <div class="text-danger">
                        {{ $errors->first('company_name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="price">価格</label>
                <input
                    id="price"
                    name="price"
                    class="form-control"
                    value="{{ old('price') }}"
                    type="text"
                >
                @if ($errors->has('price'))
                    <div class="text-danger">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="stock">在庫数</label>
                <input
                    id="stock"
                    name="stock"
                    class="form-control"
                    value="{{ old('stock') }}"
                    type="text"
                >
                @if ($errors->has('stock'))
                    <div class="text-danger">
                        {{ $errors->first('stock') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="comment">
                    コメント
                </label>
                <textarea
                    id="comment"
                    name="comment"
                    class="form-control"
                    rows="4"
                >{{ old('comment') }}</textarea>
                @if ($errors->has('comment'))
                    <div class="text-danger">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="image">
                    商品画像
                </label> 
                <!-- <label for="photo">画像ファイル:</label>
                <input type="file" class="form-control" name="img_path">      -->
                <br>
                <input type="file" name="image" id="image">            
                <br>
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('products') }}">
                    戻る
                </a>
                <button type="submit" class="btn btn-primary">
                    登録する
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
    if(window.confirm('送信してよろしいですか？')){
        return true;
    } else {
        return false;
    }   
}
</script>