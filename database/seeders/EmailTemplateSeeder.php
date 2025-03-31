<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{

    private $emailTemplates  = [
        // registration
        [
            'code' => 'registration--admin',
            'title' => 'Admin - Registration',
            'subject' => 'New User Regisitration',
            'content' => "A new user just registered on your website.<br/>Name: #name#<br/>Username: #username#<br/>",
            'description' => "Admin will receive this e-mail when new user registers.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login",
        ],
        [
            'code' => 'registration--user',
            'title' => 'Registration',
            'subject' => 'Welcome Onboard - #site_name#',
            'content' => "Hello #name#,<br/><br/>Thank you for registering on our site.<br/><br/>Your login information:<br/>Login: #username#<br/><br/>-----<br/><br/>You can login here: #site_url#<br/><br/>Contact us immediately if you did not authorize this registration.<br/>Thank you.",
            'description' => "Users will receive this e-mail after registration.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],

        // password reset
        [
            'code' => 'password-reset--user',
            'title' => 'Password Reset',
            'subject' => 'Your password has been reset - #site_name#',
            'content' => "Hello #name#,<br/><br/>Your password has been reset successfully.<br/><br/>Contact us immediately if you did not authorize this action.<br/>Thank you.",
            'description' => "Users will receive this e-mail after successful password reset.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],

        // deposit approval
        [
            'code' => 'deposit-approved--admin',
            'title' => 'Admin - Deposit Approval',
            'subject' => 'Deposit approved for user',
            'content' => "Deposit of $#amount# approved for user: #username#",
            'description' => "Admin email for deposit approval.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],
        [
            'code' => 'deposit-approved--user',
            'title' => 'Deposit Approval',
            'subject' => 'Your deposit has been approved - #site_name#',
            'content' => "Hello #name#,<br/><br/>Your deposit of $#amount# has been approved successfully. You will start receiving interests on it. Congratulations!<br/><br/>Contact us immediately if you did not authorize this action.<br/>Thank you.",
            'description' => "Users will receive this e-mail after deposit approval.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],

        // deposit released
        [
            'code' => 'deposit-released--admin',
            'title' => 'Admin - Deposit Released',
            'subject' => 'Deposit released for user',
            'content' => "Deposit of $#amount# has been released for user: #username#",
            'description' => "Admin email for deposit release.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],
        [
            'code' => 'deposit-released--user',
            'title' => 'Deposit Released',
            'subject' => 'Congratulations! Deposit Released! - #site_name#',
            'content' => "Hello #name#,<br/><br/>Your deposit of $#amount# has been successfully released.<br/><br/>Contact us immediately if you did not authorize this action.<br/>Thank you.",
            'description' => "Users will receive this e-mail after deposit release.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],

        // deposit request
        [
            'code' => 'deposit-request--admin',
            'title' => 'Admin - Pending Deposit Request',
            'subject' => 'Pending Deposit for user',
            'content' => "Deposit of $#amount# pending for user: #username#",
            'description' => "Admin email for deposit requests.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],
        [
            'code' => 'deposit-request--user',
            'title' => 'Pending Deposit Request',
            'subject' => 'Pending Deposit - #site_name#',
            'content' => "Hello #name#,<br/><br/>Your deposit of \$#amount# is currently pending. <br/>Please complete the deposit to start earning returns.<br/></br>Thank you.",
            'description' => "Users will receive this e-mail for pending deposits.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],

        // referral bonus
        [
            'code' => 'referral-bonus--admin',
            'title' => 'Admin - Referral Commission',
            'subject' => 'Referral commision paid to user',
            'content' => "Commission of $#amount# has been paid into user: #username# account balance.",
            'description' => "Admin email for Referral Commission.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],
        [
            'code' => 'referral-bonus--user',
            'title' => 'Referral Commission',
            'subject' => 'Referral Commision Paid - #site_name#',
            'content' => "Hello #name#,<br/><br/>A referral commission of $#amount# has been paid into your balance.<br/><br/>Thank you.",
            'description' => "Users will receive this e-mail for referral commissions.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],

        // withdrawal approval
        [
            'code' => 'withdrawal-approved--admin',
            'title' => 'Admin - Withdrawal Approved',
            'subject' => 'Withdrawal approved for user',
            'content' => "Withdrawal of $#amount# approved for user: #username#",
            'description' => "Admin email for withdrawal approval.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],
        [
            'code' => 'withdrawal-approved--user',
            'title' => 'Withdrawal Approved',
            'subject' => 'Your withdrawal has been processed',
            'content' => "Hello #name#,<br/><br/>Your withdrawal of $#amount# has been processed successfully.<br/><br/>Contact us immediately if you did not authorize this action.<br/>Thank you.",
            'description' => "Users will receive this e-mail after withdrawal approval.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],

        // withdrawal declined
        [
            'code' => 'withdrawal-declined--admin',
            'title' => 'Admin - Withdrawal Declined',
            'subject' => 'Withdrawal declined for user',
            'content' => "Withdrawal of $#amount# has been declined for user: #username#",
            'description' => "Admin email for withdrawal decline.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],
        [
            'code' => 'withdrawal-declined--user',
            'title' => 'Withdrawal Declined',
            'subject' => 'Your withdrawal has been declined',
            'content' => "Hello #name#,<br/><br/>Your withdrawal of $#amount# has been declined. Please contact support.<br/><br/>Thank you.",
            'description' => "Users will receive this e-mail after withdrawal decline.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],

        // withdrawal request
        [
            'code' => 'withdrawal-request--admin',
            'title' => 'Admin - Pending Withdrawal Request',
            'subject' => 'Pending Withdrawal for user',
            'content' => "Withdrawal of $#amount# pending for user: #username#",
            'description' => "Admin email for withdrawal request.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],
        [
            'code' => 'withdrawal-request--user',
            'title' => 'Pending Withdrawal Request',
            'subject' => 'Pending withdrawal',
            'content' => "Hello #name#,<br/><br/>Your withdrawal request for $#amount# has received successfully. Please be patient while the system processes your request.<br/><br/>Thank you.",
            'description' => "Users will receive this e-mail for pending withdrawals.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],

        // bonus and penalty
        [
            'code' => 'bonus-confirmed--user',
            'title' => 'User Bonus Added Email',
            'subject' => 'You have received a bonus of $#amount#',
            'content' => "You just received a bonus of $#amount#. Congratulations.",
            'description' => "User will receive this mail when a bonus has been added <br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],
        [
            'code' => 'penalty-confirmed--user',
            'title' => 'User Penalty Subtracted Email',
            'subject' => 'A Penalty of $#amount# has been subtracted',
            'content' => "Hello #name#,<br/><br/>A penalty of $#amount# has been deducted from your accoun. Please contact support for further assistance.<br/><br/>Thank you.",
            'description' => "Users will receive this e-mail when penalty is subtracted from account.<br/><strong>Personalization:</strong><br/>#name# - first and last user name.<br/>#username# - user login</br>#amount# - the amount</br>#site_url# - your site url<br/>#site_name# - your site name<br/>",
        ],

        // deposit notifications
        [
            'code' => 'deposit--admin',
            'title' => 'Admin - New Deposit',
            'subject' => 'New Deposit Request',
            'content' => "A new deposit request has been received.<br/><br/>User: #name# (#username#)<br/>Amount: #amount# #currency#<br/>Plan: #plan#<br/>Transaction ID: #transaction_id#<br/><br/>Please review and process this deposit request.",
            'description' => "Admin will receive this e-mail when a new deposit request is made.<br/><strong>Personalization:</strong><br/>#name# - user's full name<br/>#username# - user's username<br/>#amount# - deposit amount<br/>#currency# - currency code<br/>#plan# - plan title<br/>#transaction_id# - transaction ID",
        ],
        [
            'code' => 'deposit--user',
            'title' => 'Deposit Request Received',
            'subject' => 'Deposit Request Received - #site_name#',
            'content' => "Hello #name#,<br/><br/>Your deposit request has been received.<br/><br/>Amount: #amount# #currency#<br/>Plan: #plan#<br/>Transaction ID: #transaction_id#<br/><br/>We will process your deposit request shortly.<br/><br/>Thank you for choosing #site_name#.",
            'description' => "Users will receive this e-mail when they make a deposit request.<br/><strong>Personalization:</strong><br/>#name# - user's full name<br/>#amount# - deposit amount<br/>#currency# - currency code<br/>#plan# - plan title<br/>#transaction_id# - transaction ID<br/>#site_name# - your site name",
        ],

        // withdrawal notifications
        [
            'code' => 'withdrawal--admin',
            'title' => 'Admin - New Withdrawal',
            'subject' => 'New Withdrawal Request',
            'content' => "A new withdrawal request has been received.<br/><br/>User: #name# (#username#)<br/>Amount: #amount# #currency#<br/>Address: #address#<br/>Transaction ID: #transaction_id#<br/><br/>Please review and process this withdrawal request.",
            'description' => "Admin will receive this e-mail when a new withdrawal request is made.<br/><strong>Personalization:</strong><br/>#name# - user's full name<br/>#username# - user's username<br/>#amount# - withdrawal amount<br/>#currency# - currency code<br/>#address# - withdrawal address<br/>#transaction_id# - transaction ID",
        ],
        [
            'code' => 'withdrawal--user',
            'title' => 'Withdrawal Request Received',
            'subject' => 'Withdrawal Request Received - #site_name#',
            'content' => "Hello #name#,<br/><br/>Your withdrawal request has been received.<br/><br/>Amount: #amount# #currency#<br/>Address: #address#<br/>Transaction ID: #transaction_id#<br/><br/>We will process your withdrawal request shortly.<br/><br/>Thank you for choosing #site_name#.",
            'description' => "Users will receive this e-mail when they make a withdrawal request.<br/><strong>Personalization:</strong><br/>#name# - user's full name<br/>#amount# - withdrawal amount<br/>#currency# - currency code<br/>#address# - withdrawal address<br/>#transaction_id# - transaction ID<br/>#site_name# - your site name",
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!\App\Models\EmailTemplate::exists()) {
            foreach ($this->emailTemplates as $et) {
                \App\Models\EmailTemplate::create($et);
            }
        }
    }
}
