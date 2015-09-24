<?php


Blade::setContentTags('<%', '%>');
Blade::setEscapedContentTags('<%%','%%>');
Blade::setRawTags('<%%%', '%%%>');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('main');
});

Route::group(array('prefix' => 'directiveViews'), function()
{
    Route::get('{all}', function($all)
    {
        return View::make("directiveViews".".".$all);
    });
});


Route::post('admin/upload', ['as' => 'admin.upload', 'uses' => 'ServiceController@upload']);

Route::post('fileupload', 'ServiceController@upload');

Route::get('getServiceTypes','MenuController@getServiceTypes');

Route::get('getPayMethods','MenuController@getPayMethods');

Route::get('getMenu/{id}','MenuController@getMenu');

Route::post('postOrder','MenuController@postOrder');



Route::get('getOrderHistory/{HTL_ID}/{ST_TM}/{END_TM}','OrderHistoryController@getOrderHistory');
Route::post('updateStatus','OrderHistoryController@updateStatus');

Route::get('getOrder','OrderController@getOrder');
Route::post('updateStatus','OrderController@updateStatus');
Route::get('Change2Start/{ORDR_ID}','OrderController@Change2Start');
Route::get('Change2Finish/{ORDR_ID}','OrderController@Change2Finish');
Route::get('Change2Cancel/{ORDR_ID}','OrderController@Change2Cancel');

Route::get('getHotel','HotelController@getHotel');
Route::post('updateStatus','HotelController@updateStatus');
Route::get('getHotelTypes','HotelController@getHotelTypes');
Route::post('postHotelInfo','HotelController@postHotelInfo');
Route::get('getHotelInfo/{HTL_ID}','HotelController@getHotelInfo');
Route::get('Change2NormalHotel/{HTL_ID}','HotelController@Change2NormalHotel');
Route::get('Change2PauseHotel/{HTL_ID}','HotelController@Change2PauseHotel');
Route::get('Change2StopHotel/{HTL_ID}','HotelController@Change2StopHotel');
Route::post('updateHotelInfo','HotelController@updateHotelInfo');
Route::get('getServiceRelation/{HTL_ID}','HotelController@getServiceRelation');
Route::post('postNewRelation','HotelController@postNewRelation');
Route::get('deleteHotel/{HTL_ID}','HotelController@deleteHotel');
Route::get('getAllService','HotelController@getAllService');

Route::get('getService','ServiceController@getService');
Route::post('updateStatus','ServiceController@updateStatus');
Route::get('getServiceTypeNames','ServiceController@getServiceTypes');
Route::post('postServiceInfo','ServiceController@postServiceInfo');
Route::get('queryMerchant/{MRCHNT_NM}','ServiceController@queryMerchant');
Route::get('Change2NormalService/{CMB_ID}','ServiceController@Change2NormalService');
Route::get('Change2PauseService/{CMB_ID}','ServiceController@Change2PauseService');
Route::post('updateServiceInfo','ServiceController@updateServiceInfo');
Route::get('getServiceInfo/{CMB_ID}','ServiceController@getServiceInfo');
Route::get('getHotelRelation/{CMB_ID}','ServiceController@getHotelRelation');
Route::post('postServiceNewRelation','ServiceController@postServiceNewRelation');
Route::get('deleteService/{CMB_ID}','ServiceController@deleteService');
Route::get('getAllHotel','ServiceController@getAllHotel');
//Route::get('history','OrderHistoryController');
