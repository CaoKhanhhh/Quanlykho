<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function authenticate(Request $request)
    {
        $user_data= [
            'username' => $request->username,
            'password' =>$request->password,
        ];
        if(Auth::attempt($user_data)){
            $check=Auth::user()->isFirstTime;
            $user=Auth::user();
            if($check ==1 ){
                return redirect()->route('reset_password')->with('message','Mời bạn đổi mật khẩu.');
            }
            else if($check != 1){
                if(Auth::user()->role ==1 ){
                    return redirect()-> route('admin.homepage')->with('user',$user);
                }
                if(Auth::user()->role !=1){
                    return redirect()->route('user.homepage',[Auth::user()->id]);
                }
            }
        }
        else{
            return back()->with('warning','Sai thông tin đăng nhập');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
