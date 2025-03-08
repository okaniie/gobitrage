# Admin Dashboard

The admin dashboard is divided into sections. We will go through the typical use case from fresh time installation to paying clients.

## 1 - Settings
First things first, go to Settings page to set up the basics. In here you will find:
* Active Currencies (skip for now, we will talk about it next.)
* Minimum Withdrawal Amount: This is the minimum amount a client will need to have in wallet to place withdrawal request. For example, if you set it to 50, only clients with $50 and above can place withdrawal.
* Pay Referral Bonus: This is where you toggle referral payments. If set to No, referrals will not receive commissions. If set to yes, referrals will receive commissions on every deposit made by the downliner. The percentage of this bonus is set in the `Investment Packages` Section.
* Google Tracking ID: In order to use Google analytics, paste your Google Tracking ID here. It is optional.
* Header Code: This is where you put any code that needs to appear in the `<head>...</head>` section of your webpages. This can be a livechat script, or a stylesheet.
* Footer Code: This piece of code will appear just before the `</body>` tag of your webpages. Also mainly used for chat plugins and customizations.


## 2 - Processings
After settings, you need to visit the Processings page to set up the payment methods. Each currency can be turned on and off. The ones turned on will appear as bold on the processings page. Follow these steps to set it up:

* Click `EDIT` on the Currency you want to set up. 
* Status: Turns this currency on and off.
* Deposit Processing: Select an automatic processing platform. Each platform has it's own instructions. Please follow the guide on screen.
* If you want to handle deposits for this manually, please select processing as `None` and provide a Fallback Address in the next field. A fallback address is the address a client will send money to in case automatic deposit fails or is turned off.
* Deposit Limits
* Deposit Limits - Min: The min amount the user can deposit using this currency.
* Deposit Limits - Max: The maximum amount the user can deposit using this currency. Set to `0` to allow unlimited.
* Deposit Fees
* Fee: If you want the user to be charged for deposits, then set this place accordingly. This is the percentage the user will be charged.
* Additional Fee: An extra fee to be added on the charges after calculating the fees.
* Min is the lowest possible fee. For instance if a user was meant to be charged $20 for a transaction and the Min is set to $40, the user will be charged $40 instead.
* Max is the highest charge. For instance if a user is to be charged $400 but the max is set to $200, then the user will be charged just $200.
* Auto-Withdraw
* Auto-Withdraw Status: Turn this on if you want to processing withdrawals automatically. Also note that you must set the processing detiails for withdrawal in order to make it valid.
* Processing: Select a service for processing withdrawals and set up required fields. Also note that global auto withdrawal must be turned on for this to work. 

* Auto-withdraw Limits
* Auto-withdraw Limits - Min: The minimum amount that can be considered for automatic withdrawal.
* Auto-withdraw Limits - Max: The maximum amount that can be processed automatically.

* Click on update to finish setup.

## 3 - Auto-Withdrawal Settings
This is where you set the global autowithdrawal settings.

* Auto-Withdrawals Status: Set this to `Enabled` to turn it on or `Disabled` to turn it off.
* Processings: visit the processings sections above.
* Maximum daily withdrawal: This is the maximum amount a user can withdraw to their wallets in a day. Leave blank or set to 0 to remove restriction.

Click on `Save`

## 4 - Investment Package
The next thing you want to do is set up your `Investment Plans`. To do so, click on the plans menu item, click on `Add a new Investment Package`. This is how you fill the form.

* Title: The name you want the package to bear. `e.g. Gold Package`
* Plan Category: You can group your plans into categories. The default category is `Crypto-Plans` and you can create more under the `Plan Categories` menu item.
* Featured Plan: This is similar to setting the plan as special so the UI guy can make it look different from the others.
* Minimum Deposit Amount: This is the minimum amount a client can deposit for this plan.
* Maximum Deposit Amount: The maximum amount a client can deposit for this plan. Leave it as `0` to make it unlimited.
* Referral Percentage: This is percentage of the money the referrer can earn for any payment to this package.
* Interest Percentage / Frequency: This is how often the client's profit is to be calculated. For example, If interest is 10% daily, enter `10` in the first field, and select `daily` from the second field 
* Plan lifespan: This is the entire duration the plan will run before expiration. For example, if plan will last for 3 days, enter `3` in the first field and select `Day(s)` from second field. Note that Plan lifespan must be able to accommodate interest percentage/frequency. For instance, you can't have a plan with interest frequency of 10% weekly on plan with lifespan of 3 days.

Click on the **Submit** button to submit the form and create the plan.

## 5 - Test
Once you're done withthe above settings, you can proceed to test things out by logging out, creating a new account to get a user account, then test the deposits, withdrawals, share your referral links and test.

## 6 - Reports and Actions
There are many reports available. The following menus are still available for reports and actions.
* Withdrawal Requests: This is a list of withdrawal requests made by the users. Please confirm the request, send money to the user, and mark as done. If you enabled autowithdrawal, it will not appear here as it is processed automatically. It will appear as completed.
* All Withdrawals: This is list of all withdrawals, both pending, declined, approved.
* Pending Deposits: These are deposit requests from users. This will populate if you do not have automatic deposit activated.
* All Deposits: These are all deposits available, both fulfilled and unfilfilled.
* Referrals: This is where you see referrals and how much they have earned so far in their accounts.
* Transactions: Here, all transactions are listed. From Deposit to Penalty are all different types of transaction.

* Send Newsletter: This is where you send emails or newsletters to users. You can send to all, or inactive user, people who have deposited to a particular plan.

* Email Templates: Here you can customize the email templates used to communicate with the clients and admin.
