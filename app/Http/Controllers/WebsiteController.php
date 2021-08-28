<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
}
