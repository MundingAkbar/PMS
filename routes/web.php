<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\BuildingsController;
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\LandholdingsController;
use App\Http\Controllers\LandimprovementsController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MaintenancesController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountabilityController;

use Illuminate\Support\Facades\Auth;


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
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Profile routes
Route::get('/users/profile', [ProfileController::class, 'index'])->name('users.profile');

// users routes
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->middleware('isAdmin');
Route::put('/users/edit/save/{id}', [UserController::class, 'update'])->middleware('isAdmin');
Route::get('/users/users_list', [UserController::class, 'getUsersList'])->name('get.users.list');
Route::delete('/users/users/delete/{id}', [UserController::class, 'destroy']);
// office routes
Route::post('/admin/properties/offices/store', [OfficesController::class, 'store'])->middleware('isAdmin');
Route::get('/admin/properties/offices/edit/{id}', [OfficesController::class, 'edit'])->middleware('isAdmin');
Route::put('/admin/properties/offices/edit/save/{id}', [OfficesController::class, 'update'])->middleware('isAdmin');
Route::get('/admin/properties/offices/reload', [OfficesController::class, 'reload']);
Route::delete('/admin/properties/offices/delete/confirm/{id}', [OfficesController::class, 'destroy']);
Route::get('/admin/properties/offices/offices_list', [OfficesController::class, 'getOfficeList'])->name('get.offices.list');
// equipments routes
Route::post('/admin/properties/equipment/store', [EquipmentController::class, 'store']);
Route::get('/admin/properties/equipment/equipment_list', [EquipmentController::class, 'getEquipmentList'])->name('get.equipment.list');
Route::get('/admin/properties/equipment/edit/{id}', [EquipmentController::class, 'edit']);
Route::put('/admin/properties/equipment/edit/save/{id}', [EquipmentController::class, 'update'])->middleware('isAdmin');
Route::delete('/admin/properties/equipment/delete/confirm/{id}', [EquipmentController::class, 'destroy']);
// articles routes
Route::post('/admin/properties/articles/store', [ArticlesController::class, 'store']);
Route::get('/admin/properties/articles/articles_list', [ArticlesController::class, 'getArticlesList'])->name('get.articles.list');
Route::get('/admin/properties/articles/edit/{id}', [ArticlesController::class, 'edit']);
Route::put('/admin/properties/articles/edit/save/{id}', [ArticlesController::class, 'update'])->middleware('isAdmin');
Route::delete('/admin/properties/articles/delete/confirm/{id}', [ArticlesController::class, 'destroy']);
// vehicles routes
Route::post('/admin/properties/vehicles/store', [VehiclesController::class, 'store']);
Route::get('/admin/properties/vehicles/equipment_list', [VehiclesController::class, 'getVehiclesList'])->name('get.vehicles.list');
Route::get('/admin/properties/vehicles/edit/{id}', [VehiclesController::class, 'edit']);
Route::put('/admin/properties/vehicles/edit/save/{id}', [VehiclesController::class, 'update'])->middleware('isAdmin');
Route::delete('/admin/properties/vehicles/delete/confirm/{id}', [VehiclesController::class, 'destroy']);
// buildings routes
Route::post('/admin/properties/buildings/store', [BuildingsController::class, 'store']);
Route::get('/admin/properties/buildings/equipment_list', [BuildingsController::class, 'getBuildingsList'])->name('get.buildings.list');
Route::get('/admin/properties/buildings/edit/{id}', [BuildingsController::class, 'edit']);
Route::put('/admin/properties/buildings/edit/save/{id}', [BuildingsController::class, 'update'])->middleware('isAdmin');
Route::delete('/admin/properties/buildings/delete/confirm/{id}', [BuildingsController::class, 'destroy']);
// landholdings routes
Route::post('/admin/properties/landholdings/store', [LandholdingsController::class, 'store']);
Route::get('/admin/properties/landholdings/equipment_list', [LandholdingsController::class, 'getLandholdingsList'])->name('get.landholdings.list');
Route::get('/admin/properties/landholdings/edit/{id}', [LandholdingsController::class, 'edit']);
Route::put('/admin/properties/landholdings/edit/save/{id}', [LandholdingsController::class, 'update'])->middleware('isAdmin');
Route::delete('/admin/properties/landholdings/delete/confirm/{id}', [LandholdingsController::class, 'destroy']);
// landimprovements routes
Route::post('/admin/properties/landimprovements/store', [LandimprovementsController::class, 'store']);
Route::get('/admin/properties/landimprovements/equipment_list', [LandimprovementsController::class, 'getLandimprovementsList'])->name('get.landimprovements.list');
Route::get('/admin/properties/landimprovements/edit/{id}', [LandimprovementsController::class, 'edit']);
Route::put('/admin/properties/landimprovements/edit/save/{id}', [LandimprovementsController::class, 'update'])->middleware('isAdmin');
Route::delete('/admin/properties/landimprovements/delete/confirm/{id}', [LandimprovementsController::class, 'destroy']);
// Maintenances Controller
Route::post('/admin/properties/maintenances/store', [MaintenancesController::class, 'store']);
// =====================================================================
// Admin routes
Route::group(['prefix'=>'admin', 'middleware'=>'isAdmin','auth'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('isAdmin');
    // Admin routes
    Route::get('/properties/equipments', [EquipmentController::class, 'index'])->name('equipment.index');
    // vehicles routes
    Route::get('/properties/vehicles', [VehiclesController::class, 'index'])->name('vehicles.index');
    // buildings routes
    Route::get('/properties/buildings', [BuildingsController::class, 'index'])->name('buildings.index');
    // landholdings routes
    Route::get('/properties/landholdings', [LandholdingsController::class, 'index'])->name('landholdings.index');
    // landimoprovments routes
    Route::get('/properties/landimprovements', [LandimprovementsController::class, 'index'])->name('landimprovements.index');
    // Account Titles routes
    Route::get('/properties/articles', [ArticlesController::class, 'index'])->name('articles.index');
    // Offices routes
    Route::get('/properties/offices', [OfficesController::class, 'index'])->name('offices.index');
    // Users routes
    Route::get('/users/users', [UserController::class, 'index'])->name('users.show');
    
    // Request routes
    Route::get('/users/request', [RequestController::class, 'index'])->name('request.index');
    // Maintenances Routes
    Route::get('/properties/maintenances', [MaintenancesController::class, 'index'])->name('maintenances.index');
    // Reports routes
    Route::get('/properties/reports', [ReportController::class, 'index'])->name('reports.index');
});

Route::group(['prefix'=>'user', 'middleware'=>'isUser','auth'], function(){
    Route::get('/users/accountability', [AccountabilityController::class, 'index'])->name('users.accountability');
});





