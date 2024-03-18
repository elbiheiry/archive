<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Group;
use App\Http\Requests\ImageArchiveRequest;
use App\ImageArchive;
use App\ImageArchiveFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageArchiveController extends Controller
{
    //
    public function getIndex(){
        if (auth()->guard('admins')->user()->role == 'admin'){
            $archives = ImageArchive::get();
        }elseif (auth()->guard('admins')->user()->role == 'senior'){
            $archives = ImageArchive::where('category_id' , auth()->guard('admins')->user()->category_id)->get();
        }elseif (auth()->guard('admins')->user()->role == 'user'){
            $archives = ImageArchive::where('member_id' , auth()->guard('admins')->user()->id)->get();
        }
        $categories = Category::get();
        $groups = Group::get();

        return view('admin.pages.image_archives.index' ,compact('archives' ,'categories' ,'groups'));
    }

    public function getSingleArchive($id){
        $archive = ImageArchive::find($id);
        $categories = Category::get();
        $groups = Group::get();

        return view('admin.pages.image_archives.single' ,compact('archive' ,'categories' ,'groups'));
    }

    public function getEdit($id){
        $archive = ImageArchive::find($id);
        $categories = Category::get();
        $groups = Group::get();

        return view('admin.pages.image_archives.edit' ,compact('archive' ,'categories' ,'groups'));
    }

    public function postIndex(ImageArchiveRequest $request){
        $request->store();

        return ['status' => 'success' ,'data' => 'تم اضافه الملف بنجاح'];
    }

    public function postEdit(ImageArchiveRequest $request , $id){
        $request->edit($id);

        return ['status' => 'success' ,'data' => 'تم تعديل بيانات الملف بنجاح'];
    }

    public function getDelete($id){
        $archive = ImageArchive::find($id);

        $destination = storage_path('uploads/archives');
        @unlink($destination . "/{$archive->image}");

        $archive->delete();

        return redirect()->back();
    }

    public function getDeleteFile(Request $request , $id)
    {
        $file = ImageArchiveFile::find($id);

        @unlink(storage_path('uploads/archives/').$file->image);

        $file->delete();

        return redirect()->back();
    }
}
