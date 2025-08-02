<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Admin\MaterialController as AdminMaterialController;
use App\Http\Controllers\Admin\YearController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Teacher\MaterialController as TeacherMaterialController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\MarqueeController;
use App\Http\Controllers\Admin\CategoryVideoController as AdminCategoryVideoController;
use App\Http\Controllers\VideoController as PublicVideoController;




// ==============================
// 🌐 Public Pages
// ==============================

Route::get('/', function () {
    return view('home');
});
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact', [MessageController::class, 'store'])->name('messages.store');


// ==============================
// 📚 Courses Routes
// ==============================

Route::prefix('courses')->name('courses.')->group(function () {
    // Show years for selected level
    Route::get('{level}', [CourseController::class, 'showLevel'])->name('level');

    // Show materials for year (non-Lycée)
    Route::get('{level}/year/{year}', [CourseController::class, 'showYear'])->name('year');

    // Show materials for Lycée with field
    Route::get('{level}/year/{year}/field/{field}', [CourseController::class, 'showField'])->name('field');
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
        $stats = \App\Services\AnalyticsService::getDashboardStats();
        return view('admin.dashboard', compact('stats'));
    })->name('dashboard');

    // 👥 Teachers
    Route::resource('teachers', AdminTeacherController::class);

    // 📁 Materials
    Route::resource('materials', AdminMaterialController::class);
    Route::delete('materials/pdf/{pdf}', [AdminMaterialController::class, 'deletePdf'])->name('materials.pdf.delete');
    Route::delete('materials/video/{video}', [AdminMaterialController::class, 'deleteVideo'])->name('materials.video.delete');
    Route::get('materials/years/{level}', [AdminMaterialController::class, 'getYearsByLevel'])->name('materials.years.by.level');

    // 📆 Years
    Route::resource('years', YearController::class);

    // 🧪 Fields
    Route::resource('fields', FieldController::class);


    //  Routes for Messages
    Route::resource('messages', AdminMessageController::class)->only(['index', 'show']);

    //  VideoController (Old) - Removed in favor of CategoryVideoController
    // Route::resource('videos', VideoController::class);

    //  CategoryVideoController (New)
    Route::resource('category-videos', AdminCategoryVideoController::class)->parameters([
        'category-videos' => 'video'
    ]);

    //  MarqueeController
    Route::get('marquees', [MarqueeController::class, 'index'])->name('marquees.index');
    Route::post('marquees', [MarqueeController::class, 'store'])->name('marquees.store');
    Route::delete('marquees/{marquee}', [MarqueeController::class, 'destroy'])->name('marquees.destroy');

    // 📚 Books Management
    Route::resource('books', App\Http\Controllers\Admin\BookController::class);
    
    // Book Categories Management (separate from books)
    Route::get('book-categories', [App\Http\Controllers\Admin\BookCategoryController::class, 'index'])->name('books.categories.index');
    Route::post('book-categories', [App\Http\Controllers\Admin\BookCategoryController::class, 'store'])->name('books.categories.store');
    Route::put('book-categories/{category}', [App\Http\Controllers\Admin\BookCategoryController::class, 'update'])->name('books.categories.update');
    Route::delete('book-categories/{category}', [App\Http\Controllers\Admin\BookCategoryController::class, 'destroy'])->name('books.categories.destroy');

    // WhatsApp Number Management
    Route::get('whatsapp', [App\Http\Controllers\Admin\WhatsAppNumberController::class, 'index'])->name('whatsapp.index');
    Route::post('whatsapp', [App\Http\Controllers\Admin\WhatsAppNumberController::class, 'store'])->name('whatsapp.store');
    Route::put('whatsapp/{whatsappNumber}', [App\Http\Controllers\Admin\WhatsAppNumberController::class, 'update'])->name('whatsapp.update');


    // 🏗 Structure Management Page
    Route::get('structure', function () {
        return view('admin.structure.index', [
            'levels' => \App\Models\Level::all(),
            'years' => \App\Models\Year::with('level')->get(),
            'fields' => \App\Models\Field::with('level')->get(),
        ]);
    })->name('structure');
});

// Removed old video routes - using CategoryVideoController instead

// ==============================
// 📹 Public Video Routes
// ==============================

Route::prefix('videos')->name('videos.')->group(function () {
    Route::get('category/{slug}', [PublicVideoController::class, 'category'])->name('category');
    Route::get('show/{video}', [PublicVideoController::class, 'show'])->name('show');
});

// ==============================
// 📚 Public Book Routes
// ==============================

Route::prefix('books')->name('books.')->group(function () {
    Route::get('/', [App\Http\Controllers\BookController::class, 'index'])->name('index');
    Route::get('/category/{category:slug}', [App\Http\Controllers\BookController::class, 'category'])->name('category');
    Route::get('/{book:slug}', [App\Http\Controllers\BookController::class, 'show'])->name('show');
    
    // Book Click Tracking
    Route::post('/{book}/click', [App\Http\Controllers\BookClickController::class, 'track'])->name('click');
    Route::get('/stats', [App\Http\Controllers\BookClickController::class, 'getStats'])->name('stats');
});

// ==============================
// 📊 Analytics Tracking Routes
// ==============================

Route::post('track/pdf-download/{pdf}', function (Request $request, $pdf) {
    \App\Services\AnalyticsService::trackPdfDownload($request, $pdf);
    return response()->json(['success' => true]);
})->name('track.pdf-download');

Route::post('track/video-click/{video}', function (Request $request, $video) {
    \App\Services\AnalyticsService::trackVideoClick($request, $video);
    return response()->json(['success' => true]);
})->name('track.video-click');

// ==============================
// 🎓 Teacher Panel
// ==============================

Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/', [App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/materials', [TeacherMaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/create', [TeacherMaterialController::class, 'create'])->name('materials.create');
    Route::post('/materials', [TeacherMaterialController::class, 'store'])->name('materials.store');
    Route::get('/materials/{material}/edit', [TeacherMaterialController::class, 'edit'])->name('materials.edit');
    Route::put('/materials/{material}', [TeacherMaterialController::class, 'update'])->name('materials.update');
    Route::delete('/materials/{material}', [TeacherMaterialController::class, 'destroy'])->name('materials.destroy');
    Route::delete('/materials/pdf/{pdf}', [TeacherMaterialController::class, 'deletePdf'])->name('materials.pdf.delete');
    Route::get('/materials/years/{level}', [TeacherMaterialController::class, 'getYearsByLevel'])->name('materials.years.by.level');
});

// ==============================
// 🔒 Dashboard Home (Shared)
// ==============================

Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->hasRole('teacher')) {
        return redirect()->route('teacher.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==============================
// 🛂 Auth Routes
// ==============================

require __DIR__.'/auth.php';
