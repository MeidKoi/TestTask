<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    /**
     * Disable auto addition timestamp
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'expire_hours',
    ];

    /**
     * Get users in a group
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->using(GroupUser::class);
    }
}
