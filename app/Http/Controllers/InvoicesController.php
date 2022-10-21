<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoices;
use App\Models\invoices_details;
use App\Models\invoices_attachments;
use App\Models\Sections;
use App\Notifications\Addinvoice;
//use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\addinvoices;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;

class InvoicesController extends Controller
{
    public function index(){
        if(Auth::id()){
            $invoices = Invoices::all();
        return view('invoices.invoices',compact('invoices'));
        }else{
            return redirect('/login');
        }
    }

    public function addinvoices(){

        if(auth::id()){
            $section = sections::all();
            $invoice = Invoices::all();
            return view('invoices.add_invoices',compact('section','invoice'));
        }else{
            return redirect('login');
        }
    }

    public function getproduct($id){

        $status = DB::table("products")->where("section_id",$id)->pluck("product_name","id");
        return json_decode($status);
    }
    public function insrtinvoices(Request $request){
        if(auth::user()->id){
        
            invoices::create([
                'invoice_number' => $request->invoice_number,
                'invoice_Date' => $request->invoice_date,
                'Due_date' => $request->Due_date,
                'product' => $request->product,
                'section_id' => $request->section,
                'Amount_collection' => $request->amount_collection,
                'Amount_Commission' => $request->amount_commission,
                'Discount' => $request->discount,
                'Value_VAT' => $request->value_vat,
                'Rate_VAT' => $request->rate_vat,
                'Total' => $request->total,
                'Status' => 'غير مدفوعة',
                'Value_Status' => 2,
                'note' => $request->note,
            ]);
    
            $invoice_id = invoices::latest()->first()->id;
            invoices_details::create([
                'id_invoices' => $invoice_id,
                'invoices_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->section,
                'Status' => 'غير مدفوعة',
                'Value_Status' => 2,
                'note' => $request->note,
                'user' => (Auth::user()->name),
            ]);

                if($request->hasFile('pic')){
          
                $invoice_id = Invoices::latest()->first()->id;
                $image = $request->file('pic');
                $file_name = $image->getClientOriginalName();
                $invoice_number = $request->invoice_number;

                $attachments = new invoices_attachments;
                $attachments->file_name = $file_name;
                $attachments->invoice_number = $invoice_number;
                $attachments->Created_by = Auth::user()->name;
                $attachments->invoice_id = $invoice_id;
                $attachments->save();

                // move pic
                $imageName = $request->pic->getClientOriginalName();
                $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);

                 }
                    /* $user = User::first();
                    Notification::send($user,new Addinvoice($invoice_id));*/

                    $user = User::get();
                    $invoices = invoices::latest()->first();
                    Notification::send($user, new \App\Notifications\NewAddInvoices($invoices));
                    
                    //event(new MyEventClass('hello world'));
            return redirect('invoices')->with('Add','Invoice added successfly');
   
        }else{
            return redirect('login');
        }
        
    }
    
        public function editinvoice($id){
            
            $invoices = invoices::find($id);
            $section = sections::all();
            return view('invoices.edit_invoices',compact('section','invoices'));
        }
        
        
        public function updateinvoices(Request $request , $id){

            $invoices = invoices::find($id);
           
                $invoices->invoice_number = $request->invoice_number;
                $invoices->invoice_Date = $request->invoice_date;
                $invoices->Due_date = $request->due_date;
                $invoices->product = $request->product;
                $invoices->section_id = $request->section;
                $invoices->Amount_collection = $request->amount_collection;
                $invoices->Amount_Commission = $request->amount_commission;
                $invoices->Discount = $request->discount;
                $invoices->Value_VAT = $request->value_vat;
                $invoices->Rate_VAT = $request->rate_vat;
                $invoices->Total = $request->total;
                $invoices->Status = 'غير مدفوعة';
                $invoices->Value_Status = 2;
                $invoices->note = $request->note;
                if($request->rate_vat !='' && $request->value_vat !='')
                {
                $invoices->save();
                
                return redirect('invoices')->with('Update','Invoices update successfly');
              }else{

                return redirect()->back()->with('error','Enter Rate vat and Value Vat');
              }
        }

        public function deleteinvoice($id){

            $invoice = Invoices::where('id',$id);
            $delete = invoices_attachments::where('invoice_id',$id);

            if(!empty($delete->invoice_number)){

                Storage::disk('public_uploads')->deleteDirectory($delete->invoice_number);
            }

            $invoice->forcedelete();
            return redirect()->back()->with('delete','Invoices deleted successfluy');
        }


        public function invoices_cash()
        {
        
            if(auth::user()->id){
        
            $invoices = invoices::where('Value_Status',1)->get();
            return view('invoices.invoices_cash',compact('invoices'));
        }else{

            return redirect('login');
        }

        }


        public function invoices_unpaid()
        {
        
            if(auth::user()->id){
        
            $invoices = invoices::where('Value_Status',2)->get();
            return view('invoices.invoices_unpaid',compact('invoices'));
        }else{

            return redirect('login');
        }

        }


        public function invoices_partial()
        {
        
            if(auth::user()->id){
        
            $invoices = invoices::where('Value_Status',3)->get();
            return view('invoices.invoices_partial',compact('invoices'));
        }else{

            return redirect('login');
        }


        
        }


        public function invoices_archive()
        {
        
            if(auth::user()->id){
        
            $invoices = invoices::onlyTrashed()->get();
            return view('invoices.invoices_archive',compact('invoices'));
        }else{

            return redirect('login');
        }
        }
    


        public function move_archive($id)
        {
    
            $invoices = invoices::where('id',$id)->first();
            $details = invoices_attachments::where('invoice_id',$id)->first();
           
            $invoices->delete();
            return redirect()->back()->with('Update','Done Move To Archive');
        

        }


        public function restore($id)
        {
            $restore = invoices::withTrashed()->where('id',$id)->restore();
            session()->flash('restore');
            return redirect('invoices_archive');


        }


        public function print_invoice($id)
        {
            $invoice = invoices::where('id',$id)->first();

            return view('invoices.invoice',compact('invoice'));
        }

        public function export() 
        {
            return Excel::download(new InvoicesExport, 'invoice.xlsx');
        }



        public function MarkAsRead_all (Request $request)
        {
    
            $userUnreadNotification= auth()->user()->unreadNotifications;
    
            if($userUnreadNotification) {
                $userUnreadNotification->markAsRead();
                return back();
            }
    
    
        }
    
    
        public function unreadNotifications_count()
    
        {
            return auth()->user()->unreadNotifications->count();
        }
    
        public function unreadNotifications()
    
        {
            foreach (auth()->user()->unreadNotifications as $notification){
    
    return $notification->data['title'];
    
            }
    
        }
    }
