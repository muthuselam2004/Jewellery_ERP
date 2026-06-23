<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Details_Model extends Model
{
    use HasFactory;

    protected $table = 'Customer_Details_Mst';

    public $timestamps = false;

    protected $fillable = [
        'Ccode',
        'Lcode',
        'Invoice_No',
        'Date',
        'Customer_Name',
        'Customer_Mobile',
        'Customer_Address',
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
        'Created_By',
        'Created_Time',
        'Updated_By',
        'Updated_Time'
    ];
}
