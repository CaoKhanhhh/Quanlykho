<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_detail extends Model
{
    protected $table='product_detail';
    protected $fillable=['id_stock','id_product','number','status'];
}
