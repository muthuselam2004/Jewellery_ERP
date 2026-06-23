<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Type_Model extends Model
{
    use HasFactory;

    protected $table = 'Product_Type_Mst';

    protected $fillable = [
        'Ccode',
        'Lcode',
        'Item_Code',
        'Category_Name',
        'Category_Type',
        'Manufacturing_Type',
        'Product_Type'
    ];
}
