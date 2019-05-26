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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sendtestmail', 'MailTestController@sendMail');
Auth::routes();

// HOME - PRIVACY - PROFILE
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/privacy', 'HomeController@privacy')->name('privacy');
Route::get('/profile', 'HomeController@profile')->name('profile');

// PAYMENT
Route::get('stripe', 'PaymentController@getStripeForm');
Route::post('stripe', 'PaymentController@postStripePayment')->name('stripe.post');

// API ROUTES
Route::post('api/convert', 'APIController@postConvert')->name('api.convert');


// SEE, ADD, UPDATE & DELETE PROJECT
// Route::get('/projects', 'ProjectsController@index');
// Route::get('/create', 'ProjectsController@create');
// Route::get('/projects/{project}', 'ProjectsController@show');
// Route::post('/projects', 'ProjectsController@store');
// Route::get('/projects/{project}/edit', 'ProjectsController@edit');
// Route::patch('/projects/{project}', 'ProjectsController@update');
// Route::delete('/projects/{project}', 'ProjectsController@destroy');
Route::resource('projects', 'ProjectsController');

// STORE CREDITS
Route::POST('/projects/{project}/addCredits', 'ProjectsController@addCredits');

// ADD COMMENT TO PROJECT
Route::POST('/projects/{project}/addComment', 'ProjectsController@addComment');

// PDF
Route::get('generate-pdf', 'PdfGenerateController@pdfview')->name('generate-pdf');

