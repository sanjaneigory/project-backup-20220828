<?php

use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Auth::routes();

Route::get('/plan/create', [

    'uses' => 'PlanController@create',

    'as' => 'plan.create'
]);

Route::get('/plans', [
    'uses' => 'PlanController@index',

    'as' => 'plans'

]);

Route::get('/subscribers', [
    'uses' => 'SubscriberController@index',

    'as' => 'suscribers'

]);

Route::get('/dashboard', 'DashboardController@index');
// Route::get('/system-management/{option}', 'SystemMgmtController@index');
Route::get('/profile', 'ProfileController@index');

Route::post('user-management/search', 'UserManagementController@search')->name('user-management.search');
Route::resource('user-management', 'UserManagementController');

Route::resource('employee-management', 'EmployeeManagementController');
Route::post('employee-management/search', 'EmployeeManagementController@search')->name('employee-management.search');

Route::resource('system-management/department', 'DepartmentController');
Route::post('system-management/department/search', 'DepartmentController@search')->name('department.search');

Route::resource('system-management/division', 'DivisionController');
Route::resource('system-management/division2', 'DivisionController');
Route::post('system-management/division/search', 'DivisionController@search')->name('division.search');

Route::resource('system-management/country', 'CountryController');
Route::post('system-management/country/search', 'CountryController@search')->name('country.search');

Route::resource('system-management/state', 'StateController');
Route::post('system-management/state/search', 'StateController@search')->name('state.search');

Route::resource('system-management/city', 'CityController');
Route::post('system-management/city/search', 'CityController@search')->name('city.search');

Route::get('system-management/report', 'ReportController@index');
Route::post('system-management/report/search', 'ReportController@search')->name('report.search');
Route::post('system-management/report/excel', 'ReportController@exportExcel')->name('report.excel');
Route::post('system-management/report/pdf', 'ReportController@exportPDF')->name('report.pdf');

Route::get('avatars/{name}', 'EmployeeManagementController@load');

Route::get('/request/simulator/{id}', 'SimulationController@simulator');

Route::post('/subscriber/store', [

    'uses' => 'SubscribersController@store',

    'as' => 'subscriber.store'
]);

Route::post('/department/store', [

    'uses' => 'DepartmentController@store',

    'as' => 'department.store'
]);

Route::post('/products', 'DepartmentController@store');

Route::get('/pagelink', 'YourController@callMeDirectlyFromUrl');

Route::post('/submit', function (Request $request) {

    $link = tap(new App\Subscriber([
        'sub_name' => $request->get('sub_name'),
        'sub_doc_id' => $request->get('sub_doc_id'),
        'sub_vendor' => $request->get('sub_vendor'),
        'sub_agent' => $request->get('sub_agent'),
        'sub_account_type' => $request->get('sub_account_type'),
        'sub_contract_no' => '1431243131341234123ABC',
    ]))->save();

    return redirect('/');
});