<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class WebsiteController extends Controller
{
    public function index(){
        try{
            $info= DB::table('company_info')->first();
            $slides = DB::table('slide')->orderBy('id','desc')->take(10)->get();
            $clients = DB::table('clients')->take(10)->get();
            $services_g = DB::table('services')->select('title')->groupBy('title')->get();
            $projects_p = DB::table('projects')
                ->select('*','projects.id as p_id')
                ->join('type','type.id','=','projects.type_id')
                ->join('services','services.id','=','projects.cat_id')
                ->join('sub_category','sub_category.id','=','projects.subcat_id')
                ->orderBy('projects.id','desc')
                ->take(50)
                ->get();
            return view('website.index',
                ['slides' => $slides, 'infos' => $info,'services_g' => $services_g,'projects_p' => $projects_p,'clients' => $clients]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function about(){
        try{
            $info= DB::table('company_info')->first();
            $slides = DB::table('slide')->orderBy('id','desc')->take(10)->get();
            $services = DB::table('services')->get();

            return view('website.about',
                ['slides' => $slides, 'infos' => $info,'services' => $services]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function projectDetails(Request $request){
        try{
            $rows= DB::table('projects')->where('id',$request->id)->first();
            $projects_p = DB::table('projects')
                ->select('*','projects.id as p_id')
                ->join('services','services.id','=','projects.cat_id')
                ->join('sub_category','sub_category.id','=','projects.subcat_id')
                ->orderBy('projects.id','desc')
                ->take(20)
                ->get();
            $slider = explode(",",json_decode($rows->slider_photo));
            array_pop($slider);
            return view('website.projectDetails',
                ['projects' => $rows,'sliders' => $slider,'ap' =>$projects_p]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function allProjects(Request $request){
        try{
            $slides = DB::table('slide')->orderBy('id','desc')->take(10)->get();
            $services = DB::table('services')->select('title')->groupBy('title')->get();
            $projects = DB::table('projects')
                ->select('*','projects.id as p_id')
                ->join('services','services.id','=','projects.cat_id')
                ->join('sub_category','sub_category.id','=','projects.subcat_id')
                ->orderBy('projects.id','desc')
                ->paginate(50);
            return view('website.allProjects',
                ['slides' => $slides,'services' => $services,'projects' => $projects]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function contact(Request $request){
        try{
            $slides = DB::table('slide')->get();
            return view('website.contact',
                ['slides' => $slides]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function allServices(Request $request){
        try{
            $slides = DB::table('slide')->get();
            $services = DB::table('services')->get();

            return view('website.allServices',
                ['slides' => $slides, 'services' => $services]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function service(Request $request){
        try{
            $slides = DB::table('slide')->get();
            $services = DB::table('services')->get();
            $service = DB::table('services')->where('id',$request->cat)->first();

            return view('website.service',
                ['slides' => $slides, 'service' => $service, 'services' => $services]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function client(Request $request){
        try{
            $slides = DB::table('slide')->get();
            $clients = DB::table('clients')->get();

            return view('website.clients',
                ['slides' => $slides, 'clients' => $clients]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function product(Request $request){
        try{
            $slides = DB::table('slide')->get();
            $type = DB::table('type')->where('id',$request->id)->first();
            $cats = DB::table('services') ->where('type_id',$request->id)->get();
            $products = DB::table('projects')
                ->select('*','projects.id as p_id')
                ->join('type','type.id','=','projects.type_id')
                ->join('services','services.id','=','projects.cat_id')
                ->join('sub_category','sub_category.id','=','projects.subcat_id')
                ->where('projects.type_id',$request->id)
                ->orderBy('projects.id','desc')
                ->paginate(50);
            return view('website.product',
                ['slides' => $slides,'projects_p' => $products,'sub_cats' => $cats,'service' => $type]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function sendMail(Request $request){
        try{
            $file_path = '';
            if ($request->hasFile('slider')) {
                $files = $request->file('slider');
                $targetFolder = 'public/asset/images/';

                foreach ($files as $file) {
                    $pname = time() . '.'. $file->getClientOriginalName();
                    $file->move($targetFolder, $pname);
                    $file_path .= $targetFolder . $pname.',';
                }
                $file_path = json_encode($file_path);
            }
			$result = DB::table('received_email')->insert([
				'name' => $request->name,
				'email' => $request->email,
				'phone' => $request->phone,
				'subject' => $request->subject,
				'msg' => $request->message,
				'file' => $file_path,
			]);
			if ($result) {
				return back()->with('successMessage', 'Mail Sent Successfully Done.');
			} else {
				return back()->with('errorMessage', 'Please Try Again.');
			}

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function customOrder(Request $request){
        try{
            $rows = DB::table('type')->get();
            return view('website.customOrder',
                ['types' => $rows,]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchProduct(Request $request){
        try{
            $products = DB::table('artwork')
                ->select('*')
                ->where('type_id',$request->type_id)
                ->where('cat_id',$request->cat_id)
                ->where('subcat_id',$request->subcat_id)
                ->orderBy('id','desc')
                ->get();
            return view('website.searchResultProduct',
                ['projects' => $products]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function projectArtwork(Request $request){
        try{
            $products = DB::table('artwork')
                ->select('*')
                ->where('id',$request->id)
                ->first();
            return view('website.orderProduct',
                ['product' => $products]
            );
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function myProfile(Request $request){
        try{
            if(Cookie:: get('user_id')) {
                $products = DB::table('orders')
                    ->select('*','orders.id as p_id')
                    ->join('artwork','artwork.id','=','orders.product_id')
                    ->where('orders.user_id', Cookie:: get('user_id'))
                    ->orderBy('orders.id','desc')
                    ->paginate(20);
                return view('website.myProfile', ['products' => $products]);
            }
            else{
                return redirect('login');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertNewOrder(Request $request){
        try{
            if(Cookie:: get('user_id')){
                $result = DB::table('orders')->insert([
                    'user_id' => Cookie:: get('user_id'),
                    'product_id' => $request->id,
                    'address' => $request->address,
                    'gender' => $request->gender,
                    'a_color' => $request->a_color,
                    'd_color' => $request->d_color,
                    'quantity' => $request->quantity,
                    'unit' => $request->unit,
                    'art_value' => json_encode($request->art_value),
                ]);
                if ($result) {
                    return redirect('myProfile')->with('successMessage', 'Order Successfully Done.');
                } else {
                    return back()->with('errorMessage', 'Please Try Again.');
                }
            }
            else {
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
                            DB::table('orders')->insert([
                                'user_id' => $rows->id,
                                'product_id' => $request->id,
                                'address' => $request->address,
                                'gender' => $request->gender,
                                'a_color' => $request->a_color,
                                'd_color' => $request->d_color,
                                'quantity' => $request->quantity,
                                'unit' => $request->unit,
                                'art_value' => json_encode($request->art_value),
                            ]);
                            return redirect()->to('myProfile');
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
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}
