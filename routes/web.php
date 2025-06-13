<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HyipInstallerController;
use App\Http\Controllers\IpnCallbackController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Mail\SignUpMail;
use Illuminate\Support\Facades\Mail;

// Optional: Add a secret token to prevent unauthorized access
Route::get('/run-schedule', function () {
    if (request('token') !== env('CRON_TOKEN')) {
        abort(403);
    }

    Artisan::call('schedule:run');

    return 'Schedule run completed';
});

// Route::get('/test-email', function () {
//     $user = \App\Models\User::first(); // Use actual model
//     Mail::to($user->email)->send(new SignUpMail($user));
//     return 'Mail sent!';
// });


Route::get('/test-email', function() {
    try {
        Mail::raw('This is a test email from Brevo', function($message) {
            $message->to('teleiosperfect1@gmail.com')
                    ->subject('Brevo Test Email');
        });
        return 'Test email sent! Check your inbox.';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

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

// controller
Route::get('/install', [HyipInstallerController::class, 'step1Init'])->name('installer.step1');
Route::post('/install', [HyipInstallerController::class, 'step1Complete']);

Route::get('/install-step2', [HyipInstallerController::class, 'step2Init'])->name('installer.step2');
Route::post('/install-step2', [HyipInstallerController::class, 'step2Complete']);

Route::get('/install-step3', [HyipInstallerController::class, 'step3Init'])->name('installer.step3');

// page views
Route::controller(FrontController::class)
    ->group(function () {

        Route::get('/', 'index')->name('home');
        Route::get('/last-transactions/{type}', 'lastTransactions')->name('api.last-transactions');
        Route::get('/ref/{ref}', 'affiliate')->name('ref');

        Route::post('/contact-us', 'contactUs')->name('contact-us-form');
    });

// IPN CALLBACK
Route::any("/ipn-callback/deposit/{processor}", [IpnCallbackController::class, 'deposit'])->name('ipn.callback.deposit');
Route::any("/ipn-callback/withdrawal/{processor}", [IpnCallbackController::class, 'withdrawal'])->name('ipn.callback.withdrawal');

// bonus confirm and penalty confirm links. brought them out to avoid asking for authentication at all times
Route::get('/admin/add-bonus-confirm/{token}', [UsersController::class, 'bonusConfirm'])->name('admin.users.bonus.confirm');
Route::get('/admin/add-penalty-confirm/{token}', [UsersController::class, 'penaltyConfirm'])->name('admin.users.penalty.confirm');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';

// Test notifications route
Route::get('/test-notifications', [App\Http\Controllers\TestController::class, 'testNotifications']);

//catch-all page
Route::get('/{page}', [FrontController::class, 'pageView'])->name('page');
