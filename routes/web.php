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



Route::resource('post', 'PostController');


//IMÁGENES
Route::post('post/{post}/image', 'PostController@image')->name('post.image');
Route::post('post/content_image', 'PostController@contentImage');
Route::get('post/{post}/image-download/{image}', 'PostController@imageDownload')->name('post.image-download');
Route::delete('post/{post}/image-delete/{image}', 'PostController@imageDelete')->name('post.image-delete');


Route::resource('category', 'CategoryController');
Route::resource('user', 'UserController');
Route::resource('contact', 'ContactController')->only(['index','show','destroy']);
Route::resource('post-comment', 'PostCommentController')->only(['index','show','destroy']);

Route::get('post-comment/{post}/post', 'PostCommentController@post')->name('post-comment.post');
Route::get('post-comment/j-show/{postComment}', 'PostCommentController@jshow');
Route::post('post-comment/proccess/{postComment}', 'PostCommentController@proccess');



Route::get('/', 'web\WebController@index')->name('index');
Route::get('/detail{id}', 'web\WebController@detail');

Route::get('/categories', 'web\WebController@index')->name('index');


Route::get('/post-category{id}', 'web\WebController@post_category');

Route::get('/contact', 'web\WebController@contact');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//paquetes
Route::get('/chart', 'PaquetesController@charts')->name('chart');
Route::get('/image', 'PaquetesController@image')->name('image');
Route::get('/qr_qenerate', 'PaquetesController@qr_qenerate')->name('qr_qenerate');

Route::get('/excel/post-export', 'PostController@export')->name('post.export');
Route::get('/excel/post-import', 'PostController@import');

Route::get('/translate', 'PaquetesController@translate')->name('translate');
Route::get('/stripe_create_customer', 'PaquetesController@stripe_create_customer')->name('stripe_create_customer');
Route::get('/stripe_payment_method_register', 'PaquetesController@stripe_payment_method_register')->name('stripe_payment_method_register');
Route::get('/stripe_payment_method_create', 'PaquetesController@stripe_payment_method_create')->name('stripe_payment_method_create');
Route::get('/stripe_payment_method', 'PaquetesController@stripe_payment_method')->name('stripe_payment_method');
Route::get('/stripe_create_only_pay_form', 'PaquetesController@stripe_create_only_pay_form')->name('stripe_create_only_pay_form');
Route::get('/stripe_create_only_pay', 'PaquetesController@stripe_create_only_pay')->name('stripe_create_only_pay');
Route::get('/stripe_create_suscription', 'PaquetesController@stripe_create_suscription')->name('stripe_create_suscription');

