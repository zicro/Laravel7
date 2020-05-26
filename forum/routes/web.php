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

Route::get('/', function () {
    return view('home');
});

// prend deux parameters
/**
 * 1 : la route
 * 2 : le nom de la vue qui sera afficher
 */
Route::view('/', 'home');

Route::get('/about', function () {
    return view('about');
})->name('about');

// creation d'une routes avec segement dynamic + function anonyme
Route::get('/blog/{id}', function($id){
    return $id;
});

// creation d'une routes avec segement dynamic + function anonyme
// qui faire passer des donnes a une vue
# on peut rendre une parameter dans la route optional via l'utilisation
## du ? exp : `{author?}` et on lui donne une valeur par default
### dans la function anonyme
Route::get('/blogs/{id}/{author?}', function($myId, $myAuthor = 'default'){

    // les donnes qu'on veut les transmetre vers la view `show.blade.php`
    $posts = [
        1 => ['title' => 'learn data'],
        2 => ['title' => 'learn some thing']
    ];
    // on a posts qui est un dossier, et show le fichier
    return view('posts.home', [
        // dans la procedure de recuperation on va utilise le nom `data`
        // on utilise la valeur id passer on parameters, pour 
        // recuperer seulement les information demander par le lien
        'data' => $posts[$myId],
        'author' => $myAuthor
    ]);
});
# 2 eme Methode, utilisation d'une fuction definit dans le controller
Route::get('/blog/{id}/{author?}', 'HomeController@blog');


// ici on appel la methode definit dans le controller (HomeController.php)*
// qui permet l'appel du view Home qui a pour but d'afficher le cotenue 
// de la page (home.blade.php)
Route::get('/home', 'HomeController@home')->name('home');



// gennere only 2 routes (index, show) pour PostController
//Route::resource('/posts2', 'PostController')->only(['index', 'show', 'create', 'store']);


// gennere all routes sauf (destroy) pour PostController
//Route::resource('/posts3', 'PostController')->except(['destroy']);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/secret', 'HomeController@secret')
        ->name('secret')
        ->middleware('can:secret.page');

// gennere les 7 routess pour PostController
//Route::resource('/posts', 'PostController')->middleware('auth');
//Route::get('/home', 'HomeController@index')->name('home');



// il faut les ajouter en haut de Resources pour qu'il sa marche
Route::get('/posts/archive', 'PostController@archive');
Route::get('/posts/all', 'PostController@all');
Route::patch('/posts/{id}/restore', 'PostController@restore');
Route::delete('/posts/{id}/forcedelete', 'PostController@idelete');


// gennere les 7 routess pour PostController
Route::resource('/posts', 'PostController');


//Route::get('/post/', 'PostController@index')->name('post');

