<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUserRequest  $request
     * @return JsonResponse
     */
    public function store(CreateUserRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create($validatedData);

        return response()->json([
            'message' => 'User created successfully',
            'user' => new UserResource($user),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string  $id
     * @return UserResource
     */
    public function show(string $id): UserResource
    {
        $user = User::with('groups')->findOrFail($id);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest  $request
     * @param  User  $user
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $validatedData = $request->validated();

        $user->update($validatedData);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => new UserResource($user),
        ]);
    }
}
