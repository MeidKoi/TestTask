<?php

namespace App\Console\Commands;

use App\Jobs\DeactivateUser;
use App\Mail\UserRemovedFromGroupMail;
use App\Models\GroupUser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserCheckExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:check-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Исключить пользователей из групп с истекшим временем';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $dateNow = now();

        $expiredGroupUsers = GroupUser::with(['user', 'group'])
            ->where('expired_at', '<', $dateNow)
            ->get();

        if ($expiredGroupUsers->isEmpty()) {
            $this->info('Нет пользователей с истекшим сроком участия в группах.');

            return;
        }

        foreach ($expiredGroupUsers as $groupUser) {
            $user = $groupUser->user;
            $group = $groupUser->group;

            if (! $user || ! $group) {
                continue;
            }

            Mail::to($user->email)->queue(new UserRemovedFromGroupMail($user->name, $group->name));
            Log::info("В очередь поставлено отправление уведомления пользователю {$user->email} об исключении из группы {$group->name}");
        }

        $this->info("В очередь на отправку уведомлений поставлено {$expiredGroupUsers->count()} задач");

        GroupUser::with(['user', 'group'])
            ->where('expired_at', '<', $dateNow)
            ->delete();

        DeactivateUser::dispatch();
        $this->info('Запущена задача на деактивацию пользователей, не состоящих в группах.');
    }
}
