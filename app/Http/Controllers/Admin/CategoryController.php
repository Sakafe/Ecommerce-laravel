<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('admin.allcategory',compact('categories'));
       }


       public function AddCategory (){
        return view('admin.addcategory');
       }

       public function storeCategory(Request $request){
        $request->validate([
            'category_name' => 'required|unique:categories'

        ]);
        Category::insert([
            'category_name'=> $request ->category_name,
            'slug' => strtolower(str_replace(' ','-',$request->category_name))
        ]);
        return redirect()->route('allcategory')->with('message','Category Added Successfully');
       }

       public function editCategory($id){
        $category_info = Category::findOrFail($id);
        return view('admin.editcategory', compact('category_info'));

       }
       public function updatecategory(Request $request){
        $request->validate([
            'category_name' => 'required|unique:categories'

        ]);


        $categoryId = $request->category_id;
        Category::findOrFail($categoryId)->update([
            'category_name'=> $request ->category_name,
            'slug' => strtolower(str_replace(' ','-',$request->category_name))

        ]);
        return redirect()->route('allcategory')->with('message','Category Updated Successfully');

       }

       public function deletecategory($id){
        Category::findOrFail($id)->delete();
        return redirect()->route('allcategory')->with('message','Category Deleted Successfully');
       }
}
