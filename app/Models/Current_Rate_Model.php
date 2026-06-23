<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Current_Rate_Model extends Model
{
    use HasFactory;

    protected $table = 'Current_Rate_Mst';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'Ccode',
        'Lcode',
        'Metal_Type',
        'Purity',
        'Gram',
        'Rate',
        'Date',
        'Created_By',
        'Created_Time',
        'Updated_By',
        'Updated_Time'
    ];


}
