<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction_Model extends Model
{
    use HasFactory;

    protected $table = 'stock_inward_mst';

    public $timestamps = false;

    protected $fillable = [
        'Ccode',
        'Lcode',
        'Inward_No',
        'Inward_Date',
        'Supplier_Code',
        'Supplier_Name',
        'Invoice_No',
        'Location',
        'Received_By',
        'Item_Code',
        'Category_Name',
        'Category_Type',
        'Manufacturing_Type',
        'Product_Type',
        'Item_Name',
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
        'Amount',
        'Quality_Control',
        'Jewellery_Image',
        'Bar_Code',
        'Bar_Code_Number',
        'Created_By',
        'Created_Time',
        'Updated_By',
        'Updated_Time'
    ];
}
