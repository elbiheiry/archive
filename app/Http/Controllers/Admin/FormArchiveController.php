<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\FormArchive;
use App\Group;
use App\Http\Requests\FormArchiveRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormArchiveController extends Controller
{
    //
    public function getIndex(){
        if (auth()->guard('admins')->user()->role == 'admin'){
            $archives = FormArchive::get();
        }elseif (auth()->guard('admins')->user()->role == 'senior'){
            $archives = FormArchive::where('category_id' , auth()->guard('admins')->user()->category_id)->get();
        }elseif (auth()->guard('admins')->user()->role == 'user'){
            $archives = FormArchive::where('member_id' , auth()->guard('admins')->user()->id)->get();
        }
        $categories = Category::get();
        $groups = Group::get();

        return view('admin.pages.form_archives.index' ,compact('archives' ,'categories' ,'groups'));
    }

    public function getSingleArchive($id){
        $archive = FormArchive::find($id);
        $categories = Category::get();
        $groups = Group::get();

        return view('admin.pages.form_archives.single' ,compact('archive' ,'categories' ,'groups'));
    }

    public function getEdit($id){
        $archive = FormArchive::find($id);
        $categories = Category::get();
        $groups = Group::get();

        return view('admin.pages.form_archives.edit' ,compact('archive' ,'categories' ,'groups'));
    }

    public function postIndex(FormArchiveRequest $request){
        $request->store();

        return ['status' => 'success' ,'data' => 'تم اضافه الملف بنجاح'];
    }

    public function postEdit(FormArchiveRequest $request , $id){
        $request->edit($id);

        return ['status' => 'success' ,'data' => 'تم تعديل بيانات الملف بنجاح'];
    }

    public function getDelete($id){
        $archive = FormArchive::find($id);

        $destination = storage_path('uploads/archives');
        @unlink($destination . "/{$archive->image}");

        $archive->delete();

        return redirect()->back();
    }
}
