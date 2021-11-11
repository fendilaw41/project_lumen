<?php

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

 //***************** KEY GENERATE ******************\\
$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});

 //***************** END KEY GENERATE ******************\\


$router->group(['middleware' => 'auth','prefix' => 'api'], function ($router) 
{
    //***************** USER ******************\\
    $router->get('alluser', 'AuthController@index');
    //***************** END USER ******************\\
   //***************** POSTS ******************\\
    $router->get('/posts','PostController@index');
    $router->post('/posts','PostController@store');
    $router->get('/posts/{id}','PostController@show');
    $router->post('/posts/{id}','PostController@update');
    $router->delete('/posts/{id}','PostController@destroy');
    //***************** END POSTS ******************\\

      //***************** POSTS FIREBASE ******************\\
    $router->get('/firebase','FirebaseController@index');
    $router->post('/firebase','FirebaseController@store');
    // $router->get('/firebase/{id}','FirebaseController@show');
    // $router->post('/firebase/{id}','FirebaseController@update');
    // $router->delete('/firebase/{id}','FirebaseController@destroy');
    //***************** END POSTS FIREBASE ******************\\
  

     //***************** CUSTOMER ******************\\
    $router->get('/customers','CustomerController@index');
    $router->post('/customers','CustomerController@store');
    $router->get('/customers/{id}','CustomerController@show');
    $router->post('/customers/{id}','CustomerController@update');
    $router->delete('/customers/{id}','CustomerController@destroy');
    //***************** END CUSTOMER ******************\\


});

$router->group(['prefix' => 'api'], function () use ($router) 
{
     //***************** AUTH JWT ******************\\
    $router->post('/register','AuthController@register');
    $router->post('/login','AuthController@login');
    $router->post('/logout','AuthController@destoyToken');
     //***************** END AUTH JWT ******************\\
});







