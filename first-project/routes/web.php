<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function (Request $request) {
    $id = 0;
    $id = $request->session()->get('user_id');
    if($id > 0){
        return redirect('/admin');
    } else {
        return view('login');
    }
});

Route::post('/', function (Request $request) {

    $results = DB::select('select * from users where login = "'.$_POST['login'].'" and password = "'.$_POST['password'].'"', array(1));
    $result = json_decode(json_encode($results), true);
    if($results){
        $request->session()->put('user_id', $result[0]['id']);
        $request->session()->put('name', $result[0]['login']);
        return redirect('/admin');
    } else {
        return redirect('/');
    }

});

Route::post('/admin/addCategorie', function (Request $request) {
    print_r($_POST);
    if($_POST['name'] != ''){
        DB::insert('insert into categories (name) values ("'.$_POST['name'].'")');
    }
    return redirect('/admin/categories');
});

Route::post('/admin/addProduct', function (Request $request) {
    print_r($_POST);
    if($_POST['name'] != '' && $_POST['category_id'] != ''){
        DB::insert('insert into products (`name`, `categorie_id`, `price`) values ("'.$_POST['name'].'", '.$_POST['category_id'].', '.$_POST['price'].')');
    }
    return redirect('/admin/products');
});

Route::get('/admin', function (Request $request) {
    return view('admin');
});

Route::get('/admin/categories', function (Request $request) {
    return view('categories');
});

Route::get('/admin/products', function (Request $request) {
    return view('products');
});

Route::get('/admin/dashboard', function (Request $request) {
    return redirect('/admin');
});

Route::get('/admin/logout', function (Request $request) {
    $request->session()->forget('user_id');
    $request->session()->forget('name');
    return redirect('/');
});

Route::get('/api/categories', function (Request $request) {
    $results = DB::select('select * from categories');
    $result = json_decode(json_encode($results), true);
    return $result;
});

Route::get('/api/products', function (Request $request) {
    $results1 = DB::select('select * from products');
    $result1 = json_decode(json_encode($results1), true);
    return $result1;
});
