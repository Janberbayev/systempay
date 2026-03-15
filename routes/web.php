<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdvertController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('home');
});

// Варианты дизайна
// Route::get('/design/bank', function () {
//     return view('design-variant-bank');
// })->name('design.bank');

// Route::get('/design/variant-5', function () {
//     return view('design-variant-5');
// })->name('design.variant5');

// Route::get('/design/variant-2', function () {
//     return view('design-variant-2');
// })->name('design.variant2');

// Route::get('/design/variant-3', function () {
//     return view('design-variant-3');
// })->name('design.variant3');

// Route::get('/design/variant-4', function () {
//     return view('design-variant-4');
// })->name('design.variant4');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Dashboard routes
    Route::get('/dashboard/my-deals', [DashboardController::class, 'myDeals'])->name('my-deal');
    Route::get('/dashboard/messages', [DashboardController::class, 'messages'])->name('messages');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // для admin
    Route::get('/admin/page', [AdmController::class, 'index'])->name('admin.page')->middleware('role:admin');
    Route::resource('/admin/roles', RoleController::class)->middleware('role:admin');
    Route::resource('/admin/users', UserController::class)->middleware('role:admin');

    Route::get('/admin/adverts', [AdmController::class, 'adverts'])->name('admin.adverts')->middleware('role:admin');
    Route::patch('/admin/adverts/{advert}/approve', [AdmController::class, 'approveAdvert'])->name('adverts.approve')->middleware('role:admin');
    Route::patch('/admin/adverts/{advert}/reject', [AdmController::class, 'rejectAdvert'])->name('adverts.reject')->middleware('role:admin');
    Route::patch('/admin/adverts/{advert}/revision', [AdmController::class, 'revisionAdvert'])->name('adverts.revision')->middleware('role:admin');

    Route::get('/admin/projects', [AdmController::class, 'projects'])->name('admin.projects')->middleware('role:admin');
    Route::patch('/admin/projects/{project}/approve', [AdmController::class, 'approveProject'])->name('projects.approve')->middleware('role:admin');
    Route::patch('/admin/projects/{project}/reject', [AdmController::class, 'rejectProject'])->name('projects.reject')->middleware('role:admin');
    Route::patch('/admin/projects/{project}/revision', [AdmController::class, 'revisionProject'])->name('projects.revision')->middleware('role:admin');

    Route::get('/admin/regions', [AdmController::class, 'regions'])->name('admin-regions')->middleware('role:admin');
    Route::post('/admin/regions', [AdmController::class, 'storeRegion'])->name('admin.regions.store')->middleware('role:admin');
    Route::get('/admin/regions/{region}', [AdmController::class, 'getRegion'])->name('admin.regions.get')->middleware('role:admin');
    Route::patch('/admin/regions/{region}', [AdmController::class, 'editRegion'])->name('admin.regions.update')->middleware('role:admin');
    Route::delete('/admin/regions/{region}', [AdmController::class, 'destroyRegion'])->name('admin.regions.destroy')->middleware('role:admin');

    Route::get('/admin/cities', [AdmController::class, 'cities'])->name('admin-cities')->middleware('role:admin');
    Route::post('/admin/cities', [AdmController::class, 'storeCity'])->name('admin.cities.store')->middleware('role:admin');
    Route::patch('/admin/cities/{city}', [AdmController::class, 'editCity'])->name('admin.cities.update')->middleware('role:admin');
    Route::delete('/admin/cities/{city}', [AdmController::class, 'destroyCity'])->name('admin.cities.destroy')->middleware('role:admin');

    Route::get('/admin/{region}', [AdmController::class, 'editRegion'])->name('admin-regions-edit')->middleware('role:admin');

    // для user
    Route::get('/dashboard/publish', function () {return view('dashboard'); })->name('publish');
    Route::get('list-project', [ProjectController::class, 'index'])->name('list-project')->middleware('can:view projects');
    Route::get('add-project', [ProjectController::class, 'create'])->name('add-project')->middleware('can:add projects');
    Route::post('store-project', [ProjectController::class, 'store'])->name('store-project')->middleware('can:add projects');
    Route::get('show-project/{project}', [ProjectController::class, 'show'])->name('show-project')->middleware('can:view projects');
    Route::get('edit-project/{project}', [ProjectController::class, 'edit'])->name('edit-project')->middleware('can:edit projects');
    Route::put('update-project/{project}', [ProjectController::class, 'update'])->name('update-project')->middleware('can:edit projects');
    Route::delete('delete-project/{project}', [ProjectController::class, 'destroy'])->name('delete-project')->middleware('can:delete projects');

    Route::get('list-ads', [AdvertController::class, 'index'])->name('list-ads')->middleware('can:view ads');
    Route::get('add-ads', [AdvertController::class, 'create'])->name('add-ads')->middleware('can:add ads');
    Route::post('store-ads', [AdvertController::class, 'store'])->name('store-ads')->middleware('can:add ads');
    Route::get('show-ads/{advert}', [AdvertController::class, 'show'])->name('show-ads')->middleware('can:view ads');
    Route::get('edit-ads/{advert}', [AdvertController::class, 'edit'])->name('edit-ads')->middleware('can:edit ads');
    Route::put('update-ads/{advert}', [AdvertController::class, 'update'])->name('update-ads')->middleware('can:edit ads');
    Route::delete('delete-ads/{advert}', [AdvertController::class, 'destroy'])->name('delete-ads')->middleware('can:delete ads');

    Route::get('my-ads', [DashboardController::class, 'myAds'])->name('my-ads');

    Route::post('/conversations/{conversation}/messages', [MessageController::class, 'store'])->name('messages.store');

});

// API для получения городов по области
Route::get('/api/cities/{region}', function (App\Models\Region $region) {
    return response()->json($region->cities);
})->name('api.cities');

require __DIR__.'/auth.php';
