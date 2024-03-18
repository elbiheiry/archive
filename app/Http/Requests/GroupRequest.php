<?php

namespace App\Http\Requests;

use App\Group;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GroupRequest extends FormRequest
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
            'name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'برجاء ادخال اسم المجموعه'
        ];
    }

    public function store(){
        $group = new Group();

        $group->name = $this->name;

        $group->save();
    }

    public function edit($id){
        $group = Group::find($id);

        $group->name = $this->name;

        $group->save();
    }
}
