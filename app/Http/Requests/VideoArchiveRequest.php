<?php

namespace App\Http\Requests;

use App\VideoArchive;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VideoArchiveRequest extends FormRequest
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
            'name' => 'required',
            'location' => 'required',
            'video' => 'required'
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
            'name.required' => 'برجاء ادخال العنوان الخاص بالملف',
            'location.required' => 'يجب كتابه المكان/الموقع/البلد ',
            'video.required' => 'برجاء ادخال لينك الفيديو من اليوتيوب'
        ];
    }

    public function store()
    {
        $archive = new VideoArchive();

        $archive->file_number = $this->file_number;
        $archive->group_id = $this->group_id;
        $archive->category_id = $this->category_id;
        $archive->name = $this->name;
        $archive->location = $this->location;
        $archive->member_id = auth()->guard('admins')->user()->id;
        $archive->video = $this->video;

        $archive->save();
    }

    public function edit($id)
    {
        $archive = VideoArchive::find($id);

        $archive->file_number = $this->file_number;
        $archive->group_id = $this->group_id;
        $archive->category_id = $this->category_id;
        $archive->name = $this->name;
        $archive->location = $this->location;
        $archive->video = $this->video;

        $archive->save();
    }
}
