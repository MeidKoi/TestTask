<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'active' => $this->active,
            'groups' => $this->whenLoaded('groups',
                $this->groups->map(fn ($group) => [
                    'id' => $group->id,
                    'name' => $group->name,
                    'expire_hours' => $group->expire_hours,
                ])),
        ];
    }
}
