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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::prefix('user')->group(function () {
        //tampilan
        Route::get('/', 'UserController@index')->name('user-index');
        Route::get('/search','UserController@search')->name('user-search');
        Route::get('/{iduser}', 'UserController@byId')->name('user-by-id');

        //crud
        Route::post('/publish', 'UserController@publish')->name('user-publish');
        Route::post('/put', 'UserController@put')->name('user-put');
        Route::post('/remove', 'UserController@remove')->name('user-remove');
    });

    Route::prefix('result')->group(function () {
        Route::get('/', 'ResultController@index')->name('result-index');

        //result
        Route::post('/create', 'ResultController@create')->name('result-create');
    });

    Route::prefix('project')->group(function () {
        //tampilan
        Route::get('/', 'ProjectController@index')->name('project-index');
        Route::get('/search','ProjectController@search')->name('project-search');
        // Route::get('create', 'ProjectController@add')->name('project-add');
        // Route::get('edit/{id}', 'ProjectController@edit')->name('project-edit');
        Route::get('/{idProject}', 'ProjectController@byId')->name('project-by-id');

        //crud
        Route::post('/publish', 'ProjectController@publish')->name('project-publish');
        Route::post('/put', 'ProjectController@put')->name('project-put');
        Route::post('/remove', 'ProjectController@remove')->name('project-remove');
    });

    Route::prefix('mom')->group(function() {
        //tampilan
        Route::get('/', 'MoMController@index')->name('mom-index');
        Route::get('create', 'MoMController@add')->name('mom-add');
        Route::get('edit/{id}', 'MoMController@edit')->name('mom-edit');
        Route::get('{id}/kesimpulan', 'MoMController@kesimpulan')->name('mom-kesimpulan');

        //crud
        Route::post('/publish', 'MoMController@publish')->name('mom-publish');
        Route::post('/put', 'MoMController@put')->name('mom-put');
        Route::post('/remove', 'MoMController@remove')->name('mom-remove');
        Route::post('/publish-kesimpulan', 'MoMController@publishKesimpulan')->name('mom-publish-kesimpulan');

        //daftar peserta
        Route::prefix('{id}/daftar-peserta')->group(function(){
            Route::get('/', 'DaftarPesertaController@index')->name('daftar-peserta-index');
            Route::get('/search','DaftarPesertaController@search')->name('daftar-peserta-search');

            //crud
            Route::post('/publish', 'DaftarPesertaController@publish')->name('daftar-peserta-publish');
            Route::post('/put', 'DaftarPesertaController@put')->name('daftar-peserta-put');
            Route::post('/remove', 'DaftarPesertaController@remove')->name('daftar-peserta-remove');
        });

        //pokok bahasan
        Route::prefix('{id}/pokok-bahasan')->group(function(){
            Route::get('/', 'PokokBahasanController@index')->name('pokok-bahasan-index');
            Route::get('/search','PokokBahasanController@search')->name('pokok-bahasan-search');

            //crud
            Route::post('/publish', 'PokokBahasanController@publish')->name('pokok-bahasan-publish');
            Route::post('/put', 'PokokBahasanController@put')->name('pokok-bahasan-put');
            Route::post('/remove', 'PokokBahasanController@remove')->name('pokok-bahasan-remove');

            //detail pokok bahasan
            Route::prefix('{idPokokBahasan}/detail-pokok-bahasan')->group(function(){
                Route::get('/', 'DetailPokokBahasanController@index')->name('detail-pokok-bahasan-index');

                //crud
                Route::post('/publish', 'DetailPokokBahasanController@publish')->name('detail-pokok-bahasan-publish');
                Route::post('/put', 'DetailPokokBahasanController@put')->name('detail-pokok-bahasan-put');
                Route::post('/remove', 'DetailPokokBahasanController@remove')->name('detail-pokok-bahasan-remove');
            });
        });

        //gallery
        Route::prefix('{id}/gallery')->group(function(){
            Route::get('/', 'GalleryController@index')->name('gallery-index');

            //crud
            Route::post('/publish', 'GalleryController@publish')->name('gallery-publish');
            Route::post('/put', 'GalleryController@put')->name('gallery-put');
            Route::post('/remove', 'GalleryController@remove')->name('gallery-remove');
        });

    });

    //api
    Route::prefix('daftar-peserta')->group(function () {
        Route::get('/{idPeserta}', 'DaftarPesertaController@byId')->name('daftar-peserta-by-id');
    });

    Route::prefix('detail-mom')->group(function () {
        Route::get('/{idMom}', 'MoMController@byId')->name('mom-by-id');
        Route::get('/by-project/{idProject}', 'MoMController@byProject')->name('mom-by-project');
    });

    Route::prefix('pokok-bahasan')->group(function () {
        Route::get('/{idPokokBahasan}', 'PokokBahasanController@byId')->name('pokok-bahasan-by-id');
    });

    Route::prefix('detail-pokok-bahasan')->group(function () {
        Route::get('/{idDetailPokokBahasan}', 'DetailPokokBahasanController@byId')->name('detail-pokok-bahasan-by-id');
    });

});
