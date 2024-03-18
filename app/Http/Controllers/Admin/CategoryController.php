<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    //
    public function getIndex(){
        $categories = Category::get();

        return view('admin.pages.categories.index' ,compact('categories'));
    }

    public function postIndex(CategoryRequest $request){
        $request->store();

        return ['status' => 'success' ,'data' => 'تم اضافه القسم بنجاح'];
    }

    public function postEdit(CategoryRequest $request ,$id){
        $request->edit($id);

        return redirect()->back();
    }

    public function getDelete($id){
        $category = Category::find($id);

        $category->delete();

        return redirect()->back();
    }
}
