<?php

use App\Http\Controllers\Admin\AdminAttributeController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\AdminCarrierController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminConfigurationController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminFeatureController;
use App\Http\Controllers\Admin\AdminManufacturerController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminSlideController;
use App\Http\Controllers\Admin\AdminTaxController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\web\AuthController;
use App\Http\Controllers\web\CartController;
use App\Http\Controllers\web\CustomerController;
use App\Http\Controllers\web\LayoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LayoutController::class, 'index'])->name('index');
Route::get('/login', [CustomerController::class, 'index'])->name('login');
Route::get('/register', [CustomerController::class, 'register'])->name('register');
Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::group(['middleware' => ['customerLogin']], function () {
    Route::get('/login', [AuthController::class,'login'])->name('login');
    Route::post('/login', [AuthController::class,'postLogin']);
    Route::get('customer/register', [CustomerController::class,'register'])->name('register');
    Route::post('customer/register', [CustomerController::class,'postRegister']);
    Route::get('customer/password/reset', [CustomerController::class,'resetPassword'])->name('resetPassword');
    Route::post('customer/password/reset', [CustomerController::class,'postResetPassword']);
    Route::get('customer/password/reset/check', [CustomerController::class,'checkResetPassword'])->name('checkResetPassword');
    Route::post('customer/password/reset/check', [CustomerController::class,'postCheckResetPassword']);

});

Route::group(['middleware' => 'customerAuth'], function () {
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');
    Route::get('/wishlist', [CustomerController::class,'wishlist'])->name('wishlist');
});

Route::group(['prefix' => 'admins'], function () {
    Route::group(['middleware' => 'adminLogin'], function () {
        Route::get('/', [AdminAuthController::class, 'getLogin'])->name('adminlogin');
        Route::post('/', [AdminAuthController::class, 'postLogin']);
        Route::get('register-disabled', [AdminAuthController::class, 'register'])->name('adminRegister');
        Route::post('register-disabled', [AdminAuthController::class, 'postRegister']);
        Route::get('forgot-password', [AdminAuthController::class, 'forgotPassword'])->name('adminForgotPassword');
        Route::post('forgot-password',[AdminAuthController::class, 'postForgotPassword']);
    });
    Route::group(['middleware'=>'auth'], function () {
        Route::get('logout', [AdminAuthController::class, 'logout'])->name('adminlogout');
        Route::get('/dashboard', [AdminDashboardController::class,'index'])->name('adminDashboard');
        Route::group(['middleware'=>['checkProfile']], function () {
            Route::group(['prefix' => 'attribute'], function () {
                Route::get('/', [AdminAttributeController::class,'getAttribute'])->name('adminAttribute');
                Route::get('/add', [AdminAttributeController::class,'addAttribute'])->name('addAttribute');
                Route::post('/add', [AdminAttributeController::class,'postAddAttribute']);
                Route::get('/edit/{id}', [AdminAttributeController::class,'editAttribute'])->name('editAttribute');
                Route::post('/edit/{id}', [AdminAttributeController::class,'postEditAttribute']);
                Route::get('/delete/{id}', [AdminAttributeController::class,'deleteAttribute'])->name('deleteAttribute');
                Route::get('/attribute-value/{id}', [AdminAttributeController::class,'getValueAttribute'])->name('adminValueAttribute');
                Route::get('/add-value', [AdminAttributeController::class,'addValueAttribute'])->name('addValueAttribute');
                Route::post('/add-value', [AdminAttributeController::class,'postAddValueAttribute']);
                Route::get('/edit-value/{id}', [AdminAttributeController::class,'editValueAttribute'])->name('editValueAttribute');
                Route::post('/edit-value/{id}', [AdminAttributeController::class,'postEditValueAttribute']);
                Route::get('attribute-value/delete/{id}', [AdminAttributeController::class,'deleteValueAttribute'])->name('deleteValueAttribute');
            });
            Route::group(['prefix' => 'web'], function () {
                Route::get('/', [AdminCustomerController::class,'getCustomer'])->name('adminCustomer');
                Route::get('/add', [AdminCustomerController::class,'addCustomer'])->name('addCustomer');
                Route::post('/add', [AdminCustomerController::class,'postAddCustomer']);
                Route::get('/edit/{id}', [AdminCustomerController::class,'editCustomer'])->name('adminEditCustomer');
                Route::post('/edit/{id}', [AdminCustomerController::class,'postEditCustomer']);
                Route::get('/delete/{id}', [AdminCustomerController::class,'deleteCustomer'])->name('deleteCustomer');
            });
            Route::group(['prefix' => 'category'], function () {
                Route::get('/', [AdminCategoryController::class,'getCategory'])->name('adminCategory');
                Route::get('/show-home', [AdminCategoryController::class,'showHome'])->name('showHomeCategory');
                Route::post('/show-home', [AdminCategoryController::class,'postShowHomeAPI']);
                Route::get('/add', [AdminCategoryController::class,'addCategory'])->name('addCategory');
                Route::post('/add', [AdminCategoryController::class,'postAddCategory']);
                Route::get('/edit/{id}', [AdminCategoryController::class,'editCategory'])->name('editCategory');
                Route::post('/edit/{id}', [AdminCategoryController::class,'postEditCategory']);
                Route::get('/delete/{id}', [AdminCategoryController::class,'deleteCategory'])->name('deleteCategory');
            });
            Route::group(['prefix' => 'product'], function () {
                Route::get('/search', [AdminProductController::class,'searchProduct'])->name('adminProductSearch');
                Route::get('/', [AdminProductController::class,'getProduct'])->name('adminProduct');
                Route::get('/add', [AdminProductController::class,'addProduct'])->name('addProduct');
                Route::post('/add', [AdminProductController::class,'postAddProduct']);
                Route::get('/edit/{id}', [AdminProductController::class,'editProduct'])->name('editProduct');
                Route::post('/edit/{id}', [AdminProductController::class,'postEditProduct']);
                Route::get('/delete/{id}', [AdminProductController::class,'deleteProduct'])->name('deleteProduct');
                Route::post('/delete-image', [AdminProductController::class,'deleteImageProductAPI']);
                Route::post('/delete-feature', [AdminProductController::class,'deleteFeatureProductAPI']);
            });
            Route::group(['prefix' => 'manufacturer'], function () {
                Route::get('/', [AdminManufacturerController::class,'getManufacturer'])->name('adminManufacturer');
                Route::get('/add', [AdminManufacturerController::class,'addManufacturer'])->name('addManufacturer');
                Route::post('/add', [AdminManufacturerController::class,'postAddManufacturer']);
                Route::get('/edit/{id}', [AdminManufacturerController::class,'editManufacturer'])->name('editManufacturer');
                Route::post('/edit/{id}', [AdminManufacturerController::class,'postEditManufacturer']);
                Route::get('/delete/{id}', [AdminManufacturerController::class,'deleteManufacturer'])->name('deleteManufacturer');
            });
            Route::group(['prefix' => 'carrier'], function () {
                Route::get('/', [AdminCarrierController::class,'getCarrier'])->name('adminCarrier');
                Route::get('/add', [AdminCarrierController::class,'addCarrier'])->name('addCarrier');
                Route::post('/add', [AdminCarrierController::class,'postAddCarrier']);
                Route::get('/edit/{id}', [AdminCarrierController::class,'editCarrier'])->name('editCarrier');
                Route::post('/edit/{id}', [AdminCarrierController::class,'postEditCarrier']);
                Route::get('/delete/{id}', [AdminCarrierController::class,'deleteCarrier'])->name('deleteCarrier');
            });
            Route::group(['prefix' => 'page'], function () {
                Route::get('/', [AdminPageController::class,'getPage'])->name('adminPage');
                Route::post('/', [AdminPageController::class,'postShowHomeAPI']);
                Route::get('/add', [AdminPageController::class,'addPage'])->name('addPage');
                Route::post('/add', [AdminPageController::class,'postAddPage']);
                Route::get('/edit/{id}', [AdminPageController::class,'editPage'])->name('editPage');
                Route::post('/edit/{id}', [AdminPageController::class,'postEditPage']);
                Route::post('/delete/{id}', [AdminPageController::class,'deletePage'])->name('deletePage');
            });
            Route::group(['prefix' => 'configuration'], function () {
                Route::get('/', [AdminConfigurationController::class,'getConfiguration'])->name('adminConfiguration');
                Route::get('/add', [AdminConfigurationController::class,'addConfiguration'])->name('addConfiguration');
                Route::post('/add', [AdminConfigurationController::class,'postAddConfiguration']);
                Route::get('/edit/{id}', [AdminConfigurationController::class,'editConfiguration'])->name('editConfiguration');
                Route::post('/edit/{id}', [AdminConfigurationController::class,'postEditConfiguration']);
                Route::post('/delete/{id}', [AdminConfigurationController::class,'deleteConfiguration'])->name('deleteConfiguration');
            });
            Route::group(['prefix' => 'slide'], function () {
                Route::get('/', [AdminSlideController::class,'getSlide'])->name('adminSlide');
                Route::get('/add', [AdminSlideController::class,'addSlide'])->name('addSlide');
                Route::post('/add', [AdminSlideController::class,'postAddSlide']);
                Route::get('/edit/{id}', [AdminSlideController::class,'editSlide'])->name('editSlide');
                Route::post('/edit/{id}', [AdminSlideController::class,'postEditSlide']);
                Route::get('/delete/{id}', [AdminSlideController::class,'deleteSlide'])->name('deleteSlide');
            });
            Route::group(['prefix' => 'banner'], function () {
                Route::get('/', [AdminBannerController::class,'getBanner'])->name('adminBanner');
                Route::get('/add', [AdminBannerController::class,'addBanner'])->name('addBanner');
                Route::post('/add', [AdminBannerController::class,'postAddBanner']);
                Route::get('/edit/{id}', [AdminBannerController::class,'editBanner'])->name('editBanner');
                Route::post('/edit/{id}', [AdminBannerController::class,'postEditBanner']);
                Route::get('/delete/{id}', [AdminBannerController::class,'deleteBanner'])->name('deleteBanner');
            });
            Route::group(['prefix' => 'tax'], function () {
                Route::get('/', [AdminTaxController::class,'getTax'])->name('adminTax');
                Route::get('/add', [AdminTaxController::class,'addTax'])->name('addTax');
                Route::post('/add', [AdminTaxController::class,'postAddTax']);
                Route::get('/edit/{id}', [AdminTaxController::class,'editTax'])->name('editTax');
                Route::post('/edit/{id}', [AdminTaxController::class,'postEditTax']);
                Route::get('/delete/{id}', [AdminTaxController::class,'deleteTax'])->name('deleteTax');
            });
            Route::group(['prefix' => 'feature'], function () {
                Route::get('/', [AdminFeatureController::class,'getFeature'])->name('adminFeature');
                Route::get('/add', [AdminFeatureController::class,'addFeature'])->name('addFeature');
                Route::post('/add', [AdminFeatureController::class,'postAddFeature']);
                Route::get('/edit/{id}', [AdminFeatureController::class,'editFeature'])->name('editFeature');
                Route::post('/edit/{id}', [AdminFeatureController::class,'postEditFeature']);
                Route::get('/delete/{id}', [AdminFeatureController::class,'deleteFeature'])->name('deleteFeature');
                Route::get('/feature-value/{id}', [AdminFeatureController::class,'getValueFeature'])->name('adminValueFeature');
                Route::get('/add-value', [AdminFeatureController::class,'addValueFeature'])->name('addValueFeature');
                Route::post('/add-value', [AdminFeatureController::class,'postAddValueFeature']);
                Route::get('/edit-value/{id}', [AdminFeatureController::class,'editValueFeature'])->name('editValueFeature');
                Route::post('/edit-value/{id}', [AdminFeatureController::class,'postEditValueFeature']);
                Route::get('feature-value/delete/{id}', [AdminFeatureController::class,'deleteValueFeature'])->name('deleteValueFeature');
                Route::post('/get-feature-value', [AdminFeatureController::class,'getValueFeatureAPI'])->name('adminValueFeatureAPI');
            });
        });
        Route::group(['prefix' => 'user'], function () {
            Route::get('/edit/{id}', [AdminUserController::class,'editUser'])->name('editUser');
            Route::post('/edit/{id}', [AdminUserController::class,'postEditUser']);
            Route::group(['middleware'=>['checkProfile']], function () {
                Route::get('/', [AdminUserController::class,'getUser'])->name('adminUser');
                Route::get('/add', [AdminUserController::class,'addUser'])->name('addUser');
                Route::post('/add', [AdminUserController::class,'postAddUser']);
                Route::get('/delete/{id}', [AdminUserController::class,'deleteUser'])->name('deleteUser');
            });
        });
        Route::group(['prefix' => 'order'], function () {
            Route::get('/', [AdminOrderController::class,'getOrder'])->name('adminOrder');
            Route::get('/edit/{id}', [AdminOrderController::class,'editOrder'])->name('editOrder');
            Route::post('/edit/{id}', [AdminOrderController::class,'postEditOrder']);
            Route::get('/delete/{id}', [AdminOrderController::class,'getOrder'])->name('deleteOrder');
        });
    });
});
