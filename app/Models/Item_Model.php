<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_Model extends Model
{
    use HasFactory;

      protected $table = 'Item_Mst'; 

    protected $primaryKey = 'id';  

    protected $fillable = [
        'Ccode',
        'Lcode',
        'Item_Code',
        'Category_Name',
        'Category_Type',
        'Manufacturing_Type',
        'Product_Type',
        'Item',
        'Karat',
        'Purity',
        'Gross_Weight',
        'Stone_Weight',
        'Net_Weight',
        'Jwl_Image',
        'created_at'
    ];



}
