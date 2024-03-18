<?php

namespace App\Http\Requests;

use App\FormArchive;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormArchiveRequest extends FormRequest
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
        return [
            'file_number' => 'required|numeric',
            'group_id' => 'required|not_in:0',
            'category_id' => 'required|not_in:0',
            'management' => 'required',
            'image' => \Request::route()->getName() == 'admin.forms' ? 'required' : ''
        ];
    }

    public function messages()
    {
        return [
            'file_number.required' => 'برجاء ادخال رقم الملف',
            'file_number.numeric' => 'يجب ان يكون المحتوي رقم وليس حروف',
            'group_id.required' => 'يجب ادخال المجموعه التابع لها هذا الملف',
            'group_id.not_in' => 'يجب ان تقوم باختيار المجموعه',
            'category_id.required' => 'يجب ادخال القسم التابع له هذا الملف',
            'category_id.not_in' => 'يجب ان تقوم باختيار القسم',
            'management.required' => 'برجاء ادخال الاداره الخاصه بالملف',
            'image.required' => \Request::route()->getName() == 'admin.forms' ? 'برجاء رفع الملف' : ''
        ];
    }

    public function store()
    {
        $archive = new FormArchive();

        $archive->file_number = $this->file_number;
        $archive->group_id = $this->group_id;
        $archive->category_id = $this->category_id;
        $archive->management = $this->management;
        $archive->member_id = auth()->guard('admins')->user()->id;

        $this->image->store('archives');
        $archive->image = $this->image->hashName();

        $archive->save();
    }

    public function edit($id)
    {
        $archive = FormArchive::find($id);

        $archive->file_number = $this->file_number;
        $archive->group_id = $this->group_id;
        $archive->category_id = $this->category_id;
        $archive->management = $this->management;

        if ($this->image){
            @unlink(storage_path('uploads/archives/'.$archive->image));
            $this->image->store('archives');
            $archive->image = $this->image->hashName();
        }

        $archive->save();
    }
}
