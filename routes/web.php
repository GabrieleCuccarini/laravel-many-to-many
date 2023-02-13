<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;

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
    return view('welcome');
});

// Route::get("/posts", [PublicPostController::class, "index"])->name("posts.index");
// Route::get("/about", [PublicController::class, "about"])->name("about.index");
// Route::get("/contact", [PublicController::class, "contact"])->name("contact.index");

//  Route::get('/dashboard', function () {
//      return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth']) ->group(function () {   
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])
    ->prefix("admin") // porzione di uri che verrà inserita prima di ogni rotta
    ->name("admin.") // porzione di testo inserita prima del name di ogni rotta
    ->group(function () {
        Route::get('/', [DashboardController::class, "dashboard"])->name('dashboard');
        Route::get('/users', [DashboardController::class, "users"])->name('users');
        Route::get('/dashboard', [DashboardController::class, "dashboard"])->name('dashboard');
        Route::resource('projects', ProjectController::class);
        Route::resource('types', TypeController::class);
   });

// RIGA 48 FA LA STESSA COSA DELLE RIGHE 50-56
// Route::get('/projects', [ProjectController::class, 'index'])->name("projects.index");
// Route::get("/projects/create", [ProjectController::class, "create"])->name("projects.create");
// Route::get("/projects/{project}", [ProjectController::class, "show"])->name("projects.show");
// Route::post("/projects", [ProjectController::class, "store"])->name("projects.store");
// Route::get("/projects/{project}/edit", [ProjectController::class, "edit"])->name("projects.edit");
// Route::put("/projects/{project}", [ProjectController::class, "update"])->name("projects.update");
// Route::get("/projects/{project}/delete", [ProjectController::class, "destroy"])->name("projects.destroy");

require __DIR__.'/auth.php';
