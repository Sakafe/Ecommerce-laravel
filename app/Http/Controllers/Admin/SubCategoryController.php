<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Subcategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(){
        $allsubcategories = Subcategory::latest()->get();
        return view('admin.allsubcategory',compact('allsubcategories'));
       }


       public function AddSubCategory (){
        $categories = Category::latest()->get();
        return view('admin.addsubcategory',compact('categories'));
       }

       public function storesubcategory(Request $request){
        $request->validate([
            'subcategory_name' => 'required|unique:subcategories',
            'category_id' => 'required'

        ]);

        $category_id = $request -> category_id;
        // relational Database
        $category_name = Category::where('id',$category_id)->value('category_name');
        // End relational Database
        Subcategory::insert([
            'subcategory_name'=> $request ->subcategory_name,
            'slug' => strtolower(str_replace(' ','-',$request->subcategory_name)),
            'category_id' => $category_id,
            'category_name' => $category_name,
        ]);
        Category::where('id', $category_id)->increment('subcategory_count',1);
        return redirect()->route('allsubcategory')->with('message','SubCategory Added Successfully');

       }

       public function editsubcat($id){
        $subcategory_info = Subcategory::findOrFail($id);
        return view('admin.editsubcategory', compact('subcategory_info'));
       }

       public function updatesubcategory(Request $request){
        $request->validate([
            'subcategory_name' => 'required|unique:subcategories'

        ]);
        $subcategoryId = $request->subcat_id;
        Subcategory::findOrFail($subcategoryId)->update([
            'subcategory_name'=> $request ->subcategory_name,
            'slug' => strtolower(str_replace(' ','-',$request->category_name))

        ]);
        return redirect()->route('allsubcategory')->with('message','Sub Category Updated Successfully');
       }

       public function deletesubcat($id){
        $cat_id = Subcategory::where('id',$id)->value('category_id');
         Subcategory::findorFail($id)->delete();
         Category::where('id',$cat_id)->decrement('subcategory_count',1);
         return redirect()->route('allsubcategory')->with('message','Sub Category Deleted Successfully');

       }
}
