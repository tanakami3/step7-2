<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\company;
use App\Http\Requests\productRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\sale;


class productController extends Controller
{
    /**
     * 商品一覧を表示する
     * 
     * @param Request $request
     * @return view
     */

 
    public function showList(Request $request)
    {
        $product_model = new product();
        $query = $product_model->getProducts();
        
        $keyword = $request->input('keyword');
        $company_id = $request->input('company_id');
        
        // 商品名検索    
        if (isset($keyword)) {
            $query->where("product_name", "LIKE", "%" . $keyword . "%");
        }
    
        // 企業ID検索
        if (isset($company_id)) {
            $query->where("company_id", "=", $company_id);
        }
    
        $query = $query->get();
        return view('product.list', [
            'products' => $query,
            'companies' => Company::all(),
        ]);
        
    }

    //検索機能（非同期）
    public function search(Request $request)
    { 
       
        $product_model = new product();
        $query = $product_model->getProducts();
        
        $keyword = $request -> input('keyword');
        $company_id = $request -> input('company_id');
        $upLimitPrice = $request -> input('upLimitPrice');
        $lowLimitPrice = $request -> input('lowLimitPrice');
        $upLimitStock = $request -> input('upLimitStock');
        $lowLimitStock = $request -> input('lowLimitStock');
        
        // 商品名検索    
        if (isset($keyword)) {
            $query->where("product_name", "LIKE", "%" . $keyword . "%");
        }
    
        // 企業ID検索
        if (isset($company_id)) {
            $query->where("company_id", "=", $company_id);
        }

        //価格の検索条件も加える
        if ($upLimitPrice or $lowLimitPrice){
           $query -> wherebetween('price',[$lowLimitPrice,$upLimitPrice]);
        }

        if($upLimitStock or $lowLimitStock) {
           $query -> wherebetween('stock',[$lowLimitStock,$upLimitStock]);
        }

        $query = $query->get();
        // dd($query);
        foreach($query as $data){
            $data -> img_path = Storage::url($data->img_path);
        }

        foreach($query as $data){
            $data -> detail_url = Route('detail', ['id'=>$data->id]);
        }


        // Log::info($query);
        return response()->json(['data'=>$query]);
       
    }


    /**
     * 商品詳細画面を表示する
     * @param int $id
     * @return view
     */
    public function showDetail($id)
    {
        // $product = Product::find($id);
        $product_model = new product();
        $product_date = $product_model->getOneDate($id);

        if (is_null($product_date)) {
            \Session::flash('err_msg','データがありません。');
            return redirect(route('products'));
        }

        return view('product.detail', ['product' => $product_date]);
    }

    /**
     * 商品登録画面を表示する
     * 
     * @return view
     */
    public function showCreate() 
    {
        $company_date = new company();
        $company_name = $company_date->companyInfo()->get();

        // $company_name = \DB::table('companies')->get();
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
        $inputs['img_path'] = $inputs['image']->store('public');

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
        // $company_name = \DB::table('companies')->get();
        $company_date = new company();
        $company_name = $company_date->companyInfo()->get();

        // $product = Product::find($id);
        $product_model = new product();
        $product_date = $product_model->getOneDate($id);

        if (is_null($product_date)) {
            \Session::flash('err_msg','データがありません。');
            return redirect(route('products'));
        }

        return view('product.edit',compact('product_date','company_name'));
    }

    /**
     * 商品を更新する
     * 
     * @return view
     */
    public function exeUpdate(Request $request)
    {
        //商品データを受け取る
        $input = $request->all();          
        $input['image'] = $input['image']->store('public');
        
        \DB::beginTransaction();   
        try {
            $product_model = new product();
            $product_model->updateProduct($input);
        
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            throw new \Exception($e -> getMessage());
            
        }
        return redirect(route('products'));
    }

    
    /**
     * 商品削除
     * 
     * @param int $id
     * @return view
     */
    public function exeDelete(Request $request)
    {
        Log::info($request->id);
        try {
            //商品を削除
            // Product::destroy($id);
            $product_model = new product();
            $destroy = $product_model->destroyProduct($request->id);
            Log::info($request->id);
            

        } catch(\Throwable $e) {
        throw new \Exception($e -> getMessage());
        }
        
        \Session::flash('err_msg','商品を削除しました');
        return response()->json(['data' => "成功"]);
        // return redirect(route('products'));
        
         
    }

}

