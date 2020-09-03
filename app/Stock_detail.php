<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock_detail extends Model
{
    protected $table='stock_detail';
    protected $fillable=['id_users','id_stock'];
}
