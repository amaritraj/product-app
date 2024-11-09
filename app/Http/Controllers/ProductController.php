<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //This method will show products page
    public function index()
    {
        //$products = Product::orderBy('name','DESC')->get();
        $products = Product::orderBy('name', 'DESC')->simplePaginate(3);
        return view('products.index', compact('products'));
    }

    //This method will show create product page
    public function create()
    {
        return view('products.create');
    }

    //This method will store product
    public function store(Request $request)
    {
        $rules = [
            'product_id' => 'required',
           // 'product_id',
            'name' => 'required',
            'description',
            'price' => 'required|numeric',
            'stock',
        ];

        //image rules
        if ($request->image != "") {
            $rules['image'] = 'image';
        }

       $validator = Validator::make($request->all(), $rules);

       if($validator->fails()){
        return redirect()->route('products.create')->withInput()->withErrors($validator);
       }

       //her we will insert Product in Database
       $product = new Product();
       $product->product_id = $request->product_id;
       $product->name = $request->name;
       $product->description = $request->description;
       $product->price = $request->price;
       $product->stock = $request->stock;
       $product->save();

       if ($request->image != "") {
        //her we will store image
       $image = $request->image;
       $ext = $image->getClientOriginalExtension();
       $imageName = time().'.'.$ext; //Unique Image name

       //Save image to products directory
       $image->move(public_path('uploads/products'), $imageName);

       //Save Image
       $product->image = $imageName;
       $product->save();
       }

       return redirect()->route('products.index')->with('success', 'Product Added Successfully');

    }

    //This method will show edit product page
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    //This method will update product
    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $rules = [
            'product_id' => 'required',
            'name' => 'required',
            'description',
            'price' => 'required|numeric',
            'stock',
        ];
        //image rules
        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }

       //her we will Update Product
        $product->product_id = $request->product_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        if ($request->image != "") {

            //Delete old Image
            File::delete(public_path('uploads/products/'.$product->image));

            //her we will store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext; //Unique Image name

            //Save image to products directory
            $image->move(public_path('uploads/products'), $imageName);

            //Save Image
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }

    //This method will delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        //delate Image
        File::delete(public_path('uploads/products/'.$product->image));

        //delete product from database
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function search(Request $request){

        $search = $request->search;

        $products = Product::where(function($query) use ($search){
            $query->where('name','like',"%$search%")
                ->orWhere('price','like',"%$search%");
        })->get();

        return view('products.search', compact('products','search'));
    }

}
