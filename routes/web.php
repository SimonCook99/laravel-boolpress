<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::middleware("auth") //controllo di autenticazione gestito direttamente qui
    ->namespace("Admin") //le rotte inserite faranno parte del namespace "Admin" (Ossia la cartella di HomeController)
    ->name("admin.") //Il nome delle rotte inserite, inizierà con "admin." (come in questo caso admin.home)
    ->prefix("admin") //gli URL delle rotte inserite, inizieranno col prefisso "admin" (come in questo caso admin/home)
    ->group(function(){

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource("posts", "PostController");

    Route::resource("tags", "TagController");

    //rotta per la vista di editing delle informazioni dell'utente
    Route::get("user", "UserController@edit")->name("users.edit");

    //metodo put per l'effettivo aggiornamento dei dati dell'utente nel database
    Route::put("user", "UserController@update")->name("users.update");
});


Route::get("{any?}", function(){
    return view("guests.home");
    /* phpinfo(); */
})->where("any", ".*");


