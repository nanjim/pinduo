<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cats', function () {
    $cats = DB::table('cats')->where('in_use', '=', 1)->get();
    $data = [];
    foreach ($cats as $cat) {
        $cat_arr['id'] = $cat->id;
        $cat_arr['text'] = $cat->name;
        $data[] = $cat_arr;
    }
    return response()->json($data);
});

Route::post('/uploadImg', function (Request $request) {
//    $file = $request->input('file');
    $path = $request->file();
    return response()->json($path);
})->name('api.uploadImg');
