<?php

namespace App\Http\Controllers\Admin\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller {

    public function __construct() {
        $this->middleware('guest.admin', ['except' => 'getLogout']);
    }

    public function getIndex() {
        return view('admin.auth.login');
    }

    public function postLogin(Request $r) {
        // 1- Validator::make()
        // 2- check if fails
        // 3- fails redirect or success not redirect

        $return = [
            'response' => 'success',
            'message' => 'تم تسجيل دخولك بنجاح',
            'url' => 'admin/'
        ];

        // grapping admin credentials
        $name = $r->input('email');
        $password = $r->input('password');

        // Searching for the admin matches the passed email or admin name
        $admin = User::where('username', $name)->orWhere('email', $name)->first();
        if ($admin->active == 1){
            if ($admin && Hash::check($password, $admin->password)) {
                // login the admin
                auth()->guard('admins')->login($admin, $r->has('remember'));

                $return = [
                    'response' => 'success',
                    'message' => 'تم تسجيل الدخول بنجاح',
                    'url' => route('admin.dashboard')
                ];
            } else {
                $return = [
                    'response' => 'error',
                    'message' => 'البيانات المدخله غير صحيحه'
                ];
            }
        }else{
            $return = [
                'response' => 'error',
                'message' => 'تم اغلاق حسابك حتي اشعار اخر'
            ];
        }

        return response()->json($return);
    }

    /**
     * Logout The user
     */
    public function getLogout() {
        Auth::guard('admins')->logout();
        return redirect('/admin/auth');
    }

}
