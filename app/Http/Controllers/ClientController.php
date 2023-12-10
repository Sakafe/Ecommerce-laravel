<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
class ClientController extends Controller
{
   public function CategoryPage($id){
    $category = Category::findorFail($id);
    $products = Product :: where('product_category_id',$id)->latest()->get();
    return view('user_template.category',compact('category','products'));
   }
   public function SingleProduct($id){
    $product = product::findorFail($id);
    $subcat_id = Product::where('id',$id)->value('product_subcategory_id');
    $relatedProducts = Product::where('product_subcategory_id',$subcat_id)->latest()->get();
    return view('user_template.product',compact('product','relatedProducts'));
   }
   public function AddToCart(){
    return view('user_template.addtocart');
   }
   public function AddProductToCart(Request $request){
    $productPrice = $request->price;
    $quantity = $request->quantity;
    $price = $productPrice*$quantity;
    Cart::insert([
        "product_id" => $request->product_id,
        "price" => $price,
        "quantity" => $request->quantity,
        "user_id" => Auth::id(),
    ]);
    return redirect()->route('addtocart')->with('message','Your item added to cart successfully!');
   }
   public function CheckOut(){
    return view('user_template.checkout');
   }
   public function UserProfile(){
    return view('user_template.userprofile');
   }
   public function pendingOrder(){
    return view('user_template.pendingorders');
   }
   public function History(){
    return view('user_template.history');
   }
   public function NewRelease(){
    return view('user_template.newrelease');
   }
   public function TodaysDeal(){
    return view('user_template.todaysdeal');
   }
   public function CustomerService(){
    return view('user_template.customerservice');
   }

}
