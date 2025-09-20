<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class DeactivateUser implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $usersNotInGroupCount = User::leftJoin('group_user', 'users.id', '=', 'group_user.user_id')
            ->whereNull('group_user.user_id')
            ->where(['users.active' => true])
            ->update(['users.active' => false]);
        Log::info("Deactivate {$usersNotInGroupCount} users");
    }
}
