<?php

namespace App\Console\Commands;

use App\Models\Group;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class UserMember extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:member
                            {userId : Идентификатор пользователя}
                            {groupId : Идентификатор группы}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Добавляет пользователя user_id в группу group_id. '.
        'Если пользователь неактивен (active == false), активирует его (active = true)';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $userId = $this->argument('userId');
            $groupId = $this->argument('groupId');

            $user = User::findOrFail($userId);

            if (! $user->active) {
                $user->update(['active' => true]);
            }

            $group = Group::findOrFail($groupId);

            $user->groups()->attach($group);

            $this->info("Add user {$userId} to group {$groupId}");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'userId' => 'Укажите идентификатор пользователя',
            'groupId' => 'Укажите идентификатор группы',
        ];
    }
}
