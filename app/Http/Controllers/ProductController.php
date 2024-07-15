<?php

namespace App\Http\Controllers;

use App\Models\Caategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    function product(){
        $categories = Caategory::all();
        return view('product.product',[
            'categories' => $categories,
        ]);
    }

    
    function getsubcategory(Request $request){
        $str = '<option value="">Select Subcategory</option>';
        $subcategories = SubCategory::where('category_id', $request->category_id)->get();
        foreach($subcategories as $subcategory){
            $str .= '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
        }
        echo $str;
    }

    function product_store(Request $request){
        $request->validate([
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'product_name'=>'required',
            'product_price'=>'required',
            'prev_img'=>'required',
        ]);

        
        $remove = array("@", "!", "#", "(", ")", "*", "/", '"');
        $slug = Str::lower( str_replace( $remove , '-', $request->product_name)).'-'.random_int(500000, 600000);

            $photo = $request->prev_img;
            $extension = $photo->extension();
            $photo_name = Str::lower(str_replace(' ','-', $request->product_name.random_int(100000, 999999).'.'.$extension));
            $photo->move(public_path('uploads/products/'),$photo_name);

            Product::insert([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'short_desp' => $request->short_desp,
                'prev_img' => $photo_name,
                'slug' => $slug,
                'created_at' => Carbon::now(),
            ]);
        return back()->with('success', "Product added successfully!!");
    }

    function all_products(Request $request){
        $data = $request->all();
        $products = Product::where(function($q) use ($data){
            if(!empty($data['search_input']) && $data['search_input'] != '' && $data['search_input'] != 'undefined'){
                $q->where(function($q) use ($data){
                    $q->where('product_name', 'like', '%'.$data['search_input'].'%');
                    $q->orWhere('short_desp', 'like', '%'.$data['search_input'].'%');
                });
            }
        })->paginate(5);
        return view('product.all_products',[
            'products'=>$products,
        ]);
    }

    function edit_product($id){
        $products = Product::find($id);
        $categories = Caategory::all();
        $subcategories = Subcategory::all();
        return view('product.edit_product',[
            'products'=>$products,
            'categories'=>$categories,
            'subcategories'=>$subcategories,
        ]);
    }


    function product_update(Request $request, $id){
        $request->validate([
        'category_id'=>'required',
        'subcategory_id'=>'required',
        'product_name'=>'required',
        'product_price'=>'required',
    ]);
    
    if(!$request->hasFile('prev_img') == ' '){

        Product::find($id)->update([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'product_name'=>$request->product_name,
            'product_price'=>$request->product_price,
            'short_desp'=>$request->short_desp,
            'created_at'=>Carbon::now(),
        ]);
    }
    else{
        
        $prev_img = Product::find($id);
        $product_img = public_path('uploads/products/'.$prev_img->prev_img);
        // echo $product_img;
        unlink($product_img);
            
        
        $photo = $request->prev_img;
        $extension = $photo->extension();
        $photo_name = Str::lower(str_replace(' ','-', $request->product_name.random_int(100000, 999999).'.'.$extension));
        $photo->move(public_path('uploads/products/'),$photo_name);

        Product::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'short_desp' => $request->short_desp,
            'prev_img' => $photo_name,
            'created_at' => Carbon::now(),
        ]);

        }
        return back()->with('success', 'Product updated successfully');
    }

    function delete_product($id){
        $prev_img = Product::find($id);
        $product_img = public_path('uploads/products/'.$prev_img->prev_img);
        unlink($product_img);

        Product::find($id)->delete();
        return back()->with('delete', 'Product deleted!!');
    }

    function purchase($id){
        $transaction = '#'.Str::random(3).random_int(10000000, 99999999);
        $product_name = Product::find($id);
        Transaction::insert([
            'product_name' => $product_name->product_name,
            'customer_name' => Auth::user()->name,
            'transaction_no' => $transaction,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Product purchased successfully!');
    }

    function transaction_list(Request $request){
        $data = $request->all();
        $transactions = Transaction::where('customer_name', Auth::user()->name)->where(function($q) use ($data){
            if(!empty($data['search_input']) && $data['search_input'] != '' && $data['search_input'] != 'undefined'){
                $q->where(function($q) use ($data){
                    $q->where('product_name', 'like', '%'.$data['search_input'].'%');
                    $q->orWhere('customer_name', 'like', '%'.$data['search_input'].'%');
                });
            }
        })->paginate(5);

        
        $admin_transactions = Transaction::where(function($q) use ($data){
            if(!empty($data['search_input']) && $data['search_input'] != '' && $data['search_input'] != 'undefined'){
                $q->where(function($q) use ($data){
                    $q->where('product_name', 'like', '%'.$data['search_input'].'%');
                    $q->orWhere('customer_name', 'like', '%'.$data['search_input'].'%');
                });
            }
        })->paginate(5);

        return view('dashboard.transaction',[
            'transactions'=>$transactions,
            'admin_transactions'=>$admin_transactions,
        ]);
    }

    function delete_transaction($id){
        Transaction::find($id)->delete();
        return back()->with('delete', 'Transaction deleted!!');

    }
}
