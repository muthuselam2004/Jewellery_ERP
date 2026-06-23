<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_Details_Model extends Model
{
    use HasFactory;

    protected $table = 'Sales_Details_Mst';

    public $timestamps = false;

    protected $fillable = [
        'Ccode',
        'Lcode',
        'Invoice_No',
        'Date',
        'Daily_Rate',
        'Category_Name',
        'Category_Type',
        'Manufacturing_Type',
        'Product_Type',
        'Sales_Type',
        'Item',
        'Gross_Weight',
        'Stone_Weight',
        'Net_Weight',
        'Purity_Type',
        'Purity',
        'Quantity',
        'Rate',
        'Wastage',
        'Making_Charges',
        'GST',
        'CGST',
        'SGST',
        'Total_Amount',
        'Created_By',
        'Created_Time',
        'Updated_By',
        'Updated_Time'
    ];
}
