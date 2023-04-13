<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\company;
use Illuminate\Support\Facades\DB;

class product extends Model
{
    protected $table = 'products';

    //可変項目
    protected $fillable = 
    [   
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ];

    public function company() {
        return $this->belongsTo('App\Models\company');
    }

    public function getProducts() {
        
        $query = DB::table("products")
        ->select("products.id","products.updated_at","products.product_name","products.img_path","products.price","products.stock","products.comment","companies.company_name")
        ->join("companies", "products.company_id", "=", "companies.id");
       
        return $query;
    }

    public function getOneDate($id) {

        $product = Product::find($id);

        return $product;
    }

   public function updateProduct($input){

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

    }


    public function destroyProduct($id){
        //商品を削除
        $delete = Product::destroy($id);
     
        return $delete;
    }


    // public $sortable = [
    //     'id',
    //     'img_path',
    //     'product_name',
    //     'price',
    //     'stocks',
    //     'company',
    //     'comment'
    // ];
 }
    
