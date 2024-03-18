<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator) {
        $result = ['status' => 'error' ,'data' => implode(PHP_EOL ,$validator->errors()->all())];
        throw new HttpResponseException(response()->json($result, 200));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (\Request::route()->getName() == 'admin.users') {
            return [
                'image' => 'required|image|max:20000',
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'username' => 'required|unique:users',
                'phone' => 'required',
                'password' => 'required',
                'role' => 'not_in:0',
                're-password' => 'required|same:password'
            ];
        }else{
            return [
                'image' => 'image|max:20000',
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$this->id,
                'username' => 'required|unique:users,username,'.$this->id,
                'phone' => 'required',
                'role' => 'not_in:0'
            ];
        }
    }

    public function messages()
    {
        if (\Request::route()->getName() == 'admin.users') {
            return [
                'image.required' => 'يجب ان تقوم بتحميل صوره للمستخدم',
                'image.image' => 'برجاء رفع صوره وليس ملف',
                'image.max' => ' حجم الصوره يجب الا يزيد عن 2 ميجا',
                'email.required' => 'برجاء ادخال البريد الالكتروني',
                'email.email' => 'يجب ادخال بريد الكتروني وليس كلام مفرغ',
                'email.unique' => 'هذا البريد مستخدم من قبل',
                'username.required' => 'برجاء ادخال اسم المستخدم',
                'username.unique' => 'هذا الاسم مستخدم بالفعل',
                'phone.required' => 'برجاء ادخال رقم الهاتف',
                'password.required' => 'برجاء ادخال الرقم السري',
                'role.not_in' => 'يجب ان تقوم باختيار واحد علي الاقل',
                'name.required' => 'برجاء ادخال الاسم',
                're-password.required' => 'الرقم السري غير متشابه'
            ];
        }else{
            return [
                'image.image' => 'برجاء رفع صوره وليس ملف',
                'image.max' => ' حجم الصوره يجب الا يزيد عن 2 ميجا',
                'email.required' => 'برجاء ادخال البريد الالكتروني',
                'email.email' => 'يجب ادخال بريد الكتروني وليس كلام مفرغ',
                'email.unique' => 'هذا البريد مستخدم من قبل',
                'username.required' => 'برجاء ادخال اسم المستخدم',
                'username.unique' => 'هذا الاسم مستخدم بالفعل',
                'phone.required' => 'برجاء ادخال رقم الهاتف',
                'role.not_in' => 'يجب ان تقوم باختيار واحد علي الاقل',
                'name.required' => 'برجاء ادخال الاسم'
            ];
        }
    }

    public function store(){
        $user = new User();

        $user->email = $this->email;
        $user->username = $this->username;
        $user->phone = $this->phone;
        $user->password = bcrypt($this->password);
        $user->role = $this->role;
        $user->name = $this->name;
        $user->category_id = $this->category_id;

        $image = $this->file('image');
        $destination = storage_path('uploads/users');

        if ($image){
            $user->image = md5(time()).'.'.$image->getClientOriginalName();
            $this->image->move($destination , $user->image);
        }

        $user->save();
    }

    public function edit($id){
        $user = User::find($id);

        $user->email = $this->email;
        $user->username = $this->username;
        $user->phone = $this->phone;
        if ($this->password) {
            $user->password = bcrypt($this->password);
        }
        $user->role = $this->role;
        $user->name = $this->name;
        if ($this->role != 'admin'){
            $user->category_id = $this->category_id;
        }else{
            $user->category_id = '0';
        }

        $image = $this->file('image');
        $destination = storage_path('uploads/users');

        if ($image){
            @unlink($destination."/{$user->image}");
            $user->image = md5(time()).'.'.$image->getClientOriginalName();
            $this->image->move($destination , $user->image);
        }

        $user->save();
    }
}
