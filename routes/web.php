<?php

use App\Http\Controllers\DealerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root to dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard (Breeze Default)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- Authenticated Dealer Routes ---
Route::middleware('auth')->group(function () {
    
    // Resource route (Index, Create, Store, Edit, Update, Destroy)
    // 'show' ko exclude kiya hai taaki undefined method error na aaye
    Route::resource('dealers', DealerController::class)->except(['show']);

    // Certificate PDF Generation
    Route::get('dealers/{id}/certificate', [DealerController::class, 'generateCertificate'])
        ->name('dealers.certificate');

    // Excel Operations
    Route::post('dealers/import', [DealerController::class, 'import'])->name('dealers.import');
    Route::get('dealers/export', [DealerController::class, 'export'])->name('dealers.export');

    // Profile Management (Breeze Default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- Public Route (QR Code Verification) ---
// Isse middleware se bahar rakhein taaki koi bhi scan kar sake
Route::get('verify/{custom_id}', [DealerController::class, 'verify'])
    ->name('dealer.verify');

// Breeze Auth Routes (login, register, logout, etc.)
require __DIR__.'/auth.php';