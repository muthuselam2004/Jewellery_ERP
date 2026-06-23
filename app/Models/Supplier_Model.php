<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier_Model extends Model
{
    use HasFactory;

    protected $table = 'Supplier_Mst';

    protected $fillable = [
        'Ccode',
        'Lcode',
        'Supplier_Code',
        'Supplier_Name',
        'Company_Name',
        'Supplier_Type',
        'Metal_Type',
        'Status',

        'Mobile',
        'Alt_Mobile',
        'Email',
        'Contact_Person',

        'Address',
        'Alt_Address',
        'City',
        'State',
        'Pincode',
        'Country',

        'GST',
        'Pan_No',
        'Opening_Balance',
        'Balance_Type',
        'Credit_Limit',
        'Payment_Terms',
        'Bank_Name',
        'Account_No',
        'IFSC',
    ];
}
