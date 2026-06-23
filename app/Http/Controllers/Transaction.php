<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction_Model;
use App\Models\Sales_Details_Model;
use App\Models\Profit_Details_Model;
use App\Models\Payment_History_Model;
use App\Models\Customer_Details_Model;
use App\Models\Old_Material_Model;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class Transaction extends Controller
{

    public function View_Stock_Inward()
    {
        $suppliers = DB::select("SELECT Supplier_Code, Supplier_Name 
            FROM Supplier_Mst 
            WHERE Status = 'Active'
        ");

        $last = DB::table('stock_inward_mst')
            ->orderBy('Inward_No', 'desc')
            ->value('Inward_No');

        if ($last) {

            $number = (int) substr($last, 3);
            $nextNumber = $number + 1;
        } else {
            $nextNumber = 1;
        }


        $inward_no = 'INW' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);


        $lastInvoice = DB::table('stock_inward_mst')
            ->selectRaw("MAX(CAST(SUBSTRING(Invoice_No, 4, LEN(Invoice_No)) AS INT)) as max_no")
            ->value('max_no');

        $nextInvoiceNumber = $lastInvoice ? $lastInvoice + 1 : 1;


        $invoice_no = 'INV' . str_pad($nextInvoiceNumber, 3, '0', STR_PAD_LEFT);

        return view('Transaction/Stock_Inward', compact('suppliers', 'inward_no', 'invoice_no'));
    }


    public function Load_Supplieer_Details(Request $request)
    {
        $supplier = DB::select("SELECT Supplier_Name 
            FROM Supplier_Mst 
            WHERE Supplier_Code = ?
        ", [$request->supplier_code]);

        return response()->json($supplier);
    }

    public function View_Stock_Inward_List()
    {
        $inwards = DB::table('stock_inward_mst')
            ->orderBy('id', 'desc')
            ->get();

        return view('Transaction.Stock_Inward_List', compact('inwards'));
    }

    public function Save_Stock_Inward(Request $request)
    {

        $Ccode = session('Ccode');
        $Lcode = session('Lcode');
        $username = session('UserName');

        $items = $request->items;

        if (!$items || count($items) == 0) {
            return back()->with('error', 'No items found!');
        }

        foreach ($items as $key => $item) {

            $barcodeNumber = 'JW' . rand(1000, 9999);

            $fileName = $barcodeNumber . '.png';

            QrCode::format('png')
                ->size(100)
                ->margin(1)
                ->generate(
                    $barcodeNumber,
                    public_path('qrcodes/' . $fileName)
                );

            $imageName = null;

            if ($request->hasFile("items.$key.jewellery_image")) {

                $file = $request->file("items.$key.jewellery_image");

                $imageName = time() . '_' . $key . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads'), $imageName);
            }

            Transaction_Model::create([

                'Ccode' => $Ccode,
                'Lcode' => $Lcode,

                'Inward_No' => $request->inward_no,
                'Inward_Date' => $request->inward_date,

                'Supplier_Code' => $request->supplier_code,
                'Supplier_Name' => $request->supplier_name,

                'Invoice_No' => $request->invoice_no,
                'Location' => $request->location,
                'Received_By' => $request->received_by,

                // Product Details
                'Category_Name' => $item['category_name'],
                'Category_Type' => $item['category_type'],
                'Manufacturing_Type' => $item['manufacturing_type'],
                'Product_Type' => $item['product_type'],
                'Item_Name' => $item['item_name'],

                // Weight Details
                'Gross_Weight' => $item['gross_weight'],
                'Stone_Weight' => $item['stone_weight'],
                'Net_Weight' => $item['net_weight'],

                // Purity
                'Purity_Type' => $item['purity_type'],
                'Purity' => $item['Purity'],

                // Qty
                'Quantity' => $item['qty'],

                // Tax
                'GST' => $item['gst'],
                'SGST' => $item['sgst'],
                'CGST' => $item['cgst'],

                // Charges
                'Wastage' => $item['wastage'],
                'Making_Charges' => $item['making_charges'],
                'Rate' => $item['rate'],
                'Amount' => $item['amount'],

                // QC
                'Quality_Control' => $item['qc'],

                // Image
                'Jewellery_Image' => $imageName,

                // ✅ QR CODE IMAGE
                'Bar_Code' => $fileName,

                // ✅ QR CODE NUMBER
                'Bar_Code_Number' => $barcodeNumber,

                'Created_By' => $username,
                'Created_Time' => now(),

                'Updated_By' => '',
                'Updated_Time' => ''
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Stock Inward Saved Successfully',
        ]);
    }

    public function GetMetalType(Request $request)
    {
        $metals = DB::select("SELECT Metel_ID, Metel_Type FROM Metel_Mst");

        return response()->json($metals);
    }

    public function GetCategoryType(Request $request)
    {
        $metal = $request->metal;

        $categoryTypes = DB::select("SELECT Cat_Code, Category_Type 
        FROM Category_Type_Mst 
        WHERE Metel_Type = ?", [$metal]);

        return response()->json($categoryTypes);
    }

    public function GetManufacturingType()
    {
        $manufacturingTypes = DB::select("SELECT Manufacturing_Type FROM Manufacturing_Type_Mst
    ");

        return response()->json($manufacturingTypes);
    }

    public function GetProductType(Request $request)
    {

        $productTypes = DB::select("SELECT DISTINCT Product_Type FROM Product_Type_Mst");

        return response()->json($productTypes);
    }

    public function GetItems(Request $request)
    {
        $category_name = $request->category_name;
        $category_type = $request->category_type;
        $manufacturing_type = $request->manufacturing_type;
        $product_type = $request->product_type;

        $items = DB::select("SELECT DISTINCT Item 
        FROM Item_Mst
        WHERE Category_Name = '$category_name'
        AND Category_Type = '$category_type'
        AND Manufacturing_Type = '$manufacturing_type'
        AND Product_Type = '$product_type'
    ");

        return response()->json($items);
    }



    public function View_Stock_Purchase()
    {
        $Ccode = session('Ccode');
        $Lcode = session('Lcode');

        $lastInvoice = DB::table('Payment_History_Mst')
            ->where('Ccode', $Ccode)
            ->where('Lcode', $Lcode)
            ->orderBy('id', 'DESC')
            ->first();

        if ($lastInvoice && !empty($lastInvoice->Invoice_No)) {

            $lastNumber = (int) str_replace('INV', '', $lastInvoice->Invoice_No);

            $invoiceNo = 'INV' . ($lastNumber + 1);

        } else {

            $invoiceNo = 'INV1001';
        }

        return view('Transaction.Stock_Purchase', compact('invoiceNo'));
    }
    public function Get_Barcode_Details(Request $request)
    {
        $Ccode = session('Ccode');
        $Lcode = session('Lcode');

        $barcode = $request->barcode;

        $data = DB::table('stock_inward_mst')
            ->where('Ccode', $Ccode)
            ->where('Lcode', $Lcode)
            ->where('Bar_Code_Number', $barcode)
            ->first();

        if ($data) {

            $metal = $data->Category_Name;
            $today = date('Y-m-d');

            $rate = DB::table('Current_Rate_Mst')
                ->where('Ccode', $Ccode)
                ->where('Lcode', $Lcode)
                ->where('Metal_Type', $metal)
                ->whereDate('Date', $today)
                ->value('Rate');

            return response()->json([
                'status' => 1,
                'data' => $data,
                'category_name' => $data->Category_Name,
                'category_type' => $data->Category_Type,
                'manufacturing_type' => $data->Manufacturing_Type,
                'product_type' => $data->Product_Type,
                'current_rate' => $rate,
                'stock_amount' => $data->Amount,
            ]);

        } else {

            return response()->json([
                'status' => 0
            ]);
        }
    }


    public function Save_Sales_Details(Request $request)
    {

        $Ccode = session('Ccode');
        $Lcode = session('Lcode');
        $username = session('UserName');

        $salesAmount = (float) $request->amount;

        $stockAmount = (float) $request->stock_amount;

        $totalProfit = $salesAmount - $stockAmount;

        Sales_Details_Model::create([

            'Ccode' => $Ccode,
            'Lcode' => $Lcode,
            'Invoice_No' => $request->invoice_no,
            'Date' => now()->format('Y-m-d'),
            'Daily_Rate' => $request->current_rate,
            'Category_Name' => $request->category_name,
            'Category_Type' => $request->category_type,
            'Manufacturing_Type' => $request->manufacturing_type,
            'Product_Type' => $request->product_type,
            'Sales_Type' => $request->has('exchange_checkbox') ? 'Old Ornaments' : '',
            'Item' => $request->item_name,
            'Gross_Weight' => $request->gross_weight,
            'Stone_Weight' => $request->stone_weight ?? 0,
            'Net_Weight' => $request->net_weight,
            'Purity_Type' => $request->purity_type,
            'Purity' => $request->purity ?? 0,
            'Quantity' => $request->quantity,
            'Wastage' => $request->wastage,
            'Making_Charges' => $request->making_charges,
            'Rate' => $request->gram,
            'GST' => $request->gst,
            'CGST' => $request->cgst,
            'SGST' => $request->sgst,
            'Total_Amount' => $salesAmount,
            'Created_By' => $username,
            'Created_Time' => now(),
            'Updated_By' => '',
            'Updated_Time' => now(),

        ]);

        Profit_Details_Model::create([

            'Ccode' => $Ccode,
            'Lcode' => $Lcode,
            'Invoice_No' => $request->invoice_no,
            'Date' => now()->format('Y-m-d'),
            'Current_Rate' => $request->current_rate,
            'Category_Name' => $request->category_name,
            'Category_Type' => $request->category_type,
            'Manufacturing_Type' => $request->manufacturing_type,
            'Product_Type' => $request->product_type,
            'Sales_Type' => $request->has('exchange_checkbox') ? 'Old Ornaments' : '',
            'Item' => $request->item_name,
            'Gross_Weight' => $request->gross_weight,
            'Stone_Weight' => $request->stone_weight ?? 0,
            'Net_Weight' => $request->net_weight,
            'Purity_Type' => $request->purity_type,
            'Purity' => $request->purity ?? 0,
            'Quantity' => $request->quantity,
            'Wastage' => $request->wastage,
            'Making_Charges' => $request->making_charges,
            'Rate' => $request->gram,
            'GST' => $request->gst,
            'CGST' => $request->cgst,
            'SGST' => $request->sgst,
            'Total_Amount' => $salesAmount,
            'Total_Profit' => $totalProfit,
            'Created_By' => $username,
            'Created_Time' => now(),
            'Updated_By' => '',
            'Updated_Time' => now(),

        ]);

        $payment = Payment_History_Model::create([

            'Ccode' => $Ccode,
            'Lcode' => $Lcode,
            'Date' => now()->format('Y-m-d'),
            'Customer_Name' => $request->customer_name,
            'Customer_Mobile' => $request->customer_mobile,
            'Customer_Address' => $request->customer_address,
            'Invoice_No' => $request->invoice_no,
            'Category_Name' => $request->category_name,
            'Category_Type' => $request->category_type,
            'Manufacturing_Type' => $request->manufacturing_type,
            'Product_Type' => $request->product_type,
            'Gross_Weight' => $request->gross_weight,
            'Stone_Weight' => $request->stone_weight ?? 0,
            'Net_Weight' => $request->net_weight,
            'Purity_Type' => $request->purity_type,
            'Purity' => $request->purity ?? 0,
            'Quantity' => $request->quantity,
            'Wastage' => $request->wastage,
            'Making_Charges' => $request->making_charges,
            'Rate' => $request->gram,
            'GST' => $request->gst,
            'CGST' => $request->cgst,
            'SGST' => $request->sgst,
            'Total_Amount' => $salesAmount,
            'Received_By' => $username,
            'Payment_Mode' => $request->payment_mode,
            'Payment_Type' => $request->payment_type,
            'Advance_Amount' => $request->advance_amount ?? 0,
            'Paid_Amount' => $request->paid_amount ?? 0,
            'Pending_Amount' => $request->pending_amount ?? 0,
            'Return_Amount' => $request->return_amount ?? 0,
            'Card_Type' => $request->card_type,
            'Card_Number' => $request->card_number,
            'Transaction_ID' => $request->transaction_id,
            'UPI_Mode' => $request->upi_mode,
            'UPI_ID' => $request->upi_id,
            'Bank_Name' => $request->bank_name,
            'Account_Number' => $request->account_number,
            'Transaction_Ref_No' => $request->transaction_ref_no,
            'Cheque_Number' => $request->cheque_number,
            'Cheque_Date' => $request->cheque_date,
            'Payment_Status' => $request->payment_status,
            'Payment_Date' => now(),
            // 'Receipt_Number' => $receiptNo,
            'Created_By' => $username,
            'Created_Time' => now(),
            'Updated_By' => '',
            'Updated_Time' => now()

        ]);

        Customer_Details_Model::create([

            'Ccode' => $Ccode,
            'Lcode' => $Lcode,
            'Invoice_No' => $request->invoice_no,
            'Date' => now()->format('Y-m-d'),
            'Current_Rate' => $request->current_rate,
            'Customer_Name' => $request->customer_name,
            'Customer_Mobile' => $request->customer_mobile,
            'Customer_Address' => $request->customer_address,
            'Category_Name' => $request->category_name,
            'Category_Type' => $request->category_type,
            'Manufacturing_Type' => $request->manufacturing_type,
            'Product_Type' => $request->product_type,
            'Item' => $request->item_name,
            'Gross_Weight' => $request->gross_weight,
            'Stone_Weight' => $request->stone_weight ?? 0,
            'Net_Weight' => $request->net_weight,
            'Purity_Type' => $request->purity_type,
            'Purity' => $request->purity ?? 0,
            'Quantity' => $request->quantity,
            'Wastage' => $request->wastage,
            'Making_Charges' => $request->making_charges,
            'Rate' => $request->gram,
            'GST' => $request->gst,
            'CGST' => $request->cgst,
            'SGST' => $request->sgst,
            'Total_Amount' => $salesAmount,
            'Created_By' => $username,
            'Created_Time' => now(),
            'Updated_By' => '',
            'Updated_Time' => now()

        ]);

        Old_Material_Model::create([

            'Ccode' => $Ccode,
            'Lcode' => $Lcode,
            'Invoice_No' => $request->invoice_no,
            'Date' => now()->format('Y-m-d'),
            'Current_Rate' => $request->current_rate,
            'Customer_Name' => $request->customer_name,
            'Customer_Mobile' => $request->customer_mobile,
            'Customer_Address' => $request->customer_address,
            'Category_Name' => $request->category_name,
            'Category_Type' => $request->category_type,
            'Manufacturing_Type' => $request->manufacturing_type,
            'Product_Type' => $request->product_type,
            'Item' => $request->item_name,
            'Gross_Weight' => $request->gross_weight,
            'Stone_Weight' => $request->stone_weight ?? 0,
            'Net_Weight' => $request->net_weight,
            'Purity_Type' => $request->purity_type,
            'Purity' => $request->purity ?? 0,
            'Quantity' => $request->quantity,
            'Wastage' => $request->wastage,
            'Making_Charges' => $request->making_charges,
            'Rate' => $request->gram,
            'GST' => $request->gst,
            'CGST' => $request->cgst,
            'SGST' => $request->sgst,
            'Total_Amount' => $salesAmount,
            'Created_By' => $username,
            'Created_Time' => now(),
            'Updated_By' => '',
            'Updated_Time' => now()

        ]);

        return response()->json([
            'status' => true,
            'message' => 'Details Saved Successfully',
            'invoice_url' => url('/invoice/' . $payment->id)

        ]);
    }

    public function GenerateInvoice($id)
    {
        $payment = Payment_History_Model::findOrFail($id);

        return view('Transaction.Invoice_Bill', compact('payment'));
    }

}