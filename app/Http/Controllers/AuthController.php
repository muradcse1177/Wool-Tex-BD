<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function verifyUsers(Request $request){
        try{
            if($request->login == "login"){
                $email = $request->email;
                $password = $request->password;
                $rows = DB::table('users')
                    ->where('email', $email)
                    ->get()->count();
                if ($rows > 0) {
                    $rows = DB::table('users')
                        ->where('email', $email)
                        ->first();
                    if (Hash::check($password, $rows->password)) {
                        $role = $rows->role;
                        Session::put('user_info', $rows);
                        Cookie::queue('user_id', $rows->id, time()+31556926 ,'/');
                        Cookie::queue('role', $rows->role, time()+31556926 ,'/');
                        Cookie::queue('user_name', $rows->name, time()+31556926 ,'/');

                        if($role == 1){
                            Cookie::queue('admin', $rows->id, time()+31556926 ,'/');
                            return redirect()->to('/home');
                        }
                        else{
                            return redirect()->to('login');
                        }
                    }
                    else{
                        return back()->with('errorMessage', 'Incorrect Password!!');
                    }
                } else {
                    return back()->with('errorMessage', 'User Not Exits!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function logout(){
        Cookie::queue(Cookie::forget('user','/'));
        Cookie::queue(Cookie::forget('role','/'));
        Cookie::queue(Cookie::forget('user_name','/'));
        session()->forget('user_info');
        session()->flush();
        return redirect()->to('/');
    }
}
