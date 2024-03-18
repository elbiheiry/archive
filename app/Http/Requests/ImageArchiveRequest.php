<?php

namespace App\Http\Requests;

use App\ImageArchive;
use App\ImageArchiveFile;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ImageArchiveRequest extends FormRequest
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
            'file_number' => 'required',
            'group_id' => 'required|not_in:0',
            'category_id' => 'required|not_in:0',
            'name' => 'required',
            'location' => 'required',
            'images' => \Request::route()->getName() == 'admin.images' ? 'required' : ''
        ];
    }

    public function messages()
    {
        return [
            'file_number.required' => 'برجاء ادخال رقم الملف',
            'group_id.required' => 'يجب ادخال المجموعه التابع لها هذا الملف',
            'group_id.not_in' => 'يجب ان تقوم باختيار المجموعه',
            'category_id.required' => 'يجب ادخال القسم التابع له هذا الملف',
            'category_id.not_in' => 'يجب ان تقوم باختيار القسم',
            'name.required' => 'برجاء ادخال العنوان الخاص بالملف',
            'location.required' => 'يجب كتابه المكان/الموقع/البلد ',
            'images.required' => \Request::route()->getName() == 'admin.images' ? 'برجاء رفع الملف' : ''
        ];
    }

    public function store()
    {
        $archive = new ImageArchive();

        $archive->file_number = $this->file_number;
        $archive->group_id = $this->group_id;
        $archive->category_id = $this->category_id;
        $archive->name = $this->name;
        $archive->location = $this->location;
        $archive->member_id = auth()->guard('admins')->user()->id;

        if ($archive->save()){
            foreach ($this->images as $item) {
                $image = new ImageArchiveFile();

                $item->store('archives');
                $image->image = $item->hashName();

                $image->archive_id = $archive->id;

                $image->save();
            }
        }
    }

    public function edit($id)
    {
        $archive = ImageArchive::find($id);

        $archive->file_number = $this->file_number;
        $archive->group_id = $this->group_id;
        $archive->category_id = $this->category_id;
        $archive->name = $this->name;
        $archive->location = $this->location;

        $archive->save();
    }
}
