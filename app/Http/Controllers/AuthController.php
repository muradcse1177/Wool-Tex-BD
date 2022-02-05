<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

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
                        if($role == 2){
                            Cookie::queue('customer', $rows->id, time()+31556926 ,'/');
                            return redirect()->to('/myProfile');
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
    public function insertCustomer (Request $request){
        try{
            if($request) {
                $rows = DB::table('users')
                    ->where('email', $request->email)
                    ->orWhere('phone', $request->phone)
                    ->get()->count();
                if ($rows > 0) {
                    return redirect('login')->with('errorMessage', 'User Already Exits.Please Login.');
                }
                else{
                    $result = DB::table('users')->insert([
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'role' => 2,
                    ]);
                    if ($result) {
                        $rows = DB::table('users')
                            ->where('email', $request->email)
                            ->get()->count();
                        if ($rows > 0) {
                            $rows = DB::table('users')
                                ->where('email', $request->email)
                                ->first();
                            Session::put('user_info', $rows);
                            Cookie::queue('user_id', $rows->id, time()+31556926 ,'/');
                            Cookie::queue('role', $rows->role, time()+31556926 ,'/');
                            Cookie::queue('user_name', $rows->name, time()+31556926 ,'/');
                            Cookie::queue('customer', $rows->id, time()+31556926 ,'/');
                            return redirect()->to('home');
                        }
                        else{
                            return redirect()->to('home');
                        }
                    }
                    else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
            }
            else {
                return back()->with('errorMessage', 'Please Try Again.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }

    }
    public function logout(){
        Cookie::queue(Cookie::forget('user_id','/'));
        Cookie::queue(Cookie::forget('role','/'));
        Cookie::queue(Cookie::forget('user_name','/'));
        Cookie::queue(Cookie::forget('admin','/'));
        Cookie::queue(Cookie::forget('customer','/'));
        session()->forget('user_info');
        session()->flush();
        return redirect()->to('/');
    }
}
