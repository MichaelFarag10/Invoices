<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomersReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Invoices_detailsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProcductsController;
use App\Models\invoices_attachments;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Status;
use App\Http\Controllers\InvoicesReportController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

/* Route::post('login',[LoginController::class,'credentials']);

 /* Route::middleware([Status::class])->group(function(){

    Route::get('home', [HomeController::class,'home'])->name('status');

}); */
 Auth::routes(['register'=>false]);
 

Route::get('/home',[HomeController::class,'index'])->name('home');
Route::get('home/{page}',[AdminController::class,'index']);
Route::get('/invoices',[InvoicesController::class,'index']);
Route::get('sections',[SectionsController::class,'index']);
Route::post('addsections',[SectionsController::class,'store']);
Route::get('updatesection/{id}',[SectionsController::class,'updatesection']);
Route::get('deletesection/{id}',[SectionsController::class,'deletesection']);
Route::post('editsection/{id}',[SectionsController::class,'editsection']);
Route::get('products',[ProcductsController::class,"viewproducts"]);
Route::post('addproduct',[ProcductsController::class,'addproduct']);
Route::get('updateproduct/{id}',[ProcductsController::class,'updateproduct']);
Route::post('editproduct/{id}',[ProcductsController::class,'editproduct']);
Route::get('deleteproduct/{id}',[ProcductsController::class,'deleteproduct']);
Route::get('add_invoices',[InvoicesController::class,'addinvoices']);
Route::get('/section/{id}',[InvoicesController::class,'getproduct']);
Route::post('insrtinvoices',[InvoicesController::class,'insrtinvoices']);
Route::get('/invoices_details/{id}',[Invoices_detailsController::class,'show_details']);
Route::get('View_file/{invoice_number}/{file_name}',[Invoices_detailsController::class,'viewfile']);
Route::get('download/{invoice_number}/{file_name}',[Invoices_detailsController::class,'download']);
Route::post('delete_file',[Invoices_detailsController::class,'deletefile'])->name('deletefile');
Route::post('/invoices_attachment',[Invoices_detailsController::class,'add_attachment']);
Route::get('/edit_invoice/{id}',[InvoicesController::class,'editinvoice']);
Route::post('updateinvoices/{id}',[InvoicesController::class,'updateinvoices']);
Route::get('/delete_invoice/{id}',[InvoicesController::class,'deleteinvoice']);
Route::get('status_show/{id}',[Invoices_detailsController::class,'show']);
Route::post('updatestauts/{id}',[Invoices_detailsController::class,'updatestauts']);
Route::get('invoices_cash',[InvoicesController::class,'invoices_cash']);
Route::get('invoices_unpaid',[InvoicesController::class,'invoices_unpaid']);
Route::get('invoices_partial',[InvoicesController::class,'invoices_partial']);
Route::get('invoices_archive',[InvoicesController::class,'invoices_archive']);
Route::get('/move_to_archive/{id}',[InvoicesController::class,'move_archive']);
Route::get('/restore/{id}',[InvoicesController::class,'restore']);
Route::get('/print_invoice/{id}',[InvoicesController::class,'print_invoice']);
Route::get('export_invoices', [InvoicesController::class, 'export']);
Route::get('invoices_report',[InvoicesReportController::class,'index']);
Route::post('Search_invoices', [InvoicesReportController::class,'Search_invoices']);
Route::get('customers_report', [CustomersReportController::class,'index'])->name("customers_report");
Route::post('Search_customers', [CustomersReportController::class,'Search_customers']);



Route::get('MarkAsRead_all',[InvoicesController::class,'MarkAsRead_all'])->name('MarkAsRead_all');

Route::get('unreadNotifications_count', [InvoicesController::class,'unreadNotifications_count'])->name('unreadNotifications_count');

Route::get('unreadNotifications', [InvoicesController::class,'unreadNotifications'])->name('unreadNotifications');



Route::group(['middleware' => ['auth']], function() {

    Route::resource('/roles','App\Http\Controllers\RoleController');
    
    Route::resource('/users','App\Http\Controllers\UserController');
    
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
