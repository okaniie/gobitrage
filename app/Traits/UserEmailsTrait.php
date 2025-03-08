<?php

namespace App\Traits;

use App\Models\EmailTemplate;
use App\Models\Setting;

trait UserEmailsTrait
{

    public string $adminRegistrationEmailId = 'registration--admin';
    public string $userRegistrationEmailId = 'registration--user';

    public string $userPasswordResetEmailId = 'password-reset--user';

    public string $adminDepositApprovedEmailId = 'deposit-approved--admin';
    public string $userDepositApprovedEmailId = 'deposit-approved--user';

    public string $adminDepositReleasedEmailId = 'deposit-released--admin';
    public string $userDepositReleasedEmailId = 'deposit-released--user';

    public string $adminDepositRequestEmailId = 'deposit-request--admin';
    public string $userDepositRequestEmailId = 'deposit-request--user';

    public string $adminReferralBonusEmailId = 'referral-bonus--admin';
    public string $userReferralBonusEmailId = 'referral-bonus--user';

    public string $adminWithdrawalApprovedEmailId = 'withdrawal-approved--admin';
    public string $userWithdrawalApprovedEmailId = 'withdrawal-approved--user';

    public string $adminWithdrawalDeclinedEmailId = 'withdrawal-declined--admin';
    public string $userWithdrawalDeclinedEmailId = 'withdrawal-declined--user';

    public string $adminWithdrawalRequestEmailId = 'withdrawal-request--admin';
    public string $userWithdrawalRequestEmailId = 'withdrawal-request--user';

    public string $userAddBonusConfirmedEmailId = 'bonus-confirmed--user';
    public string $userAddPenaltyConfirmedEmailId = 'penalty-confirmed--user';

    public function prepareTemplate(EmailTemplate $template, array $replacements): array
    {
        // merge replacements
        $replacements['site_name'] = config('app.name', 'Crypto-HYIP-Pro');
        $replacements['site_url'] = url('/');

        $subject = $template->subject;
        $message = '';

        if ($template->use_header) {
            $message .= Setting::get('email_header');
        }

        $message .= $template->content;

        if ($template->use_footer) {
            $message .= Setting::get('email_footer');
        }

        // run replacements
        foreach ($replacements as $key => $value) {
            if (preg_match("#{$key}#", $message)) {
                $message = str_replace("#{$key}#", $value, $message);
            }

            if (preg_match("#{$key}#", $subject)) {
                $subject = str_replace("#{$key}#", $value, $subject);
            }
        }

        return [$subject, $message];
    }
}
