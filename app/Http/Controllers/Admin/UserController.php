<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function getIndex(){
        if (auth()->guard('admins')->user()->role == 'admin'){
            $users = User::get();
        }elseif (auth()->guard('admins')->user()->role == 'senior'){
            $users = User::where('role' ,'user')->where('category_id' ,auth()->guard('admins')->user()->category_id)->get();
        }
        $categories = Category::get();

        return view('admin.pages.users.index' ,compact('users' ,'categories'));
    }

    public function getEdit($id){
        $user = User::find($id);
        $categories = Category::get();

        return view('admin.pages.users.edit' ,compact('user' ,'categories'));
    }

    public function postIndex(UserRequest $request){
        $request->store();

        return ['status' => 'success' ,'data' => 'تم تخزين بيانات المستخدم الجديد بنجاح'];
    }

    public function postEdit(UserRequest $request ,$id){
        $request->edit($id);

        return ['status' => 'success' ,'data' => 'تم تحديث بيانات المستخدم بنجاح'];
    }

    public function postChangeType(Request $request ,$id){
        $user = User::find($id);

        if ($user->active == 1){
            $user->active = 0;

            $user->update();
        }else{
            $user->active = 1;

            $user->update();
        }

        return redirect()->back();
    }
}
