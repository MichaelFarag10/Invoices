<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Sections;
use Illuminate\Routing\ViewController;
use Illuminate\Support\Facades\Auth;
use Livewire\Commands\CpCommand;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class ProcductsController extends Controller
{
    
    public function viewproducts(){
        
        if(auth::user()->id){
            $data= sections::all();
            $product= Products::all();
            return view('products.products',compact('data','product'));
        }else{
            return redirect('/login');
        }
    }

    public function addproduct(Request $request){
        if(auth::user()->id){

            $product = new Products;
            $data = new sections;
             $product->product_name = $request->product_name;
             $product->section_id  = $request->section_id;
             $product->description = $request->description;

             if(Products::where('product_name',$request->product_name)->exists()){

                return redirect()->back()->with('error',"This product is already exists");
             }else{
                 $product->save();
                 return redirect()->back()->with('addproduct','Product added successfly');
             } 
             
        }
    
    }

    public function updateproduct($id){
        if(auth::id()){
        $products = Products::find($id);
        $data = sections::all();
        return view('products.updateproduct',compact('products','data'));
        }else{
            return redirect('login');
        }
    }
    public function editproduct(Request $request , $id){

        if(auth::id()){
             $data = Products::find($id);   
              $data->product_name = $request->product_name;
              $data->description = $request->description;
              $data->section_id = $request->section_id;
              if(Products::where('product_name',$request->product_name)->exists()){

                    return redirect()->back()->with('Error','The product is aready exists');
              }else{
                  
                $data->save();
                return redirect()->back()->with('Update','Product updated successfliy');
              }

        }else{
            return redirect('login');
        }
    }

    public function deleteproduct($id){

        $data = Products::find($id);
        $data->delete();
        return redirect()->back()->with('DeleteProduct','Product deleted successsfly');
    }
}
