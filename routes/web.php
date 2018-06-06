<?php

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

use App\Task;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('login/github', 'Auth\LoginController@redirectToProvider');

Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/home', function(){
	$tasks = Task::orderBy('created_at', 'asc')->get();

	return view('home', [
		'tasks' => $tasks
	]);
})->name('home');

/* Add a new task */
Route::post('/task', function(Request $request){

	$validator = Validator::make($request->all(), [
		'name' => 'required|max:255',
	]);

	if ($validator->fails()) {
		return redirect('/home')
			->withInput()
			->withErrors($validator);
	}

	$task = new Task;
	$task->name = $request->name;
	$task->complete = $request->complete;
	$task->save();

	return redirect('home');

});

/* Get a task */
Route::get('/task/{id}', function($id) {
	$task = Task::find($id);
	return view('edit', compact('task'));
});

/* Update a task */
Route::post('/task/{id}', function($id, Request $request) {
	$validator = Validator::make($request->all(), [
		'name' => 'required|max:255',
	]);

	if ($validator->fails()) {
		return redirect('/home')
			->withInput()
			->withErrors($validator);
	}

	$task = Task::find($id);
	$task->name = $request->name;
	$task->complete = $request->complete;
	$task->save();

	return redirect('home');
});

/* Delete an existing task */

Route::delete('/task/{id}', function($id) {
	Task::findOrFail($id)->delete();

	return redirect('home');
});