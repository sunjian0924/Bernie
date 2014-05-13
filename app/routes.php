<?php

/*
   |--------------------------------------------------------------------------
   | Application Routes
   |--------------------------------------------------------------------------
   |
   | Here is where you can register all of the routes for an application.
   | It's a breeze. Simply tell Laravel the URIs it should respond to
   | and give it the Closure to execute when that URI is requested.
   |
 */

Route::get('/', 'HomeController@showWelcome');
//Route::get('login', array('as' => 'login', 'uses' =>'UserController@showLogin'));
//login page
Route::get('login', 'UserController@showLogin');
Route::post('courseRetrieve', 'UserController@postCourses');

Route::get('logout', 'UserController@getLogout');

Route::get('about', 'HomeController@showAbout');


Route::group(array('before' => 'auth'), function()
{
    Route::get('clients', 'ClientsController@showClients');
    Route::post('clients', array(
      'as' => 'postClients',
      'uses' => 'ClientsController@postClients'
      ));
    //Cart
    Route::get('tutors', 'TutorsController@showTutors');
    Route::post('tutors', array(
      'as' => 'postCart',
      'uses' => 'TutorsController@postTutors'
    ));
    //Records
    Route::get('records', 'ClientsController@showRecords');
    Route::post('records', array(
      'as' => 'postRecords',
      'uses' => 'ClientsController@postRecords'
    ));

    Route::get('profile', 'UserController@showProfile');

    Route::get('shopping', 'HomeController@showShopping');
    Route::post('shopping', array(
      'as' => 'postShopping',
      'uses' => 'HomeController@postShopping'
    ));

    
    
    Route::get('admin', 'AdminsController@showAdmins');
    Route::post('admin', 'AdminsController@postAdmins');


});


Route::group(array('before' => 'csrf'), function()
{
    
});



