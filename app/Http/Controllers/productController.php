<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\company;
use App\Http\Requests\productRequest;
use Illuminate\Support\Facades\DB;


class productController extends Controller
{
    /**
     * 商品一覧を表示する
     * 
     * @param Request $request
     * @return view
     */
    // public function showList(Request $request) {

    //     $company_name = \DB::table('companies')->get();
    //     $products = Product::all();

    //     return view('product.list', compact('products','company_name'));


    public function showList(Request $request) {

        $query = DB::table("products")->join("companies", "products.company_id", "=", "companies.id");
    
        // 商品名検索
        if (isset($request->keyword)) {
            $query->where("product_name", "LIKE", "%" . $request->keyword . "%");
        }
    
        // 企業ID検索
        if (isset($request->company_id)) {
            $query->where("company_id", "=", $request->company_id);
        }
    
        $products = $query->get();
    
        return view('product.list', [
            'products' => $products,
            'companies' => Company::all(),
        ]);
    }
    
        // $keyword = $request->input('keyword');
        // $selected_name = $request->input('company_id');

        // try {
        //     $product_list = $this->product->list();
            
        //     $company_data = $this->company->companyInfo();


        //     if ( (!empty($keyword)) || (!empty($selected_name)) || (!empty($keyword) && !empty($selected_name)) ) {
        //         $product_list = $this->product->searchProductByParams($keyword, $selected_name);
        //     }
        // }
        // catch (\Throwable $e) {
        //     throw new \Exception($e->getMessage());
        // }
        // $data = [
        //     'product_list' => $product_list,
        //     'company_data' => $company_data,
        //     'keyword'      => $keyword,
        // ];

        // return view('product.list', compact('date'));


    /**
     * 商品詳細画面を表示する
     * @param int $id
     * @return view
     */
    public function showDetail($id){
        $product = Product::find($id);

        if (is_null($product)) {
            \Session::flash('err_msg','データがありません。');
            return redirect(route('products'));
        }

        return view('product.detail', ['product' => $product]);
    }

    // public function detail(Request $request) {

    //     $id = $request->id;
    //     $products = DB::table('products')->where('id', $id)->get();
    //     return view('product.detail', ['products'=>$products]);
    // }

    /**
     * 商品登録画面を表示する
     * 
     * @return view
     */
    public function showCreate() 
    {
        $company_name = \DB::table('companies')->get();
        return view('product.form', compact('company_name'));
    }

    /**
     * 商品を登録する
     * 
     * @return view
     */
    public function exeStore(ProductRequest $request) 
    {
        //商品のデータを受け取る
        $inputs = $request->all();

        \DB::beginTransaction();
        try {
            //商品を登録
            product::create($inputs);
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            throw new \Exception($e -> getMessage());
        }
        \Session::flash('err_msg','商品を登録しました');
        return redirect(route('products'));
    }

    /**
     * 商品編集画面を表示する
     * @param int $id
     * @return view
     */
    public function showEdit($id)
    {
        $company_name = \DB::table('companies')->get();
        $product = Product::find($id);

        if (is_null($product)) {
            \Session::flash('err_msg','データがありません。');
            return redirect(route('products'));
        }

        return view('product.edit',compact('product','company_name'));
    }

    /**
     * 商品を更新する
     * 
     * @return view
     */
    // public function exeUpdate(ProductRequest $request) 
    // {
    //     //商品のデータを受け取る
    //     $inputs = $request->all();
    //     $img = $request->file('img');
    //     //$path = \Storage::put('/public',$image);
    //    //$path = explode('/',$path);
    //     // if(empty($img)){
    //     //    $img = $request->file('image')->getPathname();
    //     // }
            
    //     \DB::beginTransaction();
    //     try {
    //         //商品を更新
    //         $product = Product::find($inputs);
    //         $product->fill([
    //             'product_name' => $inputs['product_name'],
    //             'company_id' => $inputs['company_id'],
    //             'price' => $inputs['price'],
    //             'stock' => $inputs['stock'],
    //             'comment' => $inputs['comment'],
    //             'img_path' => $inputs['image']
    //             //'image' => $path[1],
    //         ]);
    //         $product = save();
    //         \DB::commit();
    //     } catch(\Throwable $e) {
    //         \DB::rollback();
    //         throw new \Exception($e -> getMessage());
           
    //     }
       
    //     \Session::flash('err_msg','商品を更新しました');
    //     return redirect(route('products'));

        public function exeUpdate(Request $request){
            
            //商品データを受け取る
            $input = $request->all();
            // $image = $request->file('img');
            // $path = \Storage::put('/public',$image);
            $input['image'] = $input['image']->store('public/');
            // $input['image_path'] = $input['image_path']->store('public/stor');
            //商品を更新する
            \DB::beginTransaction();    
            $products = Product::find($input['id']);
            $products->fill([
                'product_name' => $input['product_name'],
                'img_path' => $input['image'],
                'price' => $input['price'],
                'company' => $input['company_id'],
                'stocks' => $input['stock'],
                'comment' => $input['comment'],
            ]);
            
            $products->save();
    
            \DB::commit();
    
            return redirect(route('products'));
        }

    
    /**
     * 商品削除
     * 
     * @param int $id
     * @return view
     */
    public function exeDelete($id)
    {
        if (empty($id)){
            return false;
        }
        try {
            //商品を削除
            Product::destroy($id);
        } catch(\Throwable $e) {
        throw new \Exception($e -> getMessage());
        }

        \Session::flash('err_msg','商品を削除しました');
         return redirect(route('products'));
    }

     
    /**
     * 商品検索
     * 
     * @param int $id
     * @return view
     */
    //find(id)でレコード指定して企業名カラムを抽出する

    // public function search(Request $request){

    //     $product_name = $request -> keyword;
    //     $company = $request -> company; //viewで指定したidを代入する
    //     $price = $request -> price_number;

    //     //idに対応したレコードを取得する
    //     if($company){
    //     $company = companies::find($company);
    //     //$companyに代入したレコードの中のcompany_nameを参照して再代入する
    //     $company = $company -> company_name;
    //     }
    //     //dd($company);

    //         //Productテーブルからクエリを取得
    //         $query = Product::query();
  

    //         //where句で検索結果をproductsに代入
    //         if($product_name or $company){
    //         $products = $query -> where('product_name','like','%'.$product_name.'%')->get();
    //         $products = $query -> where('company','like','%'.$company.'%')->get();
    //         }
    //         //価格の検索条件も加える
    //         if($price){
    //         $products = $query -> where('price', '>=', $price)->get();
    //         }

    //         //list.blade.phpに検索結果を表示
    //         //return view('product.list',['products' => $products],['companies' => companies::all()]);
    //         return response()->json(['data'=>$products]);
            
    // }

}

