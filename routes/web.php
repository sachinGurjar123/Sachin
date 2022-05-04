<?php

use App\Http\Controllers\Admin\AdminErrorPageController;
use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
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
    // return view('welcome');
    return redirect()->route('admin.dashboard');
});
// Route::get('/admin', function () {
//     return redirect('/admin/dashboard');
// });
Auth::routes(['register' => false]);
// Route::get('/test', 'TestController@test');
// Route::controller(TestController::class)->group(function () {
//     //
// });
Route::get('/admin/test', 'TestController@test');

Route::group(['middleware' => ['optimizeImages'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout');
    });
    Route::controller(AdminErrorPageController::class)->group(function () {
        Route::get('/404', 'pageNotFound')->name('notfound');
        Route::get('/500', 'serverError')->name('server_error');
    });
    Route::group(['middleware' => ['auth'], 'namespace' => 'Admin'], function () {

        Route::controller(DashboardController::class)->group(function () {
            Route::get('/test', 'test')->name('test');
            Route::get('/dashboard', 'index')->name('dashboard');
            Route::get('dashboard-counts', 'dashboardCountsData')->name('dashboard-counts');
        });

        Route::controller(AdminProfileController::class)->group(function () {
            Route::get('/profile', 'profile')->name('profile');
            Route::get('change-password', 'changePassword')->name('change_password');
            Route::put('change-password/{user}', 'updatePassword')->name('update.password');
        });

        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::controller(UserController::class)->group(function () {
            Route::get('/update_language/{user}/{language}', 'updateLanguage')->name('users.update_language');
            Route::get('/users/status/{id}/{status}', 'status')->name('users.status');
            Route::post('/users/download', 'export')->name('users.download');
        });
        Route::resource('/users', UserController::class);

        Route::controller(CustomerController::class)->group(function () {
            Route::get('/customers/status/{id}/{status}', 'status')->name('customers.status');
            Route::post('/customers/download', 'export')->name('customers.download');
            Route::get('/customers/download', 'export')->name('customers.getdownload');
        });
        Route::resource('/customers', CustomerController::class);

        Route::controller(ProductController::class)->group(function () {
            Route::get('/products/status/{id}/{status}', 'status')->name('products.status');
            Route::post('/products/download', 'export')->name('products.download');
            Route::get('/products/download', 'export')->name('products.getdownload');
            Route::post('/products/import', 'import')->name('products.import');
            Route::get('products/get-format-files', 'downloadImportFormatFile')->name('products.getfile');
            Route::delete('products/delete-images/{id}', 'deleteImage')->name('products.delete_image');
        });
        Route::resource('/products', ProductController::class);

        //Setting manager
        Route::controller(SettingController::class)->group(function () {
            Route::get('/settings/general', 'edit_general')->name('settings.edit_general');
            Route::post('/settings/general', 'update_general')->name('settings.update_general');
        });
    });
});
