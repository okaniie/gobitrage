<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepositsController;
use App\Http\Controllers\Admin\EmailTemplatesController;
use App\Http\Controllers\Admin\NewslettersController;
use App\Http\Controllers\Admin\PlanCategoriesController;
use App\Http\Controllers\Admin\PlansController;
use App\Http\Controllers\Admin\ProcessingsController;
use App\Http\Controllers\Admin\ReferralsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WithdrawalsController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {
        //dashboard
        Route::redirect('', 'dashboard');
        Route::get('dashboard', DashboardController::class)->name('admin.dashboard');

        // users
        Route::prefix('users')
            ->controller(UsersController::class)
            ->group(function () {
                Route::get('', 'index')->name('admin.users');
                Route::get('new', 'store')->name('admin.users.new');
                Route::post('new', 'create');
                Route::get('{id}/edit', 'viewSingle')->name('admin.users.view');
                Route::post('{id}/edit', 'update');
                Route::get('{id}/funds', 'userFunds')->name('admin.users.funds');
                Route::get('{id}/delete', 'delete')->name('admin.users.delete');
                // bonus
                Route::get('{id}/add-bonus', 'addBonusView')->name('admin.users.bonus.view');
                Route::post('{id}/add-bonus', 'addBonusAction')->name('admin.users.bonus.add');
                // penalty
                Route::get('{id}/add-penalty', 'addPenaltyView')->name('admin.users.penalty.view');
                Route::post('{id}/add-penalty', 'addPenaltyAction')->name('admin.users.penalty.add');
                // block user
                Route::post('{id}/block', 'blockUser')->name('admin.users.block');
            });

        // referrals
        Route::prefix('referrals')
            ->controller(ReferralsController::class)
            ->group(function () {
                Route::get('', 'index')->name('admin.referrals');
                Route::get('{id}', 'viewSingle')->name('admin.referrals.view');
            });

        // withdrawals 
        Route::prefix('withdrawals')
            ->controller(WithdrawalsController::class)
            ->group(function () {
                Route::get('', 'index')->name('admin.withdrawals');
                Route::get('{id}', 'viewSingle')->name('admin.withdrawals.view');
                Route::get('{id}/delete', 'delete')->name('admin.withdrawals.delete');
                Route::get('{id}/decline', 'decline')->name('admin.withdrawals.decline');
                Route::get('{id}/approve', 'approve')->name('admin.withdrawals.approve');
            });


        // deposits 
        Route::prefix('deposits')
            ->controller(DepositsController::class)
            ->group(function () {
                Route::get('', 'index')->name('admin.deposits');
                Route::get('{id}', 'viewSingle')->name('admin.deposits.view');
                Route::get('{id}/delete', 'delete')->name('admin.deposits.delete');
                Route::get('{id}/release', 'release')->name('admin.deposits.release');
                Route::get('{id}/approve', 'approve')->name('admin.deposits.approve');
            });

        // transactions
        Route::prefix('transactions')
            ->controller(TransactionsController::class)
            ->group(function () {
                Route::get('', 'index')->name('admin.transactions');
                Route::get('{id}', 'viewSingle')->name('admin.transactions.view');
            });

        // plans
        Route::prefix('plans')
            ->controller(PlansController::class)
            ->group(function () {
                Route::get('new', 'store')->name('admin.plans.new');
                Route::post('new', 'create');
                Route::get('{id}', 'viewSingle')->name('admin.plans.view');
                Route::post('{id}', 'update');
                Route::get('{id}/delete', 'delete')->name('admin.plans.delete');
            });


        // plan categories
        Route::prefix('plan-categories')
            ->controller(PlanCategoriesController::class)
            ->group(function () {
                Route::get('', 'index')->name('admin.plan-categories');
                Route::post('', 'create');
                Route::get('{id}/delete', 'delete')->name('admin.plan-categories.delete');
                Route::get('{id}/move/{dir}', 'move')->name('admin.plan-categories.move');
            });



        // newsletter
        Route::prefix('newsletter')
            ->controller(NewslettersController::class)
            ->group(function () {
                Route::get('', 'index')->name('admin.newsletter');
                Route::post('', 'queueNewsletter');
            });

        // newsletter
        Route::prefix('email-templates')
            ->controller(EmailTemplatesController::class)
            ->group(function () {
                Route::get('', 'index')->name('admin.email-templates');
                Route::post('', 'updateHeaderFooter');
                Route::get('{id}', 'viewSingle')->name('admin.email-templates.view');
                Route::post('{id}', 'update');
            });

        // settings
        Route::prefix('settings')
            ->controller(SettingsController::class)
            ->group(function () {
                Route::get('', 'index')->name('admin.settings');
                Route::post('update-settings', 'update')->name('admin.settings.update');
                Route::get('autowithdrawal', 'autowithdrawal')->name('admin.settings.autowithdrawal');
                Route::post('autowithdrawal', 'autowithdrawalUpdate');
            });

        // processings
        Route::prefix('processings')
            ->controller(ProcessingsController::class)
            ->group(function () {
                Route::get('', 'index')->name('admin.processings');
                Route::get('/create', 'create')->name('admin.processings.create');
                Route::post('/store', 'store')->name('admin.processings.store');
                Route::get('{id}', 'view')->name('admin.processings.view');
                Route::post('{id}', 'update');
            });

    });
