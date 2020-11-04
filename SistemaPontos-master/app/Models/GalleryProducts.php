<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryProducts extends Model{
    protected $fillable = [
        'id_product',
        'url_img',
    ];
}
