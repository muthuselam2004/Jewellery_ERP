<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingType extends Model
{
    use HasFactory;

    protected $table = 'Manufacturing_Type_Mst';

    protected $fillable = ['Manufacturing_Type'];


}
