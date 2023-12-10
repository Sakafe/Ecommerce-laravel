<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product :: latest()->get();

        return view('admin.allproduct',compact("products"));
       }


       public function AddProduct (){
        $categories = Category :: latest()->get();
        $subcategories = Subcategory :: latest()->get();
        return view('admin.addproduct',compact('categories','subcategories'));
       }

       public function StoreProduct(Request $request){

        $request->validate([
            'product_name' => 'required|unique:products',
            'price' => 'required',
            'quantity' => 'required',
            'product_short_description' => 'required',
            'product_long_description' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $image = $request->file('product_img');
        $image_name = hexdec(uniqid()).".". $image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'),$image_name);
        $image_url = 'upload/'. $image_name;

        $category_id = $request -> product_category_id;
        $subcategory_id = $request -> product_subcategory_id;
        // relational Database
        $category_name = Category::where('id',$category_id)->value('category_name');
        $subcategory_name = SubCategory::where('id',$subcategory_id)->value('subcategory_name');
        // End relational Database

       Product::insert([
        'product_name'=> $request ->product_name,
        'product_short_description'=> $request ->product_short_description,
        'product_long_description'=> $request ->product_long_description,
        'price'=> $request ->price,
        'quantity'=> $request ->quantity,
        'product_category_name'=> $category_name,
        'product_subcategory_name'=> $subcategory_name,
        'product_category_id'=> $request ->product_category_id,
        'product_subcategory_id'=> $request ->product_subcategory_id,
        'product_img'=>$image_url,
        'slug' => strtolower(str_replace(' ','-',$request->product_name))

       ]);

       Category::where('id', $category_id)->increment('product_count',1);
       Subcategory::where('id', $subcategory_id)->increment('product_count',1);

       return redirect()->route('allproduct')->with('message','Product Added Successfully');

       }

       public function EditProductImg($id){
        $productInfo = Product::findorFail($id);
        return view ('admin.editproductimage',compact('productInfo'));
       }
       public function UpdateProductImg(Request $request){
        $request->validate([
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $id = $request->product_id;
        $image = $request->file('product_img');
        $image_name = hexdec(uniqid()).".". $image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'),$image_name);
        $image_url = 'upload/'. $image_name;
        Product::findorFail($id)->update([
            'product_img'=>$image_url,
            'slug' => strtolower(str_replace(' ','-',$request->category_name))
        ]);
        return redirect()->route('allproduct')->with('message','Image Updated Successfully');
       }

       public function Editproduct($id){
        $productallinfo = Product::findorFail($id);
        return view ('admin.editProduct',compact('productallinfo'));
       }
       public function UpdateProduct(Request $request){
        $request->validate([
            'product_name' => 'required|unique:products',
            'price' => 'required',
            'quantity' => 'required',
            'product_short_description' => 'required',
            'product_long_description' => 'required',

        ]);
        $id = $request->product_id;
        Product::findorFail($id)->update([
            'product_name'=> $request ->product_name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'product_short_description' => $request->product_short_description,
            'product_long_description' => $request->product_long_description,
            'slug' => strtolower(str_replace(' ','-',$request->category_name))
        ]);

        return redirect()->route('allproduct')->with('message','Product information Updated Successfully');
       }

       public function Deleteproduct($id){
        $cat_id = Product::where('id',$id)->value('product_category_id');
        $subcat_id = Product::where('id',$id)->value('product_subcategory_id');

        Product::findorFail($id)->delete();

        Category::where('id',$cat_id)->decrement('product_count',1);
        SubCategory::where('id',$subcat_id)->decrement('product_count',1);

        return redirect()->route('allproduct')->with('message','Product Deleted Successfully');
       }
}
