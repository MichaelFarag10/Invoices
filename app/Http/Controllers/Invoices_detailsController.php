<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoices_details;
use App\Models\Invoices;
use App\Models\invoices_attachments;
use App\Models\Sections;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Invoices_detailsController extends Controller
{
    public function show_details($id)
    {
        
        if(auth::user()->id){
            $invoices = invoices::where('id',$id)->first();
            $details = Invoices_details::where('id_invoices',$id)->get();
            $attachments = invoices_attachments::where('invoice_id',$id)->get();
           /*  $invoices_attach = invoices_attachments::where('invoices','details','attachments')->get(); */
            
           /*  return view('invoices.showdetails',compact('invoices','invoices_details','invoices_attach')); */
           return view('invoices.show_detalis',compact('invoices','details','attachments'));

        }else{

            return redirect('login');
        }
    
    
    }


    public function viewfile($invoice_number, $file_name)
    {
    
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->file($files);
    }

    public function download($invoice_number,$file_name)

    {
        $contents= Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->download( $contents);
    }

    public function deletefile(Request $request){

        $invoices = invoices_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete','Attachments deleted successfly');
        return back();
    }

    public function add_attachment(Request $request){

        $this->validate($request,[
            'file_name' => 'mimes:pdf,jpeg,png,jpg',
            ],[
                'file_name.mimes' => 'Requerd pdf,jpeg,png,jpg'
            ]
        );
        
            $image = $request->file('file_name');
            $file_name = $image->getClientOriginalName();
            $attachments = new invoices_attachments;
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $request->invoice_number;
            $attachments->invoice_id  = $request->invoice_id;
            $attachments->created_by = auth::user()->name;
            $attachments->save();
        
            $imageName = $request->file_name->getClientOriginalName();
            $request->file_name->move(public_path('Attachments/' . $request->invoice_number), $imageName);
            session()->flash('Add','Attachment added successfly');
            return back();

        
    }

    public function show($id){

        $invoices = Invoices::find($id);
        $section = Sections::all();
        return view('invoices.updatestatus',compact('invoices','section'));

    }


    public function updatestauts($id, Request $request)
    {
        $invoices = invoices::findOrFail($id);
        $invoice_id = invoices::latest()->first()->id;
        if ($request->status === 'مدفوعة') {

            $invoices->update([
                'Value_Status' =>1,
                'Status' => $request->status,
                'Payment_Date' => $request->Payment_Date,
            ]);

            invoices_Details::create([
                'id_invoices' => $request->invoice_id,
                'invoices_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->section,
                'status' => $request->status,
                'value_status' => 1,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }

        else {
            $invoices->update([

                'Value_Status' => 3,
                'status' => $request->status,
                'Payment_Date' => $request->Payment_Date,
            ]);
            invoices_Details::create([
                'id_invoices' => $request->invoice_id,
                'invoices_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->section,
                'status' => $request->status,
                'value_status' => 3,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }
       ;
        return redirect('/invoices')->with('Update','Status updated successfly');

    }



    /* public function updatestauts2(Request $request, $id)
    {
        
          if($request->Stuats === "Paid"){
            $invoices->Value_Status = 1;
            $invoices->Status = $request->status;
            $invoices->Payment_Date = $request->Payment_Date;
            $invoices->save();
            
            $details = new invoices_details;
            $details->id_invoices = $request->invoice_id;
            $details->invoices_number = $request->invoice_number;
            $details->product = $request->product;
            $details->section = $request->section;
            $details->status = $request->status;
            $details->value_status = 1;
            $details->note = $request->note;
            $details->Payment_Date = $request->Payment_Date;
            $details->user = auth::user()->name;
            $details->save();
        }else{
            
            $invoices->Value_Status = 3;
            $invoices->Status = $request->status;
            $invoices->Payment_Date = $request->Payment_Date;
            $invoices->save();
            
            $details = new invoices_details;
            $details->id_invoices = $request->invoice_id;
            $details->invoices_number = $request->invoice_number;
            $details->product = $request->product;
            $details->section = $request->section;
            $details->status = $request->status;
            $details->value_status = 1;
            $details->note = $request->note;
            $details->Payment_Date = $request->Payment_Date;
            $details->user = auth::user()->name;
            $details->save();

        }  */
        
            
    }



