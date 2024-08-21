<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
/*
UI Controller Start
*/
use App\Http\Controllers\SiteController;
use App\Http\Controllers\laptopController;
use App\Http\Controllers\kurtiController;
use App\Http\Controllers\menstshirtController;
use App\Http\Controllers\mobilesController;
use App\Http\Controllers\bedsController;
/*
Admin Controller Start
*/
use App\Http\Controllers\admin\LoginLogoutController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\BrandsController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\OptionsController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/',[SiteController::class,'index'])->name('siteindex');
Route::get('/home',[HomeController::class,'index'])->name('home');
Route::get('/Latop',[laptopController::class,'index'])->name('inedx');
Route::get('/kurti',[kurtiController::class,'index'])->name('inedx');
Route::get('/menstshirt',[menstshirtController::class,'index'])->name('inedx');
Route::get('/mobiles',[mobilesController::class,'index'])->name('inedx');
Route::get('/beds',[bedsController::class,'index'])->name('inedx');

/*
    ----------------------
    Admin Controller start
    ----------------------
*/

Route::group(['prefix' => 'admin'], function () {
    // Routes for login, logout, and profile
    Route::get('/', [LoginLogoutController::class, 'index']);
    Route::get('/logout', [LoginLogoutController::class, 'logout']);
    Route::get('/profile', [LoginLogoutController::class, 'profile']);

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.index');

        /*
        product route start from here-------
        */
        Route::prefix('product')->name('product.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/getsubcategoryandbrand',[ProductController::class, 'getsubcategoryandbrand'])->name('getsubcategoryandbrand');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
            Route::delete('/destroy',[ProductController::class, 'destroy'])->name('destroy');
        });

        /*
        Category Route Start From Hare----------->middleware('web')
        */
        Route::prefix('category')->name('category.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/edit/{cat_id}', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/update', [CategoryController::class, 'update'])->name('update');
            Route::delete('/destroy', [CategoryController::class,'destroy'])->name('destroy');
        });

        /*
        Sub-category start From here---------
        */
        Route::prefix('sub-category')->name('sub-category.')->group(function () {
            Route::get('/', [SubCategoryController::class, 'index'])->name('index');
            Route::get('/create', [SubCategoryController::class, 'create'])->name('create');
            Route::post('/store', [SubCategoryController::class, 'store'])->name('store');
            Route::get('/edit/{sub_cat_id}', [SubCategoryController::class, 'edit'])->name('edit');
            Route::put('/update', [SubCategoryController::class, 'update'])->name('update');
            Route::delete('/destroy/{sub_cat_id}',[SubCategoryController::class,'destroy'])->name('destroy');
            Route::post('/show_header_status', [SubCategoryController::class, 'header'])->name('header_status');
            Route::put('/show_footer_status', [SubCategoryController::class, 'footer'])->name('footer_status');


        });
        /*
        Brands route start start from here--------
        */
        Route::prefix('brand')->name('brand.')->group(function () {
            Route::get('/', [BrandsController::class, 'index'])->name('index');
            Route::get('/create', [BrandsController::class, 'create'])->name('create');
            Route::post('/store', [BrandsController::class, 'store'])->name('store');
            Route::get('/edit/{brand_id}', [BrandsController::class, 'edit'])->name('edit');
            Route::put('/update', [BrandsController::class, 'update'])->name('update');
            Route::get('/destroy/{brand_id}', [BrandsController::class, 'destroy'])->name('destroy');
        });

        /*
        Oreder route start from here--------
        */
        Route::prefix('oredrs')->name('orders.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/create', [OrderController::class, 'create'])->name('create');
            Route::post('/store', [OrderController::class, 'store'])->name('store');
            Route::get('/edit', [OrderController::class, 'edit'])->name('edit');
            Route::put('/update', [OrderController::class, 'update'])->name('update');
            Route::get('/delete', [OrderController::class, 'delete'])->name('delete');
        });

        /*
        Users route start from hare---------
        */
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('index');
            Route::get('/create', [UsersController::class, 'create'])->name('create');
            Route::post('/store', [UsersController::class, 'store'])->name('store');
            Route::get('/edit', [UsersController::class, 'edit'])->name('edit');
            Route::put('/update', [UsersController::class, 'update'])->name('update');
            Route::get('/delete', [UsersController::class, 'delete'])->name('delete');
        });

        /*
        Option route start from here-------
        */
        Route::prefix('option')->name('option.')->group(function () {
            Route::get('/', [OptionsController::class, 'index'])->name('index');
            Route::get('/create', [OptionsController::class, 'create'])->name('create');
            Route::post('/store', [OptionsController::class, 'store'])->name('store');
            Route::get('/edit', [OptionsController::class, 'edit'])->name('edit');
            Route::put('/update', [OptionsController::class, 'update'])->name('update');
            Route::get('/delete', [OptionsController::class, 'delete'])->name('delete');
        });
    });
});


