<?php

use Illuminate\Http\Request;
use App\Customer; 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

	Route::get('customers', function(){
 	    
	    return App\Customer::where('name','like','l%')->get();
	});
   //Route::patch
	Route::patch('customer/{id}', function(Request $request,$id) {
         
        App\Customer::findOrFail($id)->update($request->all());
      // return Response::json(Request::all());
    });
   
	Route::delete('customer/{id}', function($id){
        
        App\Customer::destroy($id);
         //vardump ($id); destroy
         return "ture" ; 
	});
  
     
  
     Route::post('customer', function(Request $request) {
        return App\Customer::create($request->all());
    });
   /*  */

