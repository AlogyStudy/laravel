<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| 后台
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['web'], 'prefix' => 'admins', 'namespace' => 'Admin'], function () {
    Route::any('login', 'LoginController@login');
    Route::get('code', 'LoginController@code');
});


Route::group(['middleware' => ['web', 'admin.login'], 'prefix' => 'admin', 'namespace' => 'Admin'], function() {

    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::get('quit', 'LoginController@quit');
    Route::any('pass', 'IndexController@pass');


    Route::any('uploads', 'CommonController@uploadImg');

    // 分类资源路由
    Route::resource('category', 'CategoryController');
    Route::post('cate/changeorder', 'CategoryController@changeOrder');

    // 文章资源路由
    Route::resource('article', 'ArticleController');

    // 友情链接路由
    Route::resource('links', 'LinksController');
    Route::post('links/changeorder', 'LinksController@changeOrder');


    // 导航
    Route::resource('navs', 'NavsController');
    Route::post('navs/changeorder', 'NavsController@changeOrder');

    // 网站配置
    Route::post('configs/changeorder', 'ConfigController@changeOrder');
    Route::any('configs/changecontent', 'ConfigController@changeContent');
    Route::get('configs/putfile', 'ConfigController@putFile');
    Route::resource('configs', 'ConfigController');

    // markdown 图片上传
    Route::controllers([
        'upload'=>'UploadFileController'
    ]);

});



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'Home\IndexController@index');
    Route::get('/cate', 'Home\IndexController@cateAll');
    Route::get('/cate/{cate_id}', 'Home\IndexController@cate');
    Route::get('/wechat', 'Home\IndexController@wechat');
    Route::get('/movie', 'Home\IndexController@movie');
    Route::get('/about', 'Home\IndexController@about');
    Route::get('/art/{art_id}', 'Home\IndexController@article');

});