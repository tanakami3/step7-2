<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    // /**
    //  * 
    //  * @return $sql
    //  */
    // public function joinAndSelect() {
    //     // productsテーブルに対して
    //     $sql = DB::table('products')
    //         // companiesテーブルをくっつけます。
    //         ->join('companies', 'products.company_id', '=', 'companies.id')
    //         // select文を使って、2つのテーブルから欲しいカラムを選択します
    //         ->select(
    //             'products.id',
    //             'products.image',
    //             'products.product_name',
    //             'products.price',
    //             'products.stock',
    //             'products.comment',
    //             'companies.company_name',
    //         );

    //     // オブジェクトとして使えるようにします
    //     return $sql;
    // }
    // public function list() {
    //     $list  = \DB::table('products');
    //     $list->select('products.id', 'products.image', 'products.product_name', 'products.stock', 'companies.company_name');
    //     $list->join('companies', 'products.company_id', '=', 'companies.id');
    //     return $list;
    // }

     /**
     * 一覧表示用のデータ
     *
     * @return $list
     */
    // public function list() {
    //     $list = $this->joinAndSelect()

    //         // orderByを使って、productsテーブルのselect文で選んだデータを、idの降順で並び替えます
    //         ->orderBy('products.id', 'desc')

    //         // １ページ最大5件になるようにページネーション機能を使います
    //         // '/resources/views/product/lineup.blade.php'にもページネーションに関する記述をお忘れなく！
    //         ->paginate(5);

    //     return $list;
    // }

    // /**
    //  * 検索機能
    //  * 
    //  * @param [type] $keyword
    //  * @param [type] $company_name
    //  * @return $result
    //  */
    // public function searchProductByParams($keyword, $company_name) {
    //     $query = $this->joinAndSelect();

    //     if (!empty($keyword)) {
    //         $query->where('products.product_name', 'LIKE', '%'.$keyword.'%');
    //     }
    //     if (!empty($company_name)) {
    //         $query->where('products.company_id', $company_name);
    //     }
    //     if (!empty($keyword) && !empty($company_name)) {
    //         $query->where('products.product_name', 'LIKE', '%'.$keyword.'%')
    //             ->where('products.company_id', $company_name);
    //     }

    //     $result = $query->orderBy('products.id', 'desc')
    //         // １ページ最大5件表示になるように、ページネーションします
    //         ->paginate(5);

    //     return $result;
    // }


}
