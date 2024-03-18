<?php

namespace App\Http\Requests;

use App\Card;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CardRequest extends FormRequest
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
        if (\Request::route()->getName() == 'admin.cards') {
            return [
                'ar_name' => 'required',
                'en_name' => 'required',
                'job' => 'required',
                'institute' => 'required',
                'phone' => 'required',
                'mobile' => 'required',
                'postal' => 'required',
                'city' => 'required',
                'country' => 'required',
                'address' => 'required',
                'email' => 'required',
                'image' => 'required|image|max:20000'
            ];
        }else{
            return [
                'ar_name' => 'required',
                'en_name' => 'required',
                'job' => 'required',
                'institute' => 'required',
                'phone' => 'required',
                'mobile' => 'required',
                'postal' => 'required',
                'city' => 'required',
                'country' => 'required',
                'address' => 'required',
                'email' => 'required',
                'image' => 'image|max:20000'
            ];
        }
    }

    public function messages()
    {
        if (\Request::route()->getName() == 'admin.cards') {
            return [
                'ar_name.required' => 'برجاء ادخال الاسم باللغه العربيه',
                'en_name.required' => 'برجاء ادخال الاسم باللغه الانجليزيه',
                'job.required' => 'برجاء ادخال وظيفتك الحاليه',
                'institute.required' => 'برجاء ادخال اسم المؤسسه',
                'phone.required' => 'برجاء ادخال رقم الهاتف',
                'mobile.required' => 'برجاء ادخال رقم الموبايل',
                'postal.required' => 'برجاء ادخال رقم البريد',
                'city.required' => 'برجاء ادخال اسم مدينتك',
                'country.required' => 'برجاء ادخال اسم دولتك',
                'address.required' => 'برجاء ادخال عنوانك',
                'email.required' => 'برجاء ادخال بريدك الاكتروني',
                'image.required' => 'برجاء اختيار الصوره',
                'image.image' => 'برجاء اختيار صوره وليس ملف',
                'image.max' => 'اقصي جدم متاح للصوره هو 2 ميجابايت'
            ];
        }else{
            return [
                'ar_name.required' => 'برجاء ادخال الاسم باللغه العربيه',
                'en_name.required' => 'برجاء ادخال الاسم باللغه الانجليزيه',
                'job.required' => 'برجاء ادخال وظيفتك الحاليه',
                'institute.required' => 'برجاء ادخال اسم المؤسسه',
                'phone.required' => 'برجاء ادخال رقم الهاتف',
                'mobile.required' => 'برجاء ادخال رقم الموبايل',
                'postal.required' => 'برجاء ادخال رقم البريد',
                'city.required' => 'برجاء ادخال اسم مدينتك',
                'country.required' => 'برجاء ادخال اسم دولتك',
                'address.required' => 'برجاء ادخال عنوانك',
                'email.required' => 'برجاء ادخال بريدك الاكتروني',
                'image.image' => 'برجاء اختيار صوره وليس ملف',
                'image.max' => 'اقصي جدم متاح للصوره هو 2 ميجابايت'
            ];
        }
    }

    public function store(){
        $card = new Card();

        $card->ar_name = $this->ar_name;
        $card->en_name = $this->en_name;
        $card->job = $this->job;
        $card->institute = $this->institute;
        $card->phone = $this->phone;
        $card->mobile = $this->mobile;
        $card->postal = $this->postal;
        $card->city = $this->city;
        $card->country = $this->country;
        $card->address = $this->address;
        $card->email = $this->email;
        $card->member_id = auth()->guard('admins')->user()->id;
        $card->notes = $this->notes;
        $card->website = $this->website;

        $file = $this->image;
        $destination = storage_path('uploads/cards');

        if (!empty($file)) {
//            @unlink($destination . "/{$banner->banner}");
            $card->image = md5(time()).'.'.$file->getClientOriginalName();
            $this->image->move($destination, $card->image);
//            Image::make($destination.'/'.$banner->banner)->resize(1920 ,655)->save($destination.'/'.$banner->banner);
        }

        $card->save();
    }

    public function edit($id){
        $card = Card::find($id);

        $card->ar_name = $this->ar_name;
        $card->en_name = $this->en_name;
        $card->job = $this->job;
        $card->institute = $this->institute;
        $card->phone = $this->phone;
        $card->mobile = $this->mobile;
        $card->postal = $this->postal;
        $card->city = $this->city;
        $card->country = $this->country;
        $card->address = $this->address;
        $card->email = $this->email;
        $card->member_id = auth()->guard('admins')->user()->id;
        $card->notes = $this->notes;
        $card->website = $this->website;

        $file = $this->image;
        $destination = storage_path('uploads/cards');

        if (!empty($file)) {
            @unlink($destination . "/{$card->image}");
            $card->image = md5(time()).'.'.$file->getClientOriginalName();
            $this->image->move($destination, $card->image);
//            Image::make($destination.'/'.$banner->banner)->resize(1920 ,655)->save($destination.'/'.$banner->banner);
        }

        $card->save();
    }
}
