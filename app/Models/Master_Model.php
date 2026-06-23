<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_Model extends Model
{
    use HasFactory;

    protected $table = 'Metel_Mst';

    protected $fillable = [
        'Ccode',
        'Lcode',
        'Metel_ID',
        'Metel_Type'
    ];
}
