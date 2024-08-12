<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function user(Request $request)
    {
        $user = $this->userService->getUser();

        $resource = new UserResource($user);

        if ($user->isInfluencer()) {
            return $resource->additional([
                'data' => [
                    'revenue' => $user->revenue
                ]
            ]);
        }

        return $resource->additional([
            'data' => [
                'role' => $user->role,
                'permissions' => $user->permissions
            ]
        ]);
    }
}
