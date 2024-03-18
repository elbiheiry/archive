<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CardRequest;
use App\Card;

class CardController extends Controller
{
    //
    public function getIndex(){
        $cards = Card::get();

        return view('admin.pages.cards.index' ,compact('cards'));
    }

    public function getEdit($id){
        $card = Card::find($id);

        return view('admin.pages.cards.edit' ,compact('card'));
    }

    public function getSingleCard($id){
        $card = Card::find($id);

        return view('admin.pages.cards.single' ,compact('card'));
    }

    public function postIndex(CardRequest $request){
        $request->store();

        return ['status' => 'success' ,'data' => 'تم ادخال الكارت الشخصي بنجاح'];
    }

    public function postEdit(CardRequest $request ,$id){
        $request->edit($id);

        return ['status' => 'success' ,'data' => 'تم تحديث بيانات الكارت الشخصي بنجاح'];
    }

    public function getDelete($id){
        $card = Card::find($id);

        $destination = storage_path('uploads/cards');
        @unlink($destination . "/{$card->image}");

        $card->delete();

        return redirect()->back();
    }
}
