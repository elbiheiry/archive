<?php
Route::group(['prefix' => 'admin','namespace' => 'Admin'] ,function (){
    /**
     * Authentication routes
     */
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::get('/', 'AuthController@getIndex');
        Route::get('/login', 'AuthController@getIndex');
        Route::post('/login', 'AuthController@postLogin')->name('admin.login');
        Route::get('/logout', 'AuthController@getLogout')->name('admin.logout');
    });

    Route::group(['middleware' => 'auth.admin'] ,function (){

        /**
         * dashboard page routes
         */
        Route::get('/' ,['as' => 'admin.dashboard' ,'uses' => 'HomeController@getIndex']);

        /**
         * settings routes
         */
        Route::group(['prefix' => 'settings'] ,function (){
            Route::get('/' ,['as' => 'admin.settings' ,'uses' => 'SettingController@getIndex']);
            Route::post('/' ,['as' => 'admin.settings' ,'uses' => 'SettingController@postIndex']);
        });

        /*
         * profile routes
         */
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', ['as' => 'admin.profile', 'uses' => 'ProfileController@getIndex']);
            Route::post('/', ['as' => 'admin.profile', 'uses' => 'ProfileController@postIndex']);
        });

        /**
         * users routes
         */
        Route::group(['prefix' => 'users'] ,function (){
            Route::get('/' ,['as' => 'admin.users' ,'uses' => 'UserController@getIndex']);
            Route::post('/' ,['as' => 'admin.users' ,'uses' => 'UserController@postIndex']);
            Route::get('/edit/{id}' ,['as' => 'admin.users.edit' ,'uses' => 'UserController@getEdit']);
            Route::post('/edit/{id}' ,['as' => 'admin.users.edit' ,'uses' => 'UserController@postEdit']);
            Route::post('/delete/{id}' ,['as' => 'admin.users.change' ,'uses' => 'UserController@postChangeType']);
        });

        /**
         * categories routes
         */
        Route::group(['prefix' => 'categories'] ,function (){
            Route::get('/', ['as' => 'admin.categories' ,'uses' => 'CategoryController@getIndex']);
            Route::post('/', ['as' => 'admin.categories' ,'uses' => 'CategoryController@postIndex']);
            Route::post('/edit/{id}', ['as' => 'admin.categories.edit' ,'uses' => 'CategoryController@postEdit']);
            Route::get('/delete/{id}' ,['as' => 'admin.categories.delete' ,'uses' => 'CategoryController@getDelete']);
        });

        /**
         * group routes
         */
        Route::group(['prefix' => 'groups'] ,function (){
            Route::get('/' ,['as' => 'admin.groups' ,'uses' => 'GroupController@getIndex']);
            Route::post('/' ,['as' => 'admin.groups' ,'uses' => 'GroupController@postIndex']);
            Route::post('/edit/{id}' ,['as' => 'admin.groups.edit' ,'uses' => 'GroupController@postEdit']);
            Route::get('/delete/{id}' ,['as' => 'admin.groups.delete' ,'uses' => 'GroupController@getDelete']);
        });

        /**
         * contracts routes
         */
        Route::group(['prefix' => 'contracts'] ,function (){
            Route::get('/' ,['as' => 'admin.contracts' ,'uses' => 'ContractController@getIndex']);
            Route::get('/edit/{id}' ,['as' => 'admin.contracts.edit' ,'uses' => 'ContractController@getEdit']);
            Route::post('/' ,['as' => 'admin.contracts' ,'uses' => 'ContractController@postIndex']);
            Route::post('/edit/{id}' ,['as' => 'admin.contracts.edit' ,'uses' => 'ContractController@postEdit']);
            Route::get('/delete/{id}' ,['as' => 'admin.contracts.delete' ,'uses' => 'ContractController@getDelete']);
//            Route::post('/send-email' ,['as' => 'admin.contracts.send' ,'uses' => 'ContractController@postSendEmail']);
        });

        /**
         * archives routes
         */
        Route::group(['prefix' => 'archives'] ,function (){
            Route::get('/to' ,['as' => 'admin.archives.to' ,'uses' => 'ArchiveController@getIndex']);
            Route::get('/from' ,['as' => 'admin.archives.from' ,'uses' => 'ArchiveController@getIndex1']);
            Route::post('/' ,['as' => 'admin.archives' ,'uses' => 'ArchiveController@postIndex']);
            Route::get('/edit/{id}' ,['as' => 'admin.archives.edit' ,'uses' => 'ArchiveController@getEdit']);
            Route::post('/edit/{id}' ,['as' => 'admin.archives.edit' ,'uses' => 'ArchiveController@postEdit']);
            Route::get('/delete/{id}' ,['as' => 'admin.archives.delete' ,'uses' => 'ArchiveController@getDelete']);
            Route::get('/single-archive/{id}' ,['as' => 'admin.archive.single' ,'uses' => 'ArchiveController@getSingleArchive']);
            Route::get('/delete-files/{id}' ,['as' => 'admin.files.delete' ,'uses' => 'ArchiveController@getDeleteFile']);
        });

        /**
         * image-archives routes
         */
        Route::group(['prefix' => 'image-archives'] ,function (){
            Route::get('/' ,['as' => 'admin.images' ,'uses' => 'ImageArchiveController@getIndex']);
            Route::post('/' ,['as' => 'admin.images' ,'uses' => 'ImageArchiveController@postIndex']);
            Route::get('/edit/{id}' ,['as' => 'admin.images.edit' ,'uses' => 'ImageArchiveController@getEdit']);
            Route::post('/edit/{id}' ,['as' => 'admin.images.edit' ,'uses' => 'ImageArchiveController@postEdit']);
            Route::get('/delete/{id}' ,['as' => 'admin.images.delete' ,'uses' => 'ImageArchiveController@getDelete']);
            Route::get('/single-archive/{id}' ,['as' => 'admin.images.single' ,'uses' => 'ImageArchiveController@getSingleArchive']);
            Route::get('/images-files/{id}' ,['as' => 'admin.images.files.delete' ,'uses' => 'ImageArchiveController@getDeleteFile']);
        });

        /**
         * form-archives routes
         */
        Route::group(['prefix' => 'form-archives'] ,function (){
            Route::get('/' ,['as' => 'admin.forms' ,'uses' => 'FormArchiveController@getIndex']);
            Route::post('/' ,['as' => 'admin.forms' ,'uses' => 'FormArchiveController@postIndex']);
            Route::get('/edit/{id}' ,['as' => 'admin.forms.edit' ,'uses' => 'FormArchiveController@getEdit']);
            Route::post('/edit/{id}' ,['as' => 'admin.forms.edit' ,'uses' => 'FormArchiveController@postEdit']);
            Route::get('/delete/{id}' ,['as' => 'admin.forms.delete' ,'uses' => 'FormArchiveController@getDelete']);
            Route::get('/single-archive/{id}' ,['as' => 'admin.forms.single' ,'uses' => 'FormArchiveController@getSingleArchive']);
        });

        /**
         * video-archives routes
         */
        Route::group(['prefix' => 'video-archives'] ,function (){
            Route::get('/' ,['as' => 'admin.videos' ,'uses' => 'VideoArchiveController@getIndex']);
            Route::post('/' ,['as' => 'admin.videos' ,'uses' => 'VideoArchiveController@postIndex']);
            Route::get('/edit/{id}' ,['as' => 'admin.videos.edit' ,'uses' => 'VideoArchiveController@getEdit']);
            Route::post('/edit/{id}' ,['as' => 'admin.videos.edit' ,'uses' => 'VideoArchiveController@postEdit']);
            Route::get('/delete/{id}' ,['as' => 'admin.videos.delete' ,'uses' => 'VideoArchiveController@getDelete']);
            Route::get('/single-archive/{id}' ,['as' => 'admin.videos.single' ,'uses' => 'VideoArchiveController@getSingleArchive']);
        });

        /**
         * card routes
         */
        Route::group(['prefix' => 'cards'] ,function (){
            Route::get('/' ,['as' => 'admin.cards' ,'uses' => 'CardController@getIndex']);
            Route::post('/' ,['as' => 'admin.cards' ,'uses' => 'CardController@postIndex']);
            Route::get('/edit/{id}' ,['as' => 'admin.cards.edit' ,'uses' => 'CardController@getEdit']);
            Route::post('/edit/{id}' ,['as' => 'admin.cards.edit' ,'uses' => 'CardController@postEdit']);
            Route::get('/delete/{id}' ,['as' => 'admin.cards.delete' ,'uses' => 'CardController@getDelete']);
            Route::get('/single-card/{id}' ,['as' => 'admin.cards.single' ,'uses' => 'CardController@getSingleCard']);
        });

        /**
         * search routes
         */
        Route::group(['prefix' => 'search'] ,function (){
            Route::get('/' ,['as' => 'admin.search' ,'uses' => 'SearchController@getIndex']);
            Route::get('/result' ,['as' => 'admin.result' ,'uses' => 'SearchController@getResult']);
        });
    });
});