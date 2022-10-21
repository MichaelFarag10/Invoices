<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sections;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    public function index(){
        $data = sections::all();
        if(Auth::id()){
            return view('sections.sections',compact('data'));
        }else{

            return redirect('/login');
        }
    }
   
    public function store(Request $request)
    {
        $data = new sections;
        $data->section_name = $request->section_name;
        $data->discription = $request->discription;
        $data->created_by = Auth::user()->name;
        if(sections::where('section_name',$request->section_name)->exists()){
            return redirect()->back()->with('Error','This section is aready exists');
        }else{
            $data->save();
            return redirect()->back()->with('Add','Section added successfly');       
            
        }
        }

        public function updatesection($id){
            if(auth::user()->id){
            $data =sections::find($id);
            return view('sections.updatesection',compact('data'));
         }else{
             return redirect('/login');
         }

        }

        public function deletesection($id){
              if(Auth::user()->id){  
       
              $deletesection = sections::find($id);
            $deletesection->delete();
            return redirect()->back()->with('deletesection','Opration deleted');
        }else{
            return redirect('/login');
        }
        
    }

        public function editsection(Request $request,$id){
            if(Auth::user()->id){
            /*     $id = $request->id;
                $this-> validate($request,[
                       'section_name' => 'required|unique:sections,section_name', 
                        'discription' => 'required'
                ],[
                    'section_name.unique' => 'The section required unique',
                    'discription.required' =>'The discription is required'
                ]); */

            $data = sections::find($id);
            $data->section_name = $request->section_name;
            $data->discription = $request->discription;
            $data->created_by = Auth::user()->name;
            if(sections::where('section_name',$request->section_name)->exists()){
                return redirect()->back()->with('Error','This section is aready exists');
            }else{
                $data->save();
                return redirect('/sections')->with('update','Section updated successfly');
                
                
            }
    }else{

        return redirect('/login');
    }

 }
}
