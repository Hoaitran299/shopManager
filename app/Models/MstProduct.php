<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstProduct extends Model
{
    use HasFactory;
    
    protected $primary = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'mst_product';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'product_name', 'product_image', 'product_price', 'description', 'is_sales'
    ];
}
