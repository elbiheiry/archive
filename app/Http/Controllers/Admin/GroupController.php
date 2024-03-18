<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //
    public function getIndex(){
        $groups = Group::get();

        return view('admin.pages.groups.index' ,compact('groups'));
    }

    public function postIndex(GroupRequest $request){
        $request->store();

        return ['status' => 'success' ,'data' => 'تم اضافه اسم المجموعه بنجاح'];
    }

    public function postEdit(GroupRequest $request ,$id){
        $request->edit($id);

        return redirect()->back();
    }

    public function getDelete($id){
        $group = Group::find($id);

        $group->delete();

        return redirect()->back();
    }
}
