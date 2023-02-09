<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    protected $table = 'companies';
    //
    protected $fillable = 
    [
        'company_name',
        'street_address',
        'representative_name',
    ];

    public function companyInfo(){
        $company_info = \DB::table('companies');

        $company_info = $company_info;
        return $company_info;
    }
    // /**
    //  * リレーション組み
    //  * NOTE：会社は複数の商品を持つ
    //  *
    //  * @return void
    //  */
    // public function products() {
    //     return $this->hasMany('App\Models\Product');
    // }

    //  /**
    //  * companyデータ取得
    //  * 
    //  * @return  $company
    //  */
    // public function companyInfo() {
    //     // companiesテーブルの中から、'id'カラムと'company_name'カラムをselect文で取得
    //     $company = DB::table('companies')
    //         ->select(
    //             'id',
    //             'company_name',
    //         )
    //         ->orderBy('id', 'asc')
    //         ->get();
        
    //     return $company;
    // }
}
