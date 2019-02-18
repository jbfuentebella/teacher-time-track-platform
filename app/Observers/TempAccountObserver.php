<?php

namespace App\Observers;

use App\TempAccount;
use App\Account;
use App\Mail\NewTeacherEmail;
use Illuminate\Support\Facades\Mail;

class TempAccountObserver
{
    /**
     * Handle the account "creating" event.
     *
     * @param  \App\TempAccount  $tempAccount
     * @return void
     */
    public function creating(TempAccount $tempAccount)
    { 
        $tempAccount->verification_status = TempAccount::VERIFICATION_PENDING;
        $tempAccount->verification_token = TempAccount::generateUniqueVerificationToken();
    }

    /**
     * Handle the temp account "created" event.
     *
     * @param  \App\TempAccount  $tempAccount
     * @return void
     */
    public function created(TempAccount $tempAccount)
    {
        Mail::to($tempAccount->email)->send(new NewTeacherEmail($tempAccount));
    }

    /**
     * Handle the temp account "updated" event.
     *
     * @param  \App\TempAccount  $tempAccount
     * @return void
     */
    public function updated(TempAccount $tempAccount)
    {
        $isVerified = (
            $tempAccount->verification_status == TempAccount::VERIFICATION_VERIFIED &&
            !empty($tempAccount->verification_date)
        );

        if ($isVerified) {
            $this->updateOtherPendingRegistrations($tempAccount);
            $this->createAccount($tempAccount);
        }

    }

    /**
     * Handle the temp account "deleted" event.
     *
     * @param  \App\TempAccount  $tempAccount
     * @return void
     */
    public function deleted(TempAccount $tempAccount)
    {
        //
    }

    /**
     * Handle the temp account "restored" event.
     *
     * @param  \App\TempAccount  $tempAccount
     * @return void
     */
    public function restored(TempAccount $tempAccount)
    {
        //
    }

    /**
     * Handle the temp account "force deleted" event.
     *
     * @param  \App\TempAccount  $tempAccount
     * @return void
     */
    public function forceDeleted(TempAccount $tempAccount)
    {
        //
    }

    private function updateOtherPendingRegistrations(TempAccount $tempAccount)
    {
        TempAccount::where([
                ['email', '=', $tempAccount->email],
                ['verification_status', '=', TempAccount::VERIFICATION_PENDING],
                ['id', '!=', $tempAccount->id]
            ])
            ->update(['verification_status' => TempAccount::VERIFICATION_DONE]);
    }

    private function createAccount(TempAccount $tempAccount)
    {
        $account = new Account($tempAccount->toArray());
        $account->temp_account_id = $tempAccount->id;
        $account->password = $tempAccount->password;
        $account->role = $tempAccount->role;
        $account->verification_date = $tempAccount->verification_date;
        $account->slug = Account::generateUniqueSlug();

        $account->save();
    }
}
