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

// MAIL
// Route::get('/sendtestmail', 'MailTestController@sendMail');
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
Route::resource('projects', 'ProjectsController');

// STORE CREDITS
Route::POST('/projects/{project}/addCredits', 'ProjectsController@addCredits');

// ADD COMMENT TO PROJECT
Route::POST('/projects/{project}/addComment', 'ProjectsController@addComment');

// ADD TO NEWVIEW
Route::POST('/projects/{project}/addNewsView', 'ProjectsController@addNewsView');

// PDF PROJECT
Route::get('generate-pdf/{project_id}', 'PdfGenerateController@pdfview')->name('generate-pdf');
// PDF SPONSORD
Route::get('generate-sponsor-pdf', 'PdfGenerateController@sponsorpdfview')->name('generate-sponsor-pdf');
// PDF SEE YOUR SPONSORS
Route::get('yoursponsors/{project_id}', 'PdfGenerateController@seeyoursponsorpdfview')->name('yoursponsors');


// GIFTS
Route::get('/gifts', 'GiftsController@gifts')->name('gifts');

// IMG
Route::post('/projects/{project}/upload', 'ImageUploadController@store')->name('store');

