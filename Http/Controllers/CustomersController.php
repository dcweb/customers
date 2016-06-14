<?php

namespace Dcms\Customers\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Input;
use View;
use Validator;
use Auth;
use Redirect;
Use Dcms\Customers\Models\Customers;
Use Datatable;
use DB;
use Hash;
use Session;

class CustomersController extends Controller
{
	/*****************************************************
	  CRUD METHODS
	*******************************************************/
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		// load the view and pass the users
		return View::make('dcms::customers/index');
			//->with('users', $users);
	}

	public function getDatatable()
	{
		return Datatable::Query(DB::connection("project")->table("subscribers"))
						->showColumns('firstname')
						->showColumns('lastname')
						->showColumns('email')
						->addColumn('edit',function($model){return '<form method="POST" action="/admin/customers/'.$model->id.'" accept-charset="UTF-8" class="pull-right"><input name="_token" type="hidden" value="'.csrf_token().'">					<input name="_method" type="hidden" value="DELETE">					<!-- <input class="btn btn-warning" type="submit" value="Delete this User"> -->
								<a class="btn btn-xs btn-default" href="/admin/customers/'.$model->id.'/edit"><i class="fa fa-pencil"></i></a>
							</form>';})
						->searchColumns('name','email')
						->make();
	}



	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$rules = array(
			'firstname'       => 'required',
			'lastname'       => 'required',
			'email'       => 'required',
		);
		$validator = Validator::make(Input::all(), $rules);


		// process the validator
		if ($validator->fails()) {
			return Redirect::to('admin/customers/create')
				->withErrors($validator)
				->withInput();
				//->withInput(Input::except());
		} else {
			// store
			$user = new Users;
			$user->firstname   		= Input::get('firstname');
			$user->lastname   	= Input::get('lastname');
			$user->email 		= Input::get('email');
			$user->save();

			// redirect
			Session::flash('message', 'Successfully created user!');
			return Redirect::to('admin/customers');
		}
	}



	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		// get the user
		$user = Users::find($id);
		$user->password = "";

		// show the edit form and pass the nerd
		return View::make('dcms::customers/form')
			->with('user', $user);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'firstname'       => 'required',
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('admin/customers/' . $id . '/edit')
				->withErrors($validator)
				->withInput();
		} else {
			// store
			$user = Users::find($id);
			$user->firstname		= Input::get('firstname');
			$user->lastname	= Input::get('lastname');
			$user->email	= Input::get('email');

			if (strlen(trim(Input::get('password')))>0){
				$user->password = Hash::make(Input::get('password'));
			}
			$user->save();

			// redirect
			Session::flash('message', 'Successfully updated user!');
			return Redirect::to('admin/customers');
		}
	}
	/*****************************************************
	 END CRUD METHODS
	*******************************************************/
}

 ?>
