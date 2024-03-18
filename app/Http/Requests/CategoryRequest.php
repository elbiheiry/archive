<?php

namespace App\Http\Requests;

use App\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryRequest extends FormRequest
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
            'name.required' => 'برجاء ادخال اسم القسم'
        ];
    }

    public function store(){
        $category = new Category();

        $category->name = $this->name;

        $category->save();
    }

    public function edit($id){
        $category = Category::find($id);

        $category->name = $this->name;

        $category->save();
    }
}
