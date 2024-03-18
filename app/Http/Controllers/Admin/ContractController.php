<?php

namespace App\Http\Controllers\Admin;

use App\Contract;
use App\Http\Requests\ContractRequest;
use App\Mail\ContractEmail;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContractController extends Controller
{
    //
    public function getIndex(){
        $contracts = Contract::get();
        
        return view('admin.pages.contracts.index' ,compact('contracts' ));
    }

    public function getEdit($id){
        $contract = Contract::find($id);

        return view('admin.pages.contracts.edit' ,compact('contract'));
    }

    public function postIndex(ContractRequest $request){
        $request->store();

        return ['status' => 'success' ,'data' => 'تم اضافه العقد بنجاح'];
    }

    public function postEdit(ContractRequest $request , $id){
        $request->edit($id);

        return ['status' => 'success' ,'data' => 'تم تعديل بيانات العقد بنجاح'];
    }

    public function getDelete($id){
        $contract = Contract::find($id);

        @unlink(storage_path('uploads/contracts/').$contract->image);

        $contract->delete();

        return redirect()->back();
    }
}
