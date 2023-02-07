<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstCustomer extends Model
{
    use HasFactory;

    protected $table ='mst_customer';
    protected $primary ='customer_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id','customer_name', 'email', 'tel_num','address','is_active'
    ];

}
