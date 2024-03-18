<?php

namespace App\Http\Controllers\Admin;

use App\ArchiveFile;
use App\Category;
use App\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Archive;
use App\Http\Requests\ArchiveRequest;

class ArchiveController extends Controller
{
    //
    public function getIndex(){
        if (auth()->guard('admins')->user()->role == 'admin'){
            $archives = Archive::where('from_to' ,'to')->get();
        }elseif (auth()->guard('admins')->user()->role == 'senior'){
            $archives = Archive::where('from_to' ,'to')->where('category_id' , auth()->guard('admins')->user()->category_id)->get();
        }elseif (auth()->guard('admins')->user()->role == 'user'){
            $archives = Archive::where('from_to' ,'to')->where('member_id' , auth()->guard('admins')->user()->id)->get();
        }
        $categories = Category::get();
        $groups = Group::get();

        return view('admin.pages.archives.to' ,compact('archives' ,'categories' ,'groups'));
    }

    public function getIndex1(){
        if (auth()->guard('admins')->user()->role == 'admin'){
            $archives = Archive::where('from_to' ,'from')->get();
        }elseif (auth()->guard('admins')->user()->role == 'senior'){
            $archives = Archive::where('from_to' ,'from')->where('category_id' , auth()->guard('admins')->user()->category_id)->get();
        }elseif (auth()->guard('admins')->user()->role == 'user'){
            $archives = Archive::where('from_to' ,'from')->where('member_id' , auth()->guard('admins')->user()->id)->get();
        }
        $categories = Category::get();
        $groups = Group::get();

        return view('admin.pages.archives.from' ,compact('archives' ,'categories' ,'groups'));
    }

    public function getSingleArchive($id){

        $archive = Archive::find($id);
        $categories = Category::get();
        $groups = Group::get();

        return view('admin.pages.archives.single' ,compact('archive' ,'categories' ,'groups'));
    }

    public function getEdit($id){

        $archive = Archive::find($id);
        $categories = Category::get();
        $groups = Group::get();

        return view('admin.pages.archives.edit' ,compact('archive' ,'categories' ,'groups'));
    }

    public function postIndex(ArchiveRequest $request){
        $request->store();

        return ['status' => 'success' ,'data' => 'تم اضافه الملف بنجاح'];
    }

    public function postEdit(ArchiveRequest $request , $id){
        $request->edit($id);

        return ['status' => 'success' ,'data' => 'تم تعديل بيانات الملف بنجاح'];
    }

    public function getDelete($id){
        $archive = Archive::find($id);

        $destination = storage_path('uploads/archives');
        @unlink($destination . "/{$archive->archive}");

        $archive->delete();

        return redirect()->back();
    }

    public function getDeleteFile(Request $request , $id)
    {
        $file = ArchiveFile::find($id);

        @unlink(storage_path('uploads/archives/').$file->image);

        $file->delete();

        return redirect()->back();
    }
}
