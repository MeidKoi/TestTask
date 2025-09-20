<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Group\CreateGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\JsonResponse;

class GroupController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateGroupRequest  $request
     * @return JsonResponse
     */
    public function store(CreateGroupRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $group = Group::create($validatedData);

        return response()->json([
            'message' => 'Group created successfully.',
            'group' => new GroupResource($group),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return GroupResource
     */
    public function show(string $id): GroupResource
    {
        $group = Group::with('users')->findOrFail($id);

        return new GroupResource($group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateGroupRequest  $request
     * @param  Group  $group
     * @return JsonResponse
     */
    public function update(UpdateGroupRequest $request, Group $group): JsonResponse
    {
        $validatedData = $request->validated();

        $group->update($validatedData);

        return response()->json([
            'message' => 'Group updated successfully.',
            'group' => new GroupResource($group),
        ]);
    }
}
