<?php

namespace App\Http\Controllers;

use App\Models\Caategory;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function category(){
         $categories = Caategory::all();
        return view('category.category',[
            'categories' => $categories,
        ]);
    }

    function add_category(Request $request){
        $request->validate([
            'category_name' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('icon')){
            $photo = $request->icon;
            $extension = $photo->extension();
            $photo_name = Str::lower(str_replace(' ','-', $request->category_name.random_int(100000, 999999).'.'.$extension));
            $photo->move(public_path('uploads/category/'),$photo_name);

            Caategory::insert([
                'category_name' => $request->category_name,
                'icon' => $photo_name,
                'created_at' => Carbon::now(),
            ]);
        }
        else{
            Caategory::insert([
                'category_name' => $request->category_name,
                'created_at' => Carbon::now(),
            ]);
        }
        return back()->with('success', "Category added successfully!!");
    
    }

    function category_delete($id){
        $category_id = Caategory::find($id);
        
        if($category_id->icon == null){

        }else{
            $photo_delete = public_path('uploads/category/'.$category_id->icon);
            unlink($photo_delete);
        }

        $category_id->Delete();
        return back()->with('delete', 'Category deleted!');
    }

    // Subcategory section
    function subcategory(){
        $categories = Caategory::all();
        return view('subcategory.subcategory',[
            'categories' => $categories,
        ]);
    }
 
    function subcategory_store(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ]);

        if(SubCategory ::where('category_id', $request->category_id)->where('subcategory_name',$request->subcategory_name)->exists()){
            return back()->with('exist', 'Subcategory name already exists in this Category');
        }
        else{   
            if($request->hasFile('icon')){
                $photo = $request->icon;
                $extension = $photo->extension();
                $photo_name = Str::lower(str_replace(' ','-', $request->subcategory_name.random_int(100000, 999999).'.'.$extension));
                $photo->move(public_path('uploads/subcategory/'),$photo_name);

                SubCategory::insert([
                    'category_id'=>$request->category_id,
                    'subcategory_name' => $request->subcategory_name,
                    'icon' => $photo_name,
                    'created_at' => Carbon::now(),
                ]);
            }
            else{
                SubCategory::insert([
                    'category_id'=>$request->category_id,
                    'subcategory_name' => $request->subcategory_name,
                    'created_at' => Carbon::now(),
                ]);
            }
            return back()->with('success', "SubCategory added successfully!!");
        }
    }

    function subcategory_delete($id){
        $subcategory_id = SubCategory::find($id);
        
        if($subcategory_id->icon == null){

        }else{
            $photo_delete = public_path('uploads/subcategory/'.$subcategory_id->icon);
            unlink($photo_delete);
        }

        $subcategory_id->Delete();
        return back()->with('delete', 'SubCategory deleted!');
    }
}
