<?php

namespace App\Http\Requests;

use App\Contract;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContractRequest extends FormRequest
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
            'image' => \Request::route()->getName() == 'admin.contracts' ? 'required' : '',
            'name' => 'required',
            'register_date' => 'required',
            'end_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'image.required' => \Request::route()->getName() == 'admin.contracts' ? 'برجاء رفع الملف الخاص بهذا العقد' : '',
            'name.required' => 'برجاء ادخال اسم العقد او الجهه الخاصه به',
            'register_date.required' => 'برجاء ادخال تاريخ التسجيل',
            'end_date.required' => 'برجاء ادخال تاريخ انتهاء العقد'
        ];
    }

    public function store()
    {
        $contract = new Contract();

        $contract->name = $this->name;
        $contract->register_date = $this->register_date;
        $contract->end_date = $this->end_date;
        $this->image->store('contracts');
        $contract->image = $this->image->hashName();

        $contract->save();
    }

    public function edit($id)
    {
        $contract = Contract::find($id);

        $contract->name = $this->name;
        $contract->register_date = $this->register_date;
        $contract->end_date = $this->end_date;

        if ($this->image){
            @unlink(storage_path('uploads/contracts/') .$contract->image);

            $this->image->store('contracts');
            $contract->image = $this->image->hashName();
        }

        $contract->save();
    }
}
