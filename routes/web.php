<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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


// Authenticaion
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/store/register', [HomeController::class, 'store_register'])->name('store.register');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login/post', [HomeController::class, 'login_post'])->name('login.post');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');



Route::get('/index', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', [HomeController::class, 'index'])->name('index');

// Category
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/add/category', [CategoryController::class, 'add_category'])->name('add.category');
Route::get('/category/delete/{id}', [CategoryController::class, 'category_delete'])->name('category.delete');

// Sub Category
Route::get('/subcategory', [CategoryController::class, 'subcategory'])->name('subcategory');
Route::post('/subcategory/store', [CategoryController::class, 'subcategory_store'])->name('subcategory.store');
Route::get('/subcategory/delete/{id}', [CategoryController::class, 'subcategory_delete'])->name('subcategory.delete');

// Product
Route::get('/product', [ProductController::class, 'product'])->name('product');
Route::post('/getsubcategory',[ProductController::class, 'getsubcategory']);
Route::post('/product/store',[ProductController::class, 'product_store'])->name('product.store');
Route::get('/all/products',[ProductController::class, 'all_products'])->name('all.products');
Route::get('/edit/product/{id}',[ProductController::class, 'edit_product'])->name('edit.product');
Route::post('/product/update/{id}',[ProductController::class, 'product_update'])->name('product.update');
Route::get('/delete/product/{id}',[ProductController::class, 'delete_product'])->name('delete.product');

// Purchase product
Route::get('/purchase/{id}', [ProductController::class, 'purchase'])->name('purchase');
Route::get('/transaction/list', [ProductController::class, 'transaction_list'])->name('transaction.list');
Route::get('/delete/transaction/{id}', [ProductController::class, 'delete_transaction'])->name('delete.transaction');

// Role Manage
Route::get('/role/manage', [RoleController::class, 'role_manage'])->name('role.manage');
Route::post('/add/permission', [RoleController::class, 'add_permission'])->name('add.permission');
Route::post('/role/store', [RoleController::class, 'role_store'])->name('role.store');
Route::get('/delete/role/{id}', [RoleController::class, 'delete_role'])->name('delete.role');
Route::post('/assign/role', [RoleController::class, 'assign_role'])->name('assign.role');
Route::get('/remove/role/{id}', [RoleController::class, 'remove_role'])->name('remove.role');