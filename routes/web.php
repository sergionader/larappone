<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [
    // 'middleware' => ['auth'],
    'uses' => 'HomeController@dashboardHome',
    'as' => 'app.dashboard'
]);
Route::get('/stack', [
    'uses' => 'HomeController@oldStack',
    'as' => 'stack'
]);

Route::get('/users', [
    'uses' => 'UserController@index',
    'as' => 'users'
]);

Route::post('/bitbucket', [
    'uses' => 'BitBucketController@index',
    'as' => 'bitbucket'
]);

Route::group(['prefix' => '/app', 'middleware' => ['auth']], function () {
    Route::get('/', [
        'uses' => 'ProductVisitWeb@index',
        'as' => 'app.index'
    ]);

    Route::get('/edit/{id}', [
        'uses' => 'ProductVisitWeb@edit',
        'as' => 'app.edit',
    ]);
    Route::get('/create', [
        'uses' => 'ProductVisitWeb@create',
        'as' => 'app.create',
    ]);
    Route::post('/update', [
        'uses' => 'ProductVisitWeb@update',
        'as' => 'app.update',
    ]);
    Route::post('/store', [
        'uses' => 'ProductVisitWeb@store',
        'as' => 'app.store',
    ]);
    Route::get('/destroy/{id}', [
        'uses' => 'ProductVisitWeb@destroy',
        'as' => 'app.destroy',
    ]);
    Route::get('/destroy_product_visit/{id}', [
        'uses' => 'ProductVisitWeb@destroyProductVisit',
        'as' => 'app.product.visit.destroy',
    ]);
    // USER
    Route::get('/user', [
        'uses' => 'UserController@index',
        'as' => 'app.user.index'
    ]);
});

// DOCS
Route::group(['prefix' => '/docs'], function () {
    Route::get('/api', [
        'uses' => 'ProductVisitApi@apiHome',
        'as' => 'api.index'
    ]);

    Route::get('/api/doc', [
        'uses' => 'HomeController@apiDoc',
        'as' => 'api.doc'
    ]);
    Route::get('/db', [
        'uses' => 'HomeController@dbHome',
        'as' => 'db.index'
    ]);
    Route::get('/elasticsearch', [
        'uses' => 'HomeController@elasticsearchHome',
        'as' => 'elasticsearch.index'
    ]);
    Route::get('/project', [
        'uses' => 'HomeController@projectHome',
        'as' => 'docs.project.index'
    ]);
    Route::get('/tests', [
        'uses' => 'HomeController@testsHome',
        'as' => 'docs.tests.index'
    ]);
    Route::get('/author', [
        'uses' => 'HomeController@authorDocsHome',
        'as' => 'docs.author.index'
    ]);
    Route::get('/author/contact', [
        'uses' => 'HomeController@contactDocsHome',
        'as' => 'docs.author.contact'
    ]);

    Route::post('/author/contact/store', [
        'uses' => 'ContactController@store',
        'as' => 'docs.author.contact.store'
    ]);
    Route::get('/technicalnotes', [
        'uses' => 'HomeController@technicalNotes',
        'as' => 'docs.technicalnotes.index'
    ]);
    Route::get('/laravel', [
        'uses' => 'HomeController@laravelHome',
        'as' => 'docs.laravel.index'
    ]);
    Route::get('/laravel/todo', [
        'uses' => 'HomeController@laravelTodoHome',
        'as' => 'docs.laravel.todo'
    ]);
    Route::get('/test/api', [
        'uses' => 'HomeController@testsApi',
        'as' => 'docs.tests.api'
    ]);
    Route::get('/pages/add', [
        'uses' => 'HomeController@addDocsHome',
        'as' => 'docs.pages.add.index'
    ]);
    Route::get('/pages/auth', [
        'uses' => 'HomeController@authDocsHome',
        'as' => 'docs.pages.auth.index'
    ]);
    Route::get('/pages/charts/', [
        'uses' => 'HomeController@chartsDocsHome',
        'as' => 'docs.pages.charts.index'
    ]);
    Route::get('/pages/dashboard/', [
        'uses' => 'HomeController@dashboardDocsHome',
        'as' => 'docs.pages.dashboard.index'
    ]);
    Route::get('/pages/crud/datarange', [
    'uses' => 'HomeController@dataRangeDocs',
    'as' => 'docs.pages.crud.daterange'
    ]);
    Route::get('/pages/datagenerator/', [
        'uses' => 'HomeController@datageneratorDocsHome',
        'as' => 'docs.pages.datagenerator.index'
    ]);
    Route::get('/pages/edit', [
        'uses' => 'HomeController@editDocsHome',
        'as' => 'docs.pages.edit.index'
    ]);
    Route::get('/pages/layout', [
        'uses' => 'HomeController@layoutDocsHome',
        'as' => 'docs.pages.layout.index'
    ]);
    Route::get('/pages/list', [
        'uses' => 'HomeController@listDocsHome',
        'as' => 'docs.pages.list.index'
    ]);

    Route::get('/stack', [
        'uses' => 'HomeController@stackDocsHome',
        'as' => 'docs.stack.index'
    ]);

    //
});

Route::get('curl/createrecords', [
    'uses' => 'DbController@createRecords',
    'as' => 'curl.createrecords'
]);

//** HELPERS  */
Route::group(['prefix' => 'helpers', 'middleware' => ['auth']], function () {
    Route::get('/tables', [
        'uses' => 'DbController@listTables',
        'as' => 'tables'
    ]);

    Route::get('/createrecords', [
        'uses' => 'DbController@createRecords',
        'as' => 'helpers.createrecords'
    ]);

    Route::get('/populatedb', [
        'uses' => 'DbController@populateDB',
        'as' => 'helpers.populatedb'
    ]);

    Route::get('/migratedb', [
        'uses' => 'DbController@migrateDB',
        'as' => 'helpers.migratedb'
    ]);
    Route::get('/biasedrandomizer', [
        'uses' => 'DbController@biasedRandomizer',
        'as' => 'helpers.biasedrandomizer'
    ]);
    //test
    Route::get('/gettypes', [
        'uses' => 'DbController@getTypes',
        'as' => 'helpers.gettypes'
    ]);

    Route::get('/cachetest', [
        'uses' => 'DbController@cacheTest',
        'as' => 'helpers.cachetest'
    ]);

    Route::get('/sortorder/{model_name}', [
        'uses' => 'DbController@sortOrder',
        'as' => 'helpers.sortorder'
    ]);
});

//** DASHBOARD */
Route::get('/dashboard', [
    'uses' => 'HomeController@dashboardHome',
    'as' => 'dashboard.index'
]);

//////// CHARTS////////////
Route::group(['prefix' => '/charts', 'middleware' => ['auth']], function () {
    // LOADER
    Route::get('/chartloader', [
        'uses' => 'ChartController@chartLoader',
        'as' => 'charts.chartloader'
    ]);

    //////// CHARTS////////////
    //**************** DATA
    Route::post('/data/chart/chartdonut', [
            'uses' => 'ChartController@PostAllTypesSubtypes',
            'as' => 'charts.data.chartDonut'
        ]);
    Route::post('/data/subtypeproductbytype', [
        'uses' => 'ChartController@PostSubTypeProductByType',
        'as' => 'charts.data.subtypeproductbytype'
        ]);

    Route::post('/data/salesbymonth', [
            'uses' => 'ChartController@PostSalesByMonth',
            'as' => 'charts.data.salesbymonth'
        ]);

    Route::post('/data/chartstackedsolumns', [
            'uses' => 'ChartController@PostSalesByMonthByType',
            'as' => 'charts.data.chartstackedsolumns'
        ]);
    Route::post('/data/conversionratebydates', [
            'uses' => 'ChartController@PostConversionRatebyDates',
            'as' => 'charts.data.conversionratebydates'
        ]);
    Route::post('/data/chartarea', [
            'uses' => 'ChartController@PostConversationRateComparasionByDate',
            'as' => 'charts.data.chartarea'
        ]);
    Route::post('/data/chart/chartmap', [
            'uses' => 'ChartController@PostSalesByOriginByDate',
            'as' => 'charts.data.chartmap'
        ]);
});

Route::get('/charts/simpledata', [
    'uses' => 'ChartController@simpleData',
    'as' => 'charts.simpledata'
]);
/////////////////////////

// // apphtml
Route::group(['prefix' => '/apphtml', 'middleware' => ['auth']], function () {
    Route::get('/', [
        'uses' => 'VisitController@getAll',
        'as' => 'apphtml.index'
    ]);
    // NEW/INSERT
    // load the form and its combos
    Route::get('/new', [
        'uses' => 'VisitController@getVisitNew',
        'as' => 'apphtml.new'
    ]);
    // get the data from the form, validate them and ->save visits and product_visits
    Route::post('/insert', [
        'uses' => 'VisitController@postVisitInsert',
        'as' => 'apphtml.insert'
    ]);

    //EDIT/UPDATAE
    // load the form and its combos plus the id in hidden field
    Route::get('/edit/{id}', [
        'uses' => 'VisitController@getVisitEdit',
        'as' => 'apphtml.edit'
    ]);
    // get the data from the form, validate them and update->save visits and product_visits
    Route::post('/update', [
        'uses' => 'VisitController@postVisitUpdate',
        'as' => 'apphtml.update'
    ]);
    //DELETE
    Route::get('delete/{id}', [
        'uses' => 'VisitController@getVisitDelete',
        'as' => 'apphtml.delete'
    ]);
    Route::get('deleteproduct', [
        'uses' => 'VisitController@getVisitProductDelete',
        'as' => 'apphtml.deleteproduct'
    ]);
});

Route::get('/datatables.visits', [
    'uses' => 'ProductVisitWeb@getVisits',
    'as' => 'datatables.visits'
]);

// Route::get('/serverSide', [
//     'uses' => 'ProductVisitWeb@getUsers',
//     'as' => 'serverSide'
// ]);

Route::group(['prefix' => 'api/v1/'], function () {
    Route::resource('visit', 'ProductVisitApi');
    // **************************************************** //
    // GET      api/v1/visit            =   visit.index
    // POST     api/v1/visit            =   visit.store
    // POST     api/v1/visit/create     =   visit.create
    // GET      api/v1/visit/{id}       =   visit.show
    // PUT      api/v1/visit/{id}       =   visit.update
    // DELETE   api/v1/visit/{id}       =   visit.destroy
    // EDIT     api/v1/visit/{id}/edit  =   visit.edit
    // **************************************************** //

    Route::resource('product', 'ProductControllerApi'); //remove product from the edit page

    Route::post('user', [
        'uses' => 'AuthController@store'
    ]);
    Route::post('user/signin', [
        'uses' => 'AuthController@signin'
    ]);
    Route::resource('product', 'ProductControllerApi');
    Route::post('user', [
        'uses' => 'AuthController@store'
    ]);
    Route::post('user/signin', [
        'uses' => 'AuthController@signin'
    ]);
    Route::resource('product', 'ProductControllerApi');
});

Auth::routes();

//* TESTS //

Route::get('/visits_2018', [
    'middleware' => ['auth'],
    'uses' => 'DbController@visits_2018',
    'as' => 'app.visits_2018'
]);
