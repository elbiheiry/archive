<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Group;
use App\Http\Requests\VideoArchiveRequest;
use App\VideoArchive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoArchiveController extends Controller
{
    //
    public function getIndex(){
        if (auth()->guard('admins')->user()->role == 'admin'){
            $archives = VideoArchive::get();
        }elseif (auth()->guard('admins')->user()->role == 'senior'){
            $archives = VideoArchive::where('category_id' , auth()->guard('admins')->user()->category_id)->get();
        }elseif (auth()->guard('admins')->user()->role == 'user'){
            $archives = VideoArchive::where('member_id' , auth()->guard('admins')->user()->id)->get();
        }
        $categories = Category::get();
        $groups = Group::get();

        return view('admin.pages.video_archives.index' ,compact('archives' ,'categories' ,'groups'));
    }

    public function getSingleArchive($id){
        $archive = VideoArchive::find($id);
        $categories = Category::get();
        $groups = Group::get();

        return view('admin.pages.video_archives.single' ,compact('archive' ,'categories' ,'groups'));
    }

    public function getEdit($id){
        $archive = VideoArchive::find($id);
        $categories = Category::get();
        $groups = Group::get();

        return view('admin.pages.video_archives.edit' ,compact('archive' ,'categories' ,'groups'));
    }

    public function postIndex(VideoArchiveRequest $request){
        $request->store();

        return ['status' => 'success' ,'data' => 'تم اضافه الملف بنجاح'];
    }

    public function postEdit(VideoArchiveRequest $request , $id){
        $request->edit($id);

        return ['status' => 'success' ,'data' => 'تم تعديل بيانات الملف بنجاح'];
    }

    public function getDelete($id){
        $archive = VideoArchive::find($id);

        $destination = storage_path('uploads/archives');
        @unlink($destination . "/{$archive->image}");

        $archive->delete();

        return redirect()->back();
    }
}
