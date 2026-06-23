<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    use HasFactory;

    protected $table = 'Category_Type_Mst';

    protected $fillable = [
        'Ccode',
        'Lcode',
        'Cat_Code',
        'Metel_ID',
        'Metel_Type',
        'Category_Type'
    ];

}
