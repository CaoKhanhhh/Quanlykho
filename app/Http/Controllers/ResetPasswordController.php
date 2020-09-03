<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Str;
use App\PasswordReset;
use App\User;
use Illuminate\Http\Request;
use App\Notifications\ResetPasswordRequest;
class ResetPasswordController extends Controller
{
    public function sendMail(Request $request){
        $user = User::where('email',$request->email)->firstOrFail();
        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $request->email,
            'token' => Str::random(30),
        ]);
        if($user && $passwordReset){
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }
        return redirect('/')->with(
           'message' ,'Chung toi da gui 1 lien ket den email cua ban.'
        );
    }
    public function resetView(Request $request, $token){
        return view('changePassword')->with('passwordtoken',$token);
    }
    public function reset(Request $request){
        $passwordReset=PasswordReset::where('token',$request->passwordtoken)->firstOrFail();
        if(Carbon::parse($passwordReset->updated_at)->addMinutes(1440)->isPast()){
            $passwordReset->delete();
            return response()->json([
                'msg' => 'The token is invalid'
            ],422);
        }
        $user=User::where('email',$passwordReset->email)->firstOrFail();
        $user->fill(['password' => Hash::make($request->password)]);
        $user->isFirstTime=0;
        $user->save();
        $passwordReset->delete();
        return redirect('/')->with(
           'sucess','Đổi mật khẩu thành công.'
        );
    }
}
