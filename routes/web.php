<?php

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/' , 'WebsiteController@index');
Route::get('about' , 'WebsiteController@about');
Route::get('project-details' , 'WebsiteController@projectDetails');
Route::get('all-projects' , 'WebsiteController@allProjects');
Route::get('contact' , 'WebsiteController@contact');
Route::get('all-services' , 'WebsiteController@allServices');
Route::get('service' , 'WebsiteController@service');
Route::get('product' , 'WebsiteController@product');
Route::post('send-mail' , 'WebsiteController@sendMail');
Route::get('client' , 'WebsiteController@client');
Route::get('logout' , 'AuthController@logout');
Route::post('verifyUser' , 'AuthController@verifyUsers');
Route::get('/login', function () {
    return view('admin.login');
});Route::get('/signup', function () {
    return view('admin.signup');
});
Route::post('insertCustomer' , 'AuthController@insertCustomer');
Route::post('insertNewOrder' , 'WebsiteController@insertNewOrder');
Route::get('myProfile' , 'WebsiteController@myProfile');

if(Cookie::get('role') != null){
    Route::get('home' , 'SettingController@company_info');

    Route::post('insertCompanyInfo' , 'SettingController@insertCompanyInfo');
    Route::post('getCompanyInfoById' , 'SettingController@getCompanyInfoById');

    Route::get('mainSlide' , 'SettingController@mainSlide');
    Route::post('insertMainSlide' , 'SettingController@insertMainSlide');
    Route::post('getMainSlideById' , 'SettingController@getMainSlideById');
    Route::post('deleteSlideList' , 'SettingController@deleteSlideList');

    Route::get('motherType' , 'SettingController@type');
    Route::post('insertType' , 'SettingController@insertType');
    Route::post('getTypesById' , 'SettingController@getTypesById');
    Route::post('deleteTypeList' , 'SettingController@deleteTypeList');

    Route::get('servicesAdmin' , 'SettingController@servicesAdmin');
    Route::post('insertServices' , 'SettingController@insertServices');
    Route::post('getServicesById' , 'SettingController@getServicesById');
    Route::post('deleteServiceList' , 'SettingController@deleteServiceList');

    Route::get('subCategory' , 'SettingController@subCategory');
    Route::post('insertSubCategory' , 'SettingController@insertSubCategory');
    Route::post('getSubCategoryById' , 'SettingController@getSubCategoryById');
    Route::post('deleteSubCategoryList' , 'SettingController@deleteSubCategoryList');

    Route::get('projects' , 'SettingController@projects');
    Route::post('insertProjects' , 'SettingController@insertProjects');
    Route::post('getProjectById' , 'SettingController@getProjectById');
    Route::post('deleteProjectList' , 'SettingController@deleteProjectList');

    Route::get('artwork' , 'SettingController@artwork');
    Route::post('insertArtWork' , 'SettingController@insertArtWork');
    Route::post('getArtworkById' , 'SettingController@getArtworkById');
    Route::post('deleteArtworkList' , 'SettingController@deleteArtworkList');
    Route::get('orderDetails' , 'SettingController@orderDetails');


    Route::get('clients' , 'SettingController@clients');
    Route::post('insertClients' , 'SettingController@insertClients');
    Route::post('getClientsById' , 'SettingController@getClientsById');
    Route::post('deleteClientList' , 'SettingController@deleteClientList');
    Route::get('users' , 'SettingController@users');
    Route::post('insertUsers' , 'SettingController@insertUsers');
    Route::post('getUsersById' , 'SettingController@getUsersById');
    Route::post('deleteUserList' , 'SettingController@deleteUserList');
    Route::get('receivedEmail' , 'SettingController@receivedEmail');
}
Route::get('getCategoryListAll' , 'SettingController@getCategoryListAll');
Route::get('getSubCatIdListAll' , 'SettingController@getSubCatIdListAll');
Route::get('searchProduct' , 'WebsiteController@searchProduct');
Route::get('customOrder' , 'WebsiteController@customOrder');
Route::get('project-artwork' , 'WebsiteController@projectArtwork');
