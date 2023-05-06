<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\company;
use App\Models\sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\productRequest;
use Illuminate\Support\Str;

class salesController extends Controller
{
    //購入機能
    public function salesAdd(Request $request){


        DB::beginTransaction();

    try {
        //saleテーブルに購入対象のproduct_idを追加
        $id = $request->id;

        
        $products = Product::find($id);
        $stock = $products->stock;
        if($stock>=0){
            $stock = $stock-1;

            $products->fill([
                'stock' => $stock,
            ]);
            $products->save();
        }else{
            return redirect(route('product'))->with('errorMessage', '購入に失敗しました。');;
        }

        //dd($id);
        sale::create([
            'product_id' => $id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //$id = $request->id;
        
        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return back();
    }
        

        return redirect(route('product'));
    }
}
