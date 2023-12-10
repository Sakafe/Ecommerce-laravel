<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('user_template.layouts.homeTemplate');
// });

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::controller(ClientController::class)->group(function () {
    Route::get('/category/{id}/{slug}', 'CategoryPage')->name('categorypage');
    Route::get('/product_details/{id}/{slug}', 'SingleProduct')->name('singleproduct');
    Route::get('/add_to_cart', 'AddToCart')->name('addtocart');
    Route::get('/check_out', 'CheckOut')->name('checkout');
    Route::get('/user_profile', 'UserProfile')->name('userprofile');
    Route::get('/new_release', 'NewRelease')->name('newrelease');
    Route::get('/todays_deal', 'TodaysDeal')->name('todaysdeal');
    Route::get('/customer_service', 'CustomerService')->name('customerservice');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::controller(ClientController::class)->group(function () {
        Route::get('/add_to_cart', 'AddToCart')->name('addtocart');
        Route::post('/add_product_to_cart', 'AddProductToCart')->name('addproductTocart');
        Route::get('/check_out', 'CheckOut')->name('checkout');
        Route::get('/user_profile', 'UserProfile')->name('userprofile');
        Route::get('/user/profile/pendingOrder', 'pendingOrder')->name('pendingOrder');
        Route::get('/user/profile/history', 'History')->name('history');
        Route::get('/todays_deal', 'TodaysDeal')->name('todaysdeal');
        Route::get('/customer_service', 'CustomerService')->name('customerservice');
    });

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admindashboard');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/all-category', 'index')->name('allcategory');
        Route::get('/admin/add-category', 'AddCategory')->name('addcategory');
        Route::post('/admin/store-category', 'storeCategory')->name('storecategory');
        Route::get('/admin/edit-category/{id}', 'editCategory')->name('editcategory');
        Route::post('/admin/update-category', 'updatecategory')->name('updatecategory');
        Route::get('/admin/delete-category/{id}', 'deletecategory')->name('deletecategory');
    });

    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/admin/all-Subcategory', 'index')->name('allsubcategory');
        Route::get('/admin/add-Subcategory', 'AddSubCategory')->name('addsubcategory');
        Route::post('/admin/store-Subcategory', 'storesubcategory')->name('storesubcategory');
        Route::get('/admin/edit-Subcategory/{id}', 'editsubcat')->name('editsubcat');
        Route::post('/admin/update-Subcategory', 'updatesubcategory')->name('updatesubcategory');
        Route::get('/admin/delete-Subcategory/{id}', 'deletesubcat')->name('deletesubcat');

    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/all-products', 'index')->name('allproduct');
        Route::get('/admin/add-products', 'AddProduct')->name('addproduct');
        Route::post('/admin/store_product', 'StoreProduct')->name('store_product');
        Route::get('/admin/edit_product_img/{id}', 'EditProductImg')->name('editproductimg');
        Route::post('/admin/update_product_img', 'UpdateProductImg')->name('updateProductImg');
        Route::get('/admin/edit_product/{id}', 'Editproduct')->name('editproduct');
        Route::post('/admin/update_product', 'UpdateProduct')->name('updateProduct');
        Route::get('/admin/delete_product/{id}', 'Deleteproduct')->name('deleteproduct');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/pendingorder', 'index')->name('pendingorder');
        // Route::get('/admin/add-order', 'AddOrder')->name('addorder');
    });
});

require __DIR__.'/auth.php';
