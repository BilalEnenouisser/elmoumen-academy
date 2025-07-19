<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Admin\MaterialController as AdminMaterialController;
use App\Http\Controllers\Admin\YearController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Teacher\MaterialController as TeacherMaterialController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;


// ==============================
// 🌐 Public Pages
// ==============================

Route::get('/', function () {
    return view('home');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact', [MessageController::class, 'store'])->name('messages.store');


// ==============================
// 📚 Courses Routes
// ==============================

Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('{level}', [CourseController::class, 'showLevel'])->name('level');
    Route::get('{level}/year/{year}', [CourseController::class, 'showYear'])->name('year');
    Route::get('{level}/year/{year}/field/{field}', [CourseController::class, 'showField'])->name('field');
    Route::get('{level}/year/{year}/field/{field}/subject/{subject}', [CourseController::class, 'showSubject'])->name('subject');
});

// ==============================
// 🔐 Authenticated User Profile
// ==============================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==============================
// 🧑‍💼 Admin Dashboard
// ==============================

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // 👥 Teachers
    Route::resource('teachers', AdminTeacherController::class);

    // 📁 Materials
    Route::resource('materials', AdminMaterialController::class);

    // 📆 Years
    Route::resource('years', YearController::class);

    // 🧪 Fields
    Route::resource('fields', FieldController::class);

    // 📘 Subjects
    Route::resource('subjects', SubjectController::class);

    //  Routes for Messages
    Route::resource('messages', AdminMessageController::class)->only(['index', 'show']);


    // 🏗 Structure Management Page
    Route::get('structure', function () {
        return view('admin.structure.index', [
            'levels' => \App\Models\Level::all(),
            'years' => \App\Models\Year::with('level')->get(),
            'fields' => \App\Models\Field::with('level')->get(),
            'subjects' => \App\Models\Subject::all(),
        ]);
    })->name('structure');
});

// ==============================
// 🎓 Teacher Panel
// ==============================

Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/materials', [TeacherMaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/create', [TeacherMaterialController::class, 'create'])->name('materials.create');
    Route::post('/materials', [TeacherMaterialController::class, 'store'])->name('materials.store');
    Route::get('/materials/{material}/edit', [TeacherMaterialController::class, 'edit'])->name('materials.edit');
    Route::put('/materials/{material}', [TeacherMaterialController::class, 'update'])->name('materials.update');
    Route::delete('/materials/{material}', [TeacherMaterialController::class, 'destroy'])->name('materials.destroy');
});

// ==============================
// 🔒 Dashboard Home (Shared)
// ==============================

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==============================
// 🛂 Auth Routes
// ==============================

require __DIR__.'/auth.php';
