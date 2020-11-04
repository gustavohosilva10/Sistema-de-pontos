<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model{

    protected $fillable = [
        'name',
        'description',
        'points_required',
        'qt_stock',
        'status',
    ];

    public static function getProductsByID($id){
        $products = Products::where('products.id','=',$id)->with('withImagens')->get();
        return $products;
    }

    public static function Products(){
        $products = Products::with('withImagens');
        return $products;
    }

    public function withImagens(){
        return $this->hasMany('App\Models\GalleryProducts','id_product','id');
    }

}
