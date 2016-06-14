<?php



Route::group(['middleware' => ['web']], function () {

	Route::group( array("prefix" => "admin"), function() {

    	Route::group(['middleware' => 'auth:dcms'], function() {

    		//USERS
    		Route::group(array("before"=>"admin.dcms"), function() {
    			Route::resource('customers','CustomersController');
    			Route::any('customers/api/table', array('as'=>'admin/customers/api/table', 'uses' => 'CustomersController@getDatatable'));
    		});
    });
  });
});



 ?>
