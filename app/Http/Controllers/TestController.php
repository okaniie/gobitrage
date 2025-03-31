<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Traits\EmailNotificationTrait;
use Illuminate\Http\Request;

class TestController extends Controller
{
    use EmailNotificationTrait;

    public function testNotifications()
    {
        $user = User::where('email', 'test@example.com')->first();
        $deposit = Deposit::latest()->first();
        $withdrawal = Withdrawal::latest()->first();
        
        $this->sendDepositNotification($deposit, $user);
        $this->sendWithdrawalNotification($withdrawal, $user);
        
        return response()->json(['message' => 'Notifications sent successfully']);
    }
} 