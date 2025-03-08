<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DepositsController;
use App\Http\Controllers\User\ReferralsController;
use App\Http\Controllers\User\TransactionsController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\WithdrawalsController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')
    ->middleware(['auth'])
    ->group(function () {
        // dashboard
        Route::redirect('', 'dashboard');
        Route::get('dashboard', DashboardController::class)->name('user.dashboard');
        // profile
        Route::get('profile', [ProfileController::class, 'index'])->name('user.profile');
        Route::post('profile', [ProfileController::class, 'update']);
        // deposits
        Route::get('deposits', [DepositsController::class, 'index'])->name('user.deposits');
        Route::post('deposits', [DepositsController::class, 'create']);
        Route::get('deposits/{id}', [DepositsController::class, 'view'])->name('user.deposits.view');
        // withdrawals
        Route::get('withdrawals', [WithdrawalsController::class, 'index'])->name('user.withdrawals');
        Route::post('withdrawals', [WithdrawalsController::class, 'create']);
        Route::get('withdrawals/{id}', [WithdrawalsController::class, 'view'])->name('user.withdrawals.view');
        Route::get('withdrawals/{id}/delete', [WithdrawalsController::class, 'destroy'])->name('user.withdrawals.delete');
        // referrals
        Route::get('referrals', [ReferralsController::class, 'index'])->name('user.referrals');
        Route::get('referrals/{id}', [ReferralsController::class, 'view'])->name('user.referrals.view');
        // transactions
        Route::get('transactions', [TransactionsController::class, 'index'])->name('user.transactions');
    });
