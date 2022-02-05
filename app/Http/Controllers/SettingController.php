<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

class SettingController extends Controller
{
    public function company_info(){
        try{
            $rows = DB::table('company_info')->get();
            return view('admin.index', ['infos' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertCompanyInfo (Request $request){
        try{
            if($request) {
                if ($request->id) {
                    $photo='';
                    if ($request->hasFile('logo')) {
                        $targetFolder = 'public/images/';
                        $file = $request->file('logo');
                        $pname = time() . '.' . $file->getClientOriginalName();
                        $image['filePath'] = $pname;
                        $file->move($targetFolder, $pname);
                        $photo = $targetFolder . $pname;
                    }
                    $result =DB::table('company_info')
                        ->where('id', $request->id)
                        ->update([
                            'name' => $request->name,
                            'phone' => $request->phone,
                            'address' => $request->address,
                            'email' => $request->email,
                            'hours' => $request->working,
                            'choose' => $request->choose,
                            'about' => $request->about,
                            'photo' => $photo,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Update Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
                else{
                    $rows = DB::table('company_info')->get()->count();
                    if ($rows > 0) {
                        return back()->with('errorMessage', 'Data Already Exits.');
                    }
                    else {
                        $photo='';
                        if ($request->hasFile('logo')) {
                            $targetFolder = 'public/images/';
                            $file = $request->file('logo');
                            $pname = time() . '.' . $file->getClientOriginalName();
                            $image['filePath'] = $pname;
                            $file->move($targetFolder, $pname);
                            $photo = $targetFolder . $pname;
                        }
                        $result = DB::table('company_info')->insert([
                            'name' => $request->name,
                            'phone' => $request->phone,
                            'address' => $request->address,
                            'email' => $request->email,
                            'hours' => $request->working,
                            'choose' => $request->choose,
                            'about' => $request->about,
                            'photo' => $photo,
                        ]);
                        if ($result) {
                        return back()->with('successMessage', 'Data Insert Successfully Done.');
                    } else {
                            return back()->with('errorMessage', 'Please Try Again.');
                        }
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getCompanyInfoById(Request $request){
        try{
            $rows = DB::table('company_info')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function mainSlide(){
        try{
            $rows = DB::table('slide')->orderBy('id','desc')->paginate(20);
            return view('admin.mainSlide', ['slides' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertMainSlide (Request $request){
        try{
            if($request) {
                if ($request->id) {
                    if($request->hasFile('slide')) {
                        $image       = $request->file('slide');
                        $filename    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(1880, 750);
                        $image_resize->save(public_path('images/' .$filename));
                    }
                    $result =DB::table('slide')
                        ->where('id', $request->id)
                        ->update([
                            'slide' => $filename,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Update Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
                else{
                    if($request->hasFile('slide')) {
                        $image       = $request->file('slide');
                        $filename    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(1880, 750);
                        $image_resize->save(public_path('images/' .$filename));
                    }
                    $result = DB::table('slide')->insert([
                        'slide' => $filename,
                    ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Insert Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function getMainSlideById(Request $request){
        try{
            $rows = DB::table('slide')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteSlideList(Request $request){
        try{

            if($request->id) {
                $result =DB::table('slide')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'Data Delete Successfully.');
                } else {
                    return back()->with('errorMessage', 'Please Try Again.');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function type(){
        try{
            $rows = DB::table('type')->orderBy('id','Asc')->get();
            return view('admin.motherType', ['types' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertType (Request $request){
        try{
            if($request) {
                if ($request->id) {
                    $result =DB::table('type')
                        ->where('id', $request->id)
                        ->update([
                            'name' => $request->name,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Update Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
                else{
                    $result = DB::table('type')->insert([
                        'name' => $request->name,
                    ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Insert Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getTypesById(Request $request){
        try{
            $rows = DB::table('type')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteTypeList(Request $request){
        try{
            if($request->id) {
                $result =DB::table('type')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'Data Delete Successfully.');
                } else {
                    return back()->with('errorMessage', 'Please Try Again.');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function servicesAdmin(){
        try{
            $rows = DB::table('type')->get();
            $rows1 = DB::table('services')
                ->select('*','services.id as c_id')
                ->join('type','type.id','=','services.type_id')
                ->orderBy('services.id','desc')
                ->paginate(30);
            return view('admin.servicesAdmin', ['services' => $rows1,'types' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertServices (Request $request){
        try{
            if($request) {
                if ($request->id) {
                    $result =DB::table('services')
                        ->where('id', $request->id)
                        ->update([
                            'type_id' => $request->type_id,
                            'title' => $request->title,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Update Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
                else{
                    $result = DB::table('services')->insert([
                        'type_id' => $request->type_id,
                        'title' => $request->title,
                    ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Insert Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function getServicesById(Request $request){
        try{
            $rows = DB::table('services')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteServiceList(Request $request){
        try{
            if($request->id) {
                $result =DB::table('services')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'Data Delete Successfully.');
                } else {
                    return back()->with('errorMessage', 'Please Try Again.');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function projects(){
        try{
            $rows = DB::table('type')->get();
            $rows1 = DB::table('projects')
                ->select('*','projects.id as p_id','type.name as t_name')
                ->join('type','type.id','=','projects.type_id')
                ->join('services','services.id','=','projects.cat_id')
                ->join('sub_category','sub_category.id','=','projects.subcat_id')
                ->orderBy('projects.id','desc')
                ->paginate(20);
            return view('admin.projects', ['projects' => $rows1,'types' => $rows,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function artwork(){
        try{
            $rows = DB::table('type')->get();
            $rows1 = DB::table('artwork')
                ->select('*','artwork.id as p_id','artwork.name as p_name','type.name as t_name')
                ->join('type','type.id','=','artwork.type_id')
                ->join('services','services.id','=','artwork.cat_id')
                ->join('sub_category','sub_category.id','=','artwork.subcat_id')
                ->orderBy('artwork.id','desc')
                ->paginate(20);
            return view('admin.artwork', ['projects' => $rows1,'types' => $rows,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getSubCatIdListAll(Request $request){
        try{
            $rows = DB::table('sub_category')
                ->where('cat_id', $request->id)
                ->get();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function insertProjects (Request $request){
        try{
            if($request) {
                if ($request->id) {
                    $data =DB::table('projects')
                        ->where('id', $request->id)->first();
                    if($request->hasFile('image')) {
                        $image       = $request->file('image');
                        $filenameImage    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 270);
                        $image_resize->save(public_path('images/' .$filenameImage));
                    }
                    else{
                        $filenameImage = $data->cover_phote;
                    }
                    $slider_photo = '';
                    if ($request->hasFile('slider')) {
                        $files = $request->file('slider');

                        foreach ($files as $file) {
                            $fileNameSlider = time() . '.'. $file->getClientOriginalName();
                            $image_resize = Image::make($file->getRealPath());
                            $image_resize->resize(1880, 750);
                            $image_resize->save(public_path('images/' .$fileNameSlider));
                            $slider_photo .= $fileNameSlider .',';
                        }
                        $slider_photo = json_encode($slider_photo);
                    }
                    else{
                        $slider_photo = $data->slider_photo;
                    }
                    $result =DB::table('projects')
                        ->where('id', $request->id)
                        ->update([
                            'type_id' => $request->type_id,
                            'cat_id' => $request->cat_id,
                            'subcat_id' => $request->subcat_id,
                            'name' => $request->name,
                            'info' => $request->info,
                            'description' => $request->description,
                            'cover_phote' => $filenameImage,
                            'slider_photo' => $slider_photo,
                            'type' => $request->type,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Update Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
                else{
                    if($request->hasFile('image')) {
                        $image       = $request->file('image');
                        $filenameImage    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 270);
                        $image_resize->save(public_path('images/' .$filenameImage));
                    }
                    $slider_photo = '';
                    $i =0;
                    if ($request->hasFile('slider')) {
                        $files = $request->file('slider');
                        foreach ($files as $file) {
                            $targetFolder = 'public/images/';
                            $pname = $i.time() . '.' . $file->getClientOriginalName();
                            $image_resize = Image::make($file->getRealPath());
                            $image_resize->resize(1880, 750);
                            $image_resize->save(public_path('images/' .$pname));
                            $slider_photo .=  $pname.',';
                            $i++;
                        }
                    }
                    $result = DB::table('projects')->insert([
                        'type_id' => $request->type_id,
                        'cat_id' => $request->cat_id,
                        'subcat_id' => $request->subcat_id,
                        'name' => $request->name,
                        'info' => $request->info,
                        'description' => $request->description,
                        'cover_phote' => $filenameImage,
                        'slider_photo' => json_encode($slider_photo),
                        'type' => $request->type,
                    ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Insert Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertArtWork (Request $request){
        try{
            if($request) {
                if ($request->id) {
                    $data =DB::table('artwork')
                        ->where('id', $request->id)->first();
                    if($request->hasFile('c_image')) {
                        $image       = $request->file('c_image');
                        $c_filenameImage    = 'a'.time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 270);
                        $image_resize->save(public_path('images/' .$c_filenameImage));
                    }
                    else{
                        $c_filenameImage = $data->c_image;
                    }
                    if($request->hasFile('image')) {
                        $image       = $request->file('image');
                        $filenameImage    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->save(public_path('images/' .$filenameImage));
                    }
                    else{
                        $filenameImage = $data->image;
                    }
                    $result =DB::table('artwork')
                        ->where('id', $request->id)
                        ->update([
                            'type_id' => $request->type_id,
                            'cat_id' => $request->cat_id,
                            'subcat_id' => $request->subcat_id,
                            'pattern' => $request->pattern,
                            'name' => $request->name,
                            'image' => $filenameImage,
                            'c_image' => $c_filenameImage,
                            'color' => json_encode($request->color),
                            'art_value' => json_encode($request->art_value),
                            'details' => $request->details,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Update Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
                else{
                    if($request->hasFile('c_image')) {
                        $image       = $request->file('c_image');
                        $c_filenameImage    = 'a'.time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 270);
                        $image_resize->save(public_path('images/' .$c_filenameImage));
                    }
                    if($request->hasFile('image')) {
                        $image       = $request->file('image');
                        $filenameImage    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->save(public_path('images/' .$filenameImage));
                    }
                    $result = DB::table('artwork')->insert([
                        'type_id' => $request->type_id,
                        'cat_id' => $request->cat_id,
                        'subcat_id' => $request->subcat_id,
                        'pattern' => $request->pattern,
                        'name' => $request->name,
                        'image' => $filenameImage,
                        'c_image' => $c_filenameImage,
                        'color' => json_encode($request->color),
                        'art_value' => json_encode($request->art_value),
                        'details' => $request->details,
                    ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Insert Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getArtworkById(Request $request){
        try{
            $rows = DB::table('artwork')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function getProjectById(Request $request){
        try{
            $rows = DB::table('projects')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteProjectList(Request $request){
        try{

            if($request->id) {
                $result =DB::table('projects')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'Data Delete Successfully.');
                } else {
                    return back()->with('errorMessage', 'Please Try Again.');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function deleteArtworkList(Request $request){
        try{
            if($request->id) {
                $result =DB::table('artwork')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'Data Delete Successfully.');
                } else {
                    return back()->with('errorMessage', 'Please Try Again.');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function subCategory(){
        try{
            $rows = DB::table('type')->get();
            $rows1 = DB::table('sub_category')
                ->select('*','sub_category.id as s_id')
                ->join('type','type.id','=','sub_category.type_id')
                ->join('services','services.id','=','sub_category.cat_id')
                ->orderBy('sub_category.id','desc')
                ->paginate(30);
            return view('admin.subCategory', ['types' => $rows, 'sub_cats' =>$rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getCategoryListAll(Request $request){
        try{
            $rows = DB::table('services')
                ->where('type_id', $request->id)
                ->get();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function insertSubCategory (Request $request){
        try{
            if($request) {
                if ($request->id) {
                    $result =DB::table('sub_category')
                        ->where('id', $request->id)
                        ->update([
                            'type_id' => $request->type_id,
                            'cat_id' => $request->cat_id,
                            'sub_name' => $request->sub_name,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Update Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
                else{
                    $result = DB::table('sub_category')->insert([
                        'type_id' => $request->type_id,
                        'cat_id' => $request->cat_id,
                        'sub_name' => $request->sub_name,
                    ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Insert Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }

    }

    public function getSubCategoryById(Request $request){
        try{
            $rows = DB::table('sub_category')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteSubCategoryList(Request $request){
        try{

            if($request->id) {
                $result =DB::table('sub_category')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'Data Delete Successfully.');
                } else {
                    return back()->with('errorMessage', 'Please Try Again.');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function clients(){
        try{
            $rows = DB::table('clients')->paginate(50);
            return view('admin.clients', ['clients' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertClients (Request $request){
        try{
            if($request) {
                if ($request->id) {
                    if($request->hasFile('photo')) {
                        $image       = $request->file('photo');
                        $filenameImage    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 270);
                        $image_resize->save(public_path('images/' .$filenameImage));
                    }
                    $result =DB::table('clients')
                        ->where('id', $request->id)
                        ->update([
                            'name' => $request->name,
                            'photo' => $filenameImage,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Update Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
                else{
                    if($request->hasFile('photo')) {
                        $image       = $request->file('photo');
                        $filenameImage    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 270);
                        $image_resize->save(public_path('images/' .$filenameImage));
                    }
                    $result = DB::table('clients')->insert([
                        'name' => $request->name,
                        'photo' => $filenameImage,
                    ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Insert Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }

    }

    public function getClientsById(Request $request){
        try{
            $rows = DB::table('clients')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteClientList(Request $request){
        try{

            if($request->id) {
                $result =DB::table('clients')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'Data Delete Successfully.');
                } else {
                    return back()->with('errorMessage', 'Please Try Again.');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function users(){
        try{
            $rows = DB::table('users')->paginate(50);
            return view('admin.users', ['users' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertUsers (Request $request){
        try{
            if($request) {
                if ($request->id) {
                    $filenameImage = '';
                    if($request->hasFile('photo')) {
                        $image       = $request->file('photo');
                        $filenameImage    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 270);
                        $image_resize->save(public_path('images/' .$filenameImage));
                    }
                    $result =DB::table('users')
                        ->where('id', $request->id)
                        ->update([
                            'name' => $request->name,
                            'phone' => $request->phone,
                            'email' => $request->email,
                            'password' => $password = Hash::make($request->password),
                            'photo' => $filenameImage,
                            'role' => 1,
                        ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Update Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
                else{
                    $filenameImage = '';
                    if($request->hasFile('photo')) {
                        $image       = $request->file('photo');
                        $filenameImage    = time() . '.' .$image->getClientOriginalName();
                        $image_resize = Image::make($image->getRealPath());
                        $image_resize->resize(370, 270);
                        $image_resize->save(public_path('images/' .$filenameImage));
                    }
                    $result = DB::table('users')->insert([
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'password' => $password = Hash::make($request->password),
                        'photo' => $filenameImage,
                        'role' => 1,
                    ]);
                    if ($result) {
                        return back()->with('successMessage', 'Data Insert Successfully Done.');
                    } else {
                        return back()->with('errorMessage', 'Please Try Again.');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please Fill Up The Form.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }

    }
    public function getUsersById(Request $request){
        try{
            $rows = DB::table('users')
                ->where('id', $request->id)
                ->first();
            return response()->json(array('data'=>$rows));
        }
        catch(\Illuminate\Database\QueryException $ex){
            return response()->json(array('data'=>$ex->getMessage()));
        }
    }
    public function deleteUserList(Request $request){
        try{

            if($request->id) {
                $result =DB::table('users')
                    ->where('id', $request->id)
                    ->delete();
                if ($result) {
                    return back()->with('successMessage', 'Data Delete Successfully.');
                } else {
                    return back()->with('errorMessage', 'Please Try Again.');
                }
            }
            else{
                return back()->with('errorMessage', 'Please Try Again.');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function receivedEmail(){
        try{
            $rows = DB::table('received_email')->orderBy('id','desc')->paginate(50);
            return view('admin.receivedEmail', ['emails' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function orderDetails(){
        try{
            $products = DB::table('orders')
                ->select('*','orders.id as p_id','artwork.name as a_name','orders.art_value as a_value')
                ->join('artwork','artwork.id','=','orders.product_id')
                ->join('users','users.id','=','orders.user_id')
                ->orderBy('orders.id','desc')
                ->paginate(20);
            return view('admin.orderDetails', ['products' => $products]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}
