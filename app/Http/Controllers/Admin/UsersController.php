<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Stock;
use App\Stock_detail;
use App\Notifications\AddUsersRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Add_UserForm;
class UsersController extends Controller
{
    public function viewUsers(Request $request){
        if($request->table_search){
            $user=User::where('name','like',"%$request->table_search%")->get();
            return view('admin.quankho_view')->with('user',$user);
        }
        $user=User::where('role',2)->get();
        return view('admin.quankho_view')->with('user',$user);
    }
    public function addUsers(){
        return view('admin.quankho_add');
    }
    public function insertUsers(Add_UserForm $request){
        $user=new User();
        $user->username=$request->email;
        $password=Str::random('10');
        $user->password=Hash::make($password);
        $user->role=2;
        $user->date_of_births = $request->date_of_births;
        if($request->hasFile('image')){
            $filename=$request->name.".".$request->image->extension();
            $path=$request->image->move('img/avatar',$filename);
            $user->image=$path;
        }
        if(!$request->hasFile('image')){
            if($request->gender ==1){
                $user->image='img/avatar/default_man.png';
            }
            if($request->gender ==2){
                $user->image='img/avatar/default_woman.png';
            }

        }
        if($request->gender == 1){
            $user->gender =1;
        }
        if($request->gender == 2){
            $user->gender =2;
        }
        $user->fill($request->all());
        $user->save();
        $user->notify(new AddUsersRequest($user->username,$password));
        $user_new=User::where('role',2)->get();
        return redirect()->route('quankho.view')->with(['user' => $user_new,'message' =>'Thêm thành công']);
    }
    public function editUsers($id){
        $user=User::find($id);
        return view('admin.quankho_edit')->with('user',$user);
    }
    public function updateUsers($id,Request $request){
        $user=User::find($id);
        $user->role=2;
        $user->date_of_births = $request->date_of_births;
        if($request->hasFile('image')){
            $filename=$request->name.".".$request->image->extension();
            $path=$request->image->move('img/avatar',$filename);
            $user->image=$path;
        }

        if($request->gender == 1){
            $user->gender =1;
        }
        if($request->gender == 2){
            $user->gender =2;
        }
        $user->fill($request->all());
        $user->save();
        return redirect(route('quankho.view'))->with('message','Sửa thông tin thành công.');
    }
    public function deleteUsers($id){
        $user=User::find($id);
        $user->delete();
        return redirect(route('quankho.view'))->with('message','Xóa thành công.');
    }
//    public function resetPassword(Request $request){
//        $id=$request->checkbox;
//        $user=User::whereIn('id',$id)->get();
////        return response()->json($user);
//        return view('admin.multiple_resetpassword')->with('user',$user);
//    }
    public function updatePassword(Request $request){
        $user=User::whereIn('id',$request->checkbox)->get();
        foreach ($user as $key => $u){
            $password=Str::random('10');
            $u->password=Hash::make($password);
            $u->notify(new AddUsersRequest($u->username,$password));
            $u->save();
        }
        return redirect()->route('quankho.view')->with('message','Đổi mật khẩu thành công');
    }
}
