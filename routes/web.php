<?php

use Illuminate\Support\Facades\Route;
/**Backend controller */
use App\Http\Middleware\TrackVisitor;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\ForgotPasswordController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\YearController;
use App\Http\Controllers\Backend\AwardsCategoryController;
use App\Http\Controllers\Backend\AwardsController;
use App\Http\Controllers\Backend\NewsMediaCategoryController;
use App\Http\Controllers\Backend\NewsMediaController;
use App\Http\Controllers\Backend\MedicineCategoryController;
use App\Http\Controllers\Backend\MedicineController;
use App\Http\Controllers\Backend\CacheController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\MenuController;
/**Backend controller */


use App\Http\Controllers\Frontend\FrontHomeController;
use App\Http\Controllers\Frontend\SiteMapController;
use App\Http\Controllers\Frontend\FrontendPageController;
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
Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm']);
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('forget/password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password');
    Route::post('forget.password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.submit');

    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
Route::group(['middleware' => ['auth']], function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/get-daily-visitors', [DashboardController::class, 'getDailyVisitors'])->name('get-daily-visitors');
    
    Route::resource('manage-banner', BannerController::class)->names('manage-banner');
    Route::resource('manage-year', YearController::class)->names('manage-year');
    Route::resource('manage-award-category', AwardsCategoryController::class)->names('manage-award-category');
    Route::resource('manage-awards', AwardsController::class)->names('manage-awards');
    Route::resource('manage-news-media-category', NewsMediaCategoryController::class)->names('manage-news-media-category');
    Route::resource('manage-news-media', NewsMediaController::class)->names('manage-news-media');
    Route::post('news-room/update/{id}', [NewsMediaController::class, 'newRoomUpdate'])->name('news-room.update');
    Route::delete('news-room/destroy/{id}', [NewsMediaController::class, 'newRoomDelete'])->name('news-room.destroy');
    Route::resource('medicine-category', MedicineCategoryController::class)->names('medicine-category');
    Route::resource('manage-medicine', MedicineController::class)->names('manage-medicine');

    Route::get('/clear-cache', [CacheController::class, 'clearCache'])->name('clear-cache');
    Route::resource('pages', PageController::class);
    Route::resource('menus', MenuController::class);
    Route::get('menu/items/{menu}', [MenuController::class, 'displayMenuItem'])->name('menus.items');
    Route::post('menu/{menu}/item', [MenuController::class, 'storeItem'])->name('menu.item.store');
    
    Route::get('menu/{menu}/item/{item}/edit', [MenuController::class, 'editItem'])
    ->name('menu.item.edit');
    Route::put('menu/{menu}/item/{item}', [MenuController::class, 'updateItem'])->name('menu.item.update');
    Route::delete('menu/{menu}/item/{item}', [MenuController::class, 'destroyItem'])->name('menu.item.destroy');
    Route::post('menus/{menu}/items/order', [MenuController::class, 'orderItems'])->name('menus.items.order');
});

Route::get('/', [FrontHomeController::class, 'home'])->name('home');
Route::get('novosti', [FrontHomeController::class, 'newsList'])->name('novosti');
Route::get('novosti/{slug}', [FrontHomeController::class, 'newsDetails'])->name('novosti.detail');

Route::get('lekarstvennye-preparaty', [FrontHomeController::class, 'medicineList'])->name('lekarstvennye-preparaty');
Route::get('lekarstvennye-preparaty/{slug}', [FrontHomeController::class, 'medicineDetails'])->name('lekarstvennye-preparaty.detail');
Route::get('medicine-cate-ajax', [FrontHomeController::class, 'medicineCategoryAjax'])->name('medicine-cate-ajax');

Route::get('/page/{slug}', [FrontendPageController::class, 'show'])->name('page.show');

Route::get('sitemap.xml', [SiteMapController::class, 'index'])->name('sitemap');

