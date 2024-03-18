<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    //
    public function getIndex() {
        $user = User::where('id', auth()->guard('admins')->user()->id)->first();

        return view('admin.pages.profile.index', compact('user'));
    }

    public function postIndex(Request $request) {
        $v = validator($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . auth()->guard('admins')->id(),
            'username' => 'required|unique:users,username,' . auth()->guard('admins')->id(),
            'phone' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:20000'
                ], [
            'name.required' => 'برجاء ادخال اسمك',
            'email.required' => 'برجاء ادخال بريدك الالكتروني',
            'email.unique' => 'هذا البريد مستخدم بالفعل',
            'username.required' => 'برجاء ادخال الاسم المستخدم',
            'username.unique' => 'هذا الاسم مستخدم بالفعل',
            'phone.required' => 'برجاء ادخال رقم الهاتف',
            'image.requried' => 'برجاء تحميل صوره المستخدم',
            'image.mimes' => 'صوره المستخدم يجب ان تكون : jpeg,jpg,png,gif',
            'image.max' => 'حجم الصوره يجب الا يزيد عن 2 ميجا بايت',
        ]);

        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }

        $user = User::find(auth()->guard('admins')->user()->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->phone = $request->phone;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $destination = storage_path('uploads/users');
//        dd($request->logo);
        if ($request->image) {
            @unlink($destination . "/{$user->image}");
            $user->image = md5(time()).'.'.$request->image->getClientOriginalName();
            $request->image->move($destination, $user->image);
        }

        if ($user->save()) {
            return ['status' => 'success', 'data' => 'تم تحديث الصفحه الشخصيه بنجاح'];
        }
        return ['status' => false, 'data' => 'خطا برجاء المحاوله لاحقا'];
    }

}
