<?php

namespace App\Http\Requests;

use App\Archive;
use App\ArchiveFile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ArchiveRequest extends FormRequest
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
            'file_path' => 'required|not_in:0',
            'category_id' => 'required|not_in:0',
            'how_to_send' => 'required|not_in:0',
            'subject' => 'required',
            'incharge' => 'required',
            'file_status' => 'required',
            'register_date' => 'required',
            'archives' => \Request::route()->getName() == 'admin.archives' ? 'required' : ''

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
            'file_path.required' => 'يجب ادخال اتجاه الملف',
            'file_path.not_in' => 'يجب ان تقوم باختيار اتجاه الملف',
            'how_to_send.required' => 'برجاء اختيار طريقه ارسال الملف',
            'how_to_send.not_in' => 'يجب ان تقوم باختيار كيفيه ارسال الملف',
            'subject.required' => 'برجاء ادخال الموضوع الخاص بالملف',
            'incharge.required' => 'يجب كتابه اسم المسئول عن هذا الملف',
            'file_status.required' => 'برجاء ادخال حاله الملف',
            'register_date.required' => 'برجاء اختيار ميعاد التسجيل الخاص بالملف',
            'archives.required' => \Request::route()->getName() == 'admin.archives' ? 'برجاء رفع الملفات الخاصه بهذا الارشيف' : ''
        ];
    }

    public function store(){
        $archive = new Archive();

        $archive->file_number = $this->file_number;
        $archive->import_number = $this->import_number;
        $archive->group_id = $this->group_id;
        $archive->category_id = $this->category_id;
        $archive->file_path = $this->file_path;
        $archive->file_date = $this->file_date;
        $archive->how_to_send = $this->how_to_send;
        $archive->subject = $this->subject;
        $archive->from_to = $this->from_to;
        $archive->incharge = $this->incharge;
        $archive->file_status = $this->file_status;
        $archive->register_date = $this->register_date;
        $archive->notes = $this->notes;
        $archive->member_id = auth()->guard('admins')->user()->id;
        $archive->file_status_date = $this->file_status_date;

        if ($archive->save()){
            foreach ($this->archives as $item) {
                $image = new ArchiveFile();

                $item->store('archives');
                $image->image = $item->hashName();

                $image->archive_id = $archive->id;

                $image->save();
            }
        }
    }

    public function edit($id){
        $archive = Archive::find($id);

        $archive->file_number = $this->file_number;
        $archive->import_number = $this->import_number;
        $archive->group_id = $this->group_id;
        $archive->category_id = $this->category_id;
        $archive->file_path = $this->file_path;
        $archive->how_to_send = $this->how_to_send;
        $archive->subject = $this->subject;
        $archive->incharge = $this->incharge;
        $archive->file_status = $this->file_status;
        $archive->register_date = $this->register_date;
        $archive->notes = $this->notes;
        $archive->file_status_date = $this->file_status_date;

        $archive->save();
    }
}
