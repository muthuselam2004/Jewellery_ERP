<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_History_Model extends Model
{
    use HasFactory;

    protected $table = 'Payment_History_Mst';

    public $timestamps = false;

    protected $fillable = [
        'Ccode',
        'Lcode',
        'Date',
        'Customer_Name',
        'Customer_Mobile',
        'Customer_Address',
        'Category_Name',
        'Category_Type',
        'Manufacturing_Type',
        'Product_Type',
        'Item_Code',
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
        'Invoice_No',
        'Received_By',
        'Card_Type',
        'Card_Number',
        'Transaction_ID',
        'UPI_Mode',
        'UPI_ID',
        'Payment_Mode',
        'Bank_Name',
        'Account_Number',
        'Transaction_Ref_No',
        'Cheque_Number',
        'Cheque_Date',
        'Payment_Type',
        'Advance_Amount',
        'Paid_Amount',
        'Pending_Amount',
        'Return_Amount',
        'Payment_Status',
        'Payment_Date',
        'Receipt_Number',
        'Created_By',
        'Created_Time',
        'Updated_By',
        'Updated_Time'
    ];
}
