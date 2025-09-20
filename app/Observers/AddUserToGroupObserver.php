<?php

namespace App\Observers;

use App\Models\GroupUser;
use Illuminate\Support\Facades\Log;

class AddUserToGroupObserver
{
    /**
     * Handle the GroupUser "created" event.
     */
    public function created(GroupUser $groupUser): void
    {
        $group = $groupUser->group;
        if ($group && $group->expire_hours) {
            $groupUser->expired_at = now()->addHours($group->expire_hours);
            $groupUser->saveQuietly();
            Log::info("User {$groupUser->user_id} added to group {$groupUser->group_id} with expiration in {$group->expire_hours} hours");
        } else {
            Log::warning('Error while attempt add expired_at');
        }
    }
}
