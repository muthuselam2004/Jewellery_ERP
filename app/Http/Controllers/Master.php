<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Master_Model;
use App\Models\CategoryType;
use App\Models\Product_Type_Model;
use App\Models\ManufacturingType;
use App\Models\Item_Model;
use App\Models\Supplier_Model;
use App\Models\Current_Rate_Model;


class Master extends Controller
{

    public function index()
    {
        $categories = CategoryType::latest()->get();

        $last = CategoryType::orderBy('id', 'desc')->first();

        if ($last && $last->Cat_Code) {
            $number = (int) substr($last->Cat_Code, 3);
            $number++;
        } else {
            $number = 1;
        }

        $nextCode = 'CAT' . str_pad($number, 3, '0', STR_PAD_LEFT);

        $metalTypes = Master_Model::select('Metel_Type')
            ->distinct()
            ->orderBy('Metel_Type', 'asc')
            ->get();

        // dd($metalTypes);

        return view('Master.Add_Category', compact('categories', 'nextCode', 'metalTypes'));
    }

    public function getByMetal(Request $request)
    {
        $data = CategoryType::where('Metel_Type', $request->Metel_Type)->get();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Cat_Code' => 'required',
            'Metel_Type' => 'required',
            'Category_Type' => [
                'required',
                Rule::unique('Category_Type_Mst')->where(function ($query) use ($request) {
                    return $query->where('Metel_Type', $request->Metel_Type);
                })
            ]
        ], [
            'Category_Type.unique' => 'This Category already exists for selected Metal!'
        ]);

        $Ccode = session('Ccode');
        $Lcode = session('Lcode');

        $metel = Master_Model::where('Metel_Type', $request->Metel_Type)->first();
        $Metel_ID = $metel ? $metel->Metel_ID : null;

        CategoryType::create([
            'Ccode' => $Ccode,
            'Lcode' => $Lcode,
            'Cat_Code' => $request->Cat_Code,
            'Metel_ID' => $Metel_ID,
            'Metel_Type' => $request->Metel_Type,
            'Category_Type' => $request->Category_Type,
        ]);

        return redirect()->route('category.index')
            ->with('success', 'Category Added Successfully');
    }


    public function View_Pro_Type()
    {
        $Pro_Type = Product_Type_Model::latest()->get();

        $last = Product_Type_Model::orderBy('id', 'desc')->first();

        if ($last && $last->Item_Code) {
            $number = (int) substr($last->Item_Code, 4);
            $number++;
        } else {
            $number = 1;
        }

        $nextCode = 'PRO' . str_pad($number, 3, '0', STR_PAD_LEFT);

        $metalTypes = Master_Model::select('Metel_Type')
            ->distinct()
            ->orderBy('Metel_Type', 'asc')
            ->get();

        $manufacturingTypes = ManufacturingType::all();

        return view('Master.Add_Product_Type', compact(
            'Pro_Type',
            'nextCode',
            'metalTypes',
            'manufacturingTypes'
        ));
    }

    public function getCategoryType(Request $request)
    {
        $data = CategoryType::where('Metel_Type', $request->metel)->get();

        return response()->json($data);
    }

    public function getProductByFilter(Request $request)
    {
        $data = Product_Type_Model::where('Category_Name', $request->metal)
            ->where('Category_Type', $request->category)
            ->where('Manufacturing_Type', $request->manufacturing)
            ->get();

        return response()->json($data);
    }

    public function add_pro_type(Request $request)
    {
        $request->validate([
            'Pro_Code' => 'required',
            'Metel_Type' => 'required',
            'Category_Type' => 'required',
            'Manufacturing_Type' => 'required',
            'Pro_Type' => 'required',
        ]);
        $Ccode = session('Ccode');
        $Lcode = session('Lcode');
        $username = session('UserName');
        Product_Type_Model::create([
            'Ccode' => $Ccode,
            'Lcode' => $Lcode,
            'Item_Code' => $request->Pro_Code,
            'Category_Name' => $request->Metel_Type,
            'Category_Type' => $request->Category_Type,
            'Manufacturing_Type' => $request->Manufacturing_Type,
            'Product_Type' => $request->Pro_Type,
            'created_by' => $username,


        ]);

        return redirect()->back()->with('success', 'Product Added Successfully');
    }


    public function View_Item()
    {

        $Item = Item_Model::latest()->get();

        $last = Item_Model::orderBy('id', 'desc')->first();

        if ($last && $last->Item_Code) {
            $number = (int) substr($last->Item_Code, 4);
            $number++;
        } else {
            $number = 1;
        }

        $nextCode = 'ITM' . str_pad($number, 3, '0', STR_PAD_LEFT);

        $metalTypes = Master_Model::select('Metel_Type')
            ->distinct()
            ->orderBy('Metel_Type', 'asc')
            ->get();

        $productTypes = Product_Type_Model::select('Product_Type')
            ->distinct()
            ->orderBy('Product_Type', 'asc')
            ->get();

        $manufacturingTypes = ManufacturingType::all();

        return view('Master.Add_Item', compact(
            'Item',
            'nextCode',
            'metalTypes',
            'manufacturingTypes',
            'productTypes'
        ));
    }

    // Get Product Type 
    public function getProductType(Request $request)
    {
        $data = Product_Type_Model::where('Manufacturing_Type', $request->manufacturing)
            ->get();

        return response()->json($data);
    }

    public function getItemByFilter(Request $request)
    {
        $data = Item_Model::where('Category_Name', $request->metal)
            ->where('Category_Type', $request->category)
            ->where('Manufacturing_Type', $request->manufacturing)
            ->get();

        return response()->json($data);
    }


    public function Add_Item(Request $request)
    {
        $request->validate([
            'Item_Code' => 'required|unique:Item_Mst,Item_Code',
            'Metel_Type' => 'required',
            'Category_Type' => 'required',
            'Manufacturing_Type' => 'required',
            'Product_Type' => 'required',
            'Item' => 'required',
        ]);

        $Ccode = session('Ccode');
        $Lcode = session('Lcode');
        $username = session('UserName');


        $gross = 0;
        $stone = 0;
        $net = 0;


        $filename = null;

        if ($request->hasFile('Jwl_Image')) {

            $image = $request->file('Jwl_Image');

            $filename = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/jewellery'), $filename);
        }

        $karat = $request->Karat;

        // Insert Data
        Item_Model::create([

            'Ccode' => $Ccode,
            'Lcode' => $Lcode,

            'Item_Code' => $request->Item_Code,

            'Category_Name' => $request->Metel_Type,
            'Category_Type' => $request->Category_Type,

            'Manufacturing_Type' => $request->Manufacturing_Type,

            'Product_Type' => $request->Product_Type,

            'Item' => $request->Item,

            'Karat' => $karat,

            'Purity' => $request->Purity,


            'Gross_Weight' => $gross,
            'Stone_Weight' => $stone,
            'Net_Weight' => $net,


            'Jwl_Image' => $filename,


            // 'created_at' => $username,
        ]);

        return redirect()
            ->route('Add_Item.View_Item')
            ->with('success', 'Item Added Successfully ✅');
    }

    // View Supplier
    public function View_Supplier()
    {

        $suppliers = Supplier_Model::latest()->get();

        $last = Supplier_Model::orderBy('id', 'desc')->first();

        if ($last && $last->Supplier_Code) {
            $number = (int) substr($last->Supplier_Code, 4);
            $number++;
        } else {
            $number = 1;
        }

        $nextCode = 'SUP' . str_pad($number, 3, '0', STR_PAD_LEFT);

        $metalTypes = Master_Model::select('Metel_Type')
            ->distinct()
            ->orderBy('Metel_Type', 'asc')
            ->get();

        $productTypes = Product_Type_Model::select('Product_Type')
            ->distinct()
            ->orderBy('Product_Type', 'asc')
            ->get();

        $manufacturingTypes = ManufacturingType::all();

        return view('Master.Add_Supplier', compact(
            'suppliers',
            'nextCode',
            'metalTypes',
            'manufacturingTypes',
            'productTypes'
        ));
    }


    public function Add_Supplier(Request $request)
    {

        $request->validate([
            'supplier_name' => 'required',
            'mobile' => 'required',
            'per_address' => 'required'
        ]);
        $Ccode = session('Ccode');
        $Lcode = session('Lcode');
        $username = session('UserName');

        // dd(session()->all());

        $last = Supplier_Model::orderBy('id', 'desc')->first();

        if ($last && $last->Supplier_Code) {
            $num = (int) substr($last->Supplier_Code, 3);
            $num++;
        } else {
            $num = 1;
        }

        $supplier_code = 'SUP' . str_pad($num, 3, '0', STR_PAD_LEFT);


        Supplier_Model::create([
            'Ccode' => $Ccode,
            'Lcode' => $Lcode,
            'Supplier_Code' => $supplier_code,
            'Supplier_Name' => $request->supplier_name,
            'Company_Name' => $request->company_name,
            'Supplier_Type' => $request->supplier_type,
            'Metal_Type' => $request->metal_type,
            'Status' => $request->status,


            'Mobile' => $request->mobile,
            'Alt_Mobile' => $request->alt_mobile,
            'Email' => $request->email,
            'Contact_Person' => $request->contact_person,


            'Address' => $request->per_address,
            'Alt_Address' => $request->alt_address,
            'City' => $request->city,
            'State' => $request->state,
            'Pincode' => $request->pincode,
            'Country' => $request->country,


            'GST' => $request->gst,
            'Pan_No' => $request->pan,
            'Opening_Balance' => $request->opening_balance,
            'Balance_Type' => $request->balance_type,
            'Credit_Limit' => $request->credit_limit,
            'Payment_Terms' => $request->payment_terms,
            'Bank_Name' => $request->bank_name,
            'Account_No' => $request->account_number,
            'IFSC' => $request->ifsc,
        ]);

        return redirect()->back()->with('success', 'Supplier Saved Successfully');
    }

    public function ChangeStatus(Request $request)
    {
        Supplier_Model::where('id', $request->id)
            ->update(['Status' => $request->status]);

        return response()->json(['success' => true]);
    }

    public function View_Current_Rate()
    {

        return view('Master.Add_Current_Rate');
    }


    public function GetMetalType(Request $request)
    {
        $metals = DB::select("SELECT Metel_ID, Metel_Type FROM Metel_Mst");

        return response()->json($metals);
    }

    public function get_purity_by_metal(Request $request)
    {
        $metal = $request->metal;

        $data = DB::table('Purity_Mst')
            ->where('Metal_Type', $metal)
            ->select('Purity', 'Value')
            ->get();

        return response()->json($data);
    }

    public function Save_Current_Rate(Request $request)
    {
        $Ccode = session('Ccode');
        $Lcode = session('Lcode');
        $username = session('UserName');

        foreach ($request->data as $row) {

            Current_Rate_Model::create([
                'Ccode' => $Ccode,
                'Lcode' => $Lcode,
                'Metal_Type' => $row['Metal_Type'],
                'Purity' => $row['Purity'],
                'Gram' => $row['Gram'],
                'Rate' => str_replace(',', '', $row['Rate']),
                'Date' => \Carbon\Carbon::parse($row['Date'])->format('Y-m-d'),
                'Created_By' => $username,
                'Created_Time' => now(),
                'Updated_By' => '',
                'Updated_Time' => ''
            ]);
        }

        Session::forget('showRatePopup');

        return response()->json([
            'status' => true,
            'message' => 'Multiple Data Saved Successfully',
        ]);
    }


    public function Get_YesterDay_Rate()
    {
        $Ccode = session('Ccode');
        $Lcode = session('Lcode');


        $dates = DB::table('Current_Rate_Mst')
            ->where('Ccode', $Ccode)
            ->where('Lcode', $Lcode)
            ->select('Date')
            ->distinct()
            ->orderBy('Date', 'DESC')
            ->pluck('Date')
            ->values();

        $latest = $dates[0] ?? null;
        $targetDate = $latest;

        if (!$targetDate) {
            return response()->json([
                'date' => null,
                'gold' => null,
                'silver' => null
            ]);
        }


        $rates = DB::table('Current_Rate_Mst')
            ->where('Ccode', $Ccode)
            ->where('Lcode', $Lcode)
            ->where('Date', $targetDate)
            ->whereIn('Metal_Type', ['Gold', 'Silver'])
            ->orderBy('id', 'DESC')
            ->get()
            ->groupBy('Metal_Type');


        $gold = isset($rates['Gold']) ? $rates['Gold']->first() : null;
        $silver = isset($rates['Silver']) ? $rates['Silver']->first() : null;

        return response()->json([
            'date' => $targetDate,
            'gold' => $gold,
            'silver' => $silver
        ]);
    }


    public function Get_Today_Rate()
    {
        $Ccode = session('Ccode');
        $Lcode = session('Lcode');

        $latestDate = DB::table('Current_Rate_Mst')
            ->where('Ccode', $Ccode)
            ->where('Lcode', $Lcode)
            ->max('Date');

        if (!$latestDate) {
            return response()->json([
                'date' => null,
                'gold' => [],
                'silver' => []
            ]);
        }

        $rates = DB::table('Current_Rate_Mst')
            ->where('Ccode', $Ccode)
            ->where('Lcode', $Lcode)
            ->where('Date', $latestDate)
            ->whereIn('Metal_Type', ['Gold', 'Silver'])
            ->orderBy('id', 'DESC')
            ->get()
            ->groupBy('Metal_Type');

        return response()->json([
            'date' => $latestDate,
            'gold' => $rates['Gold'] ?? [],
            'silver' => $rates['Silver'] ?? []
        ]);
    }


}