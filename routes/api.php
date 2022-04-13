<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//questo file Api.php, avrà al suo interno tutte le rotte con prefisso " api/ "

//www.miosito.it/api/posts
Route::get("/posts", "Api\PostController@index");

//www.miosito.it/api/posts/{slug} che varia in base al singolo post da mostrare
route::get("/posts/{slug}", "Api\PostController@show");
