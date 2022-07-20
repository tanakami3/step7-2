<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\company;
use App\Http\Requests\productRequest;


class productController extends Controller
{
    /**
     * 商品一覧を表示する
     * 
     * @return view
     */
    public function showList(Request $request) {
        $products = Product::all();

        return view('product.list', compact('products'));
    }

    /**
     * 商品詳細画面を表示する
     * @param int $id
     * @return view
     */
    // public function detail($id){
    //     $product = Product::find($id);

    //     if (is_null($product)) {
    //         \Session::flash('err_msg','データがありません。');
    //         return redirect(route('products'));
    //     }

    //     return view('product.detail', ['products' => $products]);
    // }

    public function detail(Request $request) {

        $id = $request->id;
        $products = DB::table('products')->where('id', $id)->get();
        return view('product.detail', ['products'=>$products]);
    }

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

    
}

