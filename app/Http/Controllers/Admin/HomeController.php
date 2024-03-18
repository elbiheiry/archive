<?php

namespace App\Http\Controllers\Admin;

use App\Archive;
use App\Contract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function getIndex(){
        $contracts = Contract::all();
        $archives = Archive::where('file_status' , 'يحتاج الي متابعه')->get();

        return view('admin.pages.index' ,compact('contracts' ,'archives'));
    }

}
