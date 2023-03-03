<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\user\UserController;


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

Route::middleware(['adminAuth'])->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {

    //dashboards
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    // admin
    Route::middleware('adminAuth')->group(function(){

     //category
    Route::group(['prefix'=>'category'],function(){
        Route::get('list',[CategoryController::class,'list'])->name('category#list');
        Route::get('createPage',[CategoryController::class,'createPage'])->name('category#createPage');
        Route::post('create',[CategoryController::class,'create'])->name('category#create');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
        Route::get('editPage/{id}',[CategoryController::class,'editPage'])->name('category#editPage');
        Route::post('update',[CategoryController::class,'update'])->name('category#update');
    });
    //password
    Route::group(['prefix'=>'password'],function () {
        Route::get('changePasswordPage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
        Route::post('changePassword',[AdminController::class,'changePassword'])->name('admin#changePassword');
    });

    //profile page
    Route::group(['prefix'=>'account'],function () {
        Route::get('profile',[AdminController::class,'profile'])->name('admin#profile');
        Route::get('editPage',[AdminController::class,'editPage'])->name('admin#editPage');
        Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');
        Route::get('list',[AdminController::class,'list'])->name('admin#list');
        Route::get('delete/{id}',[AdminController::class,'delete'])->name('adminList#delete');
        Route::get('changeRole',[AdminController::class,'changeRole'])->name('adminList#changeRole');

    });

    //product
    Route::prefix('product')->group(function () {
        Route::get('list',[ProductController::class,'list'])->name('admin#productList');
        Route::get('createPage',[ProductController::class,'createPage'])->name('admin#createProductList');
        Route::post('create',[ProductController::class,'create'])->name('admin#create');
        Route::get('detail/{id}',[ProductController::class,'detail'])->name('admin#detail');
        Route::get('delete/{id}',[ProductController::class,'delete'])->name('admin#delete');
        Route::get('edit/{id}',[ProductController::class,'editPage'])->name('admin#editProductPage');
        Route::post('update',[ProductController::class,'update'])->name('admin#Productupdate');
    });

    //order
    Route::prefix('admin/order')->group(function () {
        Route::get('list',[OrderController::class,'adminOrderList'])->name('admin#orderList');
        Route::get('status/{id}',[OrderController::class,'orderStatus'])->name('admin#orderStatus');
        Route::get('changeStatus',[OrderController::class,'orderChangeStatus'])->name('admin#orderChangeStatus');
        Route::get('list/info/{orderCode}',[OrderController::class,'listInfo'])->name('admin#orderListInfo');
    });

    //user
    Route::prefix('user')->group(function () {
        Route::get('list',[AdminController::class,'adminUserList'])->name('admin#userList');
        Route::get('change/role',[AdminController::class,'userChangeRole'])->name('admin#userChangeRole');
        Route::get('account/delete/{id}',[AdminController::class,'userAccountDelete'])->name('admin#userAccountDelete');
    });

    Route::get('contact/list',[ContactController::class,'listPage'])->name('admin#contactListPage');
    Route::get('contact/info/{id}',[ContactController::class,'info'])->name('admin#contactInfo');

    });

    //user
    //home
    Route::group(['prefix'=>'user','middleware'=>'userAuth'],function(){
        Route::get('home',[UserController::class,'home'])->name('user#home');

        Route::prefix('account')->group(function () {
            Route::get('profile',[UserController::class,'profile'])->name('user#profile');
            Route::get('profile/editPage',[UserController::class,'editProfilePage'])->name('user#editProfilePage');
            Route::post('profile/update/{id}',[UserController::class,'updateProfile'])->name('user#updateProfile');
            Route::post('changePassword',[UserController::class,'changePassword'])->name('user#changePassword');
            Route::get('changePasswordPage',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
        });


        Route::prefix('cart')->group(function () {
            Route::get('addCart',[CartController::class,'addCart'])->name('user#addCart');
            Route::get('cartPage',[CartController::class,'cartPage'])->name('user#cartPage');
            Route::get('remove',[CartController::class,'remove'])->name('user#cartRemove');
            Route::get('removeAll',[CartController::class,'removeAll'])->name('user#cartRemoveAll');

        });
        Route::prefix('order')->group(function () {
            Route::get('historyPage',[OrderController::class,'historyPage'])->name('user#orderHistoryPage');
            Route::get('list',[OrderController::class,'list'])->name('user#orderList');

        });
        Route::get('ajax',[AjaxController::class,'getAjax'])->name('ajaxfunction');
        Route::get('categoryGroup/{id}',[UserController::class,'categoryGroup'])->name('user#categoryGroup');
        Route::get('productDetail/{id}',[UserController::class,'productDetail'])->name('user#productDetail');
        Route::get('increase/viewCount',[UserController::class,'viewCountIncrease'])->name('increaseViewCount');

        Route::prefix('contact')->group(function () {
            Route::get('page',[ContactController::class,'contactPage'])->name('user#contactPage');
            Route::post('send',[ContactController::class,'send'])->name('user#contactSend');
        });
    });
});



