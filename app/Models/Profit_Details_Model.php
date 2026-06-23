<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profit_Details_Model extends Model
{
    use HasFactory;

    protected $table = 'Profit_Details_Mst';

    public $timestamps = false;

    protected $fillable = [
        'Ccode',
        'Lcode',
        'Invoice_No',
        'Date',
        'Current_Rate',
        'Category_Name',
        'Category_Type',
        'Manufacturing_Type',
        'Product_Type',
        'Item',
        'Gross_Weight',
        'Stone_Weight',
        'Net_Weight',
        'Purity_Type',
        'Purity',
        'Quantity',
        'Wastage',
        'Making_Charges',
        'Rate',
        'GST',
        'CGST',
        'SGST',
        'Total_Amount',
        'Total_Profit',
        'Created_By',
        'Created_Time',
        'Updated_By',
        'Updated_Time'
    ];
}
