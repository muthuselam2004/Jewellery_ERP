<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Dashborad;
use App\Http\Controllers\Master;
use App\Http\Controllers\Transaction;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;


Route::get('/', [Authentication::class, 'index']);

Route::post('/auth/verify', [Authentication::class, 'verify'])->name('auth.verify');

Route::post('/logout', [Authentication::class, 'logout'])->name('logout');

Route::get('/dashboard', [Dashborad::class, 'index'])->name('dashboard');

Route::get('/category', [Master::class, 'index'])->name('category.index');

Route::post('/category_store', [Master::class, 'store'])->name('category.store');

Route::get('/get-category-by-metal', [Master::class, 'getByMetal'])->name('category.byMetal');

Route::get('/Product_Type', [Master::class, 'View_Pro_Type'])->name('Product_Type.View_Pro_Type');

Route::get('/get_category_type', [Master::class, 'getCategoryType']);

Route::get('/get-product-by-filter', [Master::class, 'getProductByFilter']);

Route::post('/Add_Pro_Type', [Master::class, 'add_pro_type'])->name('Add_Pro_Type.Add_Pro_Type');

Route::get('/Item', [Master::class, 'View_Item'])->name('Item.View_Item');

Route::get('/get-item-by-filter', [Master::class, 'getItemByFilter']);

//get the product type
Route::get('/get_product_type', [Master::class, 'getProductType']);

Route::post('/Add_Item', [Master::class, 'Add_Item'])->name('Add_Item.Add_Item');

Route::get('/Add_Item', [Master::class, 'View_Item'])->name('Add_Item.View_Item');

// View Supplier 
Route::get('/View_Supplier', [Master::class, 'View_Supplier'])->name('Supplier.View_Supplier');

Route::post('/Add_Supplier', [Master::class, 'Add_Supplier'])->name('Supplier.Add_Supplier');

Route::post('/supplier/change-status', [Master::class, 'ChangeStatus'])->name('Supplier.ChangeStatus');

// View Stock Inward
Route::get('/Stock_Inward', [Transaction::class, 'View_Stock_Inward_List'])->name('Stock.Stock_Inward');

Route::get('/get-supplier', [Transaction::class, 'Load_Supplieer_Details']);

Route::get('/stock-inward', [Transaction::class, 'View_Stock_Inward'])->name('stock.inward');

Route::post('/Save_Stock_Inward', [Transaction::class, 'Save_Stock_Inward'])->name('Save_Stock_Inward');

Route::get('/get-metal-type', [Transaction::class, 'GetMetalType']);

Route::get('/get-category-type', [Transaction::class, 'GetCategoryType']);

Route::get('/get-manufacturing-type', [Transaction::class, 'GetManufacturingType']);

Route::get('/get-product-type', [Transaction::class, 'GetProductType']);

Route::get('/get-items', [Transaction::class, 'GetItems']);

Route::get('/generate-barcode/{code}', function ($code) {
    $barcode = DNS1D::getBarcodePNG($code, 'C128');
    return response(base64_decode($barcode))
        ->header('Content-Type', 'image/png');
});

// Add Current Rate

Route::get('/Add_Current_Rate', [Master::class, 'View_Current_Rate'])->name('Current_Rate.View_Current_Rate');

Route::get('/get_purity_by_metal', [Master::class, 'get_purity_by_metal']);

Route::post('/Save_Current_Rate', [Master::class, 'Save_Current_Rate'])->name('Save_Current_Rate');

Route::get('/get_current_rate_list', [Master::class, 'Get_YesterDay_Rate']);

Route::get('/get-today-rate', [Master::class, 'Get_Today_Rate']);

// Stock Purchases


// ROUTE
Route::get('/Stock_Purchase', [Transaction::class, 'View_Stock_Purchase'])->name('Stock.Stock_Purchase');

Route::get('/get_barcode_details', [Transaction::class, 'Get_Barcode_Details']);

Route::post('/save-sales-details', [Transaction::class, 'Save_Sales_Details']);

Route::get('/invoice/{id}', [Transaction::class, 'GenerateInvoice']);













