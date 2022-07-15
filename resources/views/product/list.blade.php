<!--
①共通テンプレlayout.blade.phpを作る
②共通ヘッダーを作る
③共通フッターを作る
④共通テンプレをを継承したリストを作る
--->

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