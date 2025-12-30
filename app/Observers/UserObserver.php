<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Create company profile for company_profile users
        if ($user->type === 'company_profile' && !$user->company) {
            \App\Models\Company::create([
                'user_id' => $user->id,
                'name_ar' => $user->name,
                'name_en' => $user->name,
                'contact_email' => $user->email,
                'category_id' => null, // Will be updated by user
                'description_ar' => 'الوصف الافتراضي - يرجى التحديث',
                'description_en' => 'Default description - Please update',
                'language' => 'ar',
                'status' => 'pending',
                'is_visible' => true,
                'sort' => 0,
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
