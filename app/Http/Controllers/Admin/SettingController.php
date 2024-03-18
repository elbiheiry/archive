<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use Image;

class SettingController extends Controller
{
    //view the settings page
    public function getIndex()
    {
        $settings = Setting::first();

        return view('admin.pages.settings.index' ,compact('settings'));
    }

    //edit the settings of the site
    public function postIndex(Request $request){
        $v = validator($request->all() ,[
            'site_name' => 'required',
            'email' => 'required|email',
            'site_logo' => 'image|mimes:jpeg,jpg,png,gif,svg|max:20000'
        ] ,[
            'site_name.required' => 'برجاء ادخال اسم الموقع',
            'email.required' => 'برجاء ادخال البريد الالكتروني المراد ارسال الرسائل عليه',
            'email.email' => 'برجاء ادخال بريد الكتروني صحيح',
            'site_logo.mimes' => 'نوع الصوره يجب ان يكون : jpeg,jpg,png,gif ' ,
            'site_logo.max' => 'حجم الصوره يجب الا يقل عن 2 ميجا بايت'
        ]);

        if ($v->fails()){
            return ['status' => false ,'data' => implode(PHP_EOL ,$v->errors()->all())];
        }

        $settings = Setting::first();

        $settings->site_name = $request->site_name;
        $settings->email = $request->email;

        $file = $request->site_logo;
        $destination = storage_path('uploads/logo');

        if (!empty($file)) {
            @unlink($destination . "/{$settings->site_logo}");
            $settings->site_logo= md5(time()).'.'.$file->getClientOriginalName();
            $request->site_logo->move($destination, $settings->site_logo);
            Image::make($destination.'/'.$settings->site_logo)->resize(153 ,57)->save($destination.'/'.$settings->site_logo);
        }

        if ($settings->save()){
            return ['status' => 'success' ,'data' => 'تم تحديث بيانات المستخدم بنجاح'];
        }

        return ['status' => 'false' ,'data' => 'خطا برجاء المحاوله لاحقا'];
    }
}
