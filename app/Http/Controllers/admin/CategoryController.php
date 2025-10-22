<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function AllCategory()
    {
        $category = Category::all();

        return view('admin.backend.category.all_category', compact('category'));
    }

    //end this section

    public function AddCategory()
    {
        $category = Category::all();
        return view('admin.backend.category.add_category', compact('category'));
    }

    //end section 

    public function StoreCategory(Request $request)
    {

        Category::insert([
            'uni_name' => $request->uni_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->uni_name)),
            'code' => $request->code,

        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    //end section 

    public function EditCategory($id)
    {
        $category = Category::find($id);

        return view('admin.backend.category.edit_category', compact('category'));
    }

    public function UpdateCategory(Request $request)
    {

        $cat_id = $request->cat_id;

        $category = Category::findOrFail($request->cat_id);

        $category->update([
            'uni_name' => $request->uni_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->uni_name)),
            'code' => $request->code,
        ]);

        $notification = [
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.category')->with($notification);
    }

    public function DeleteCategory($id)
    {
        $category = Category::find($id)->delete();

        $notification = array(
            'message' => 'Category Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
