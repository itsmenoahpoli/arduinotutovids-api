<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    )
    {}

    public function login(LoginRequest $request) : JsonResponse
    {
        $result = $this->authService->authenticate(
            $request->only(['email', 'password'])
        );

        return response()->json($result, Response::HTTP_OK);
    }

    public function me(Request $request) : JsonResponse
    {
        $user = $request->user();

        return response()->json($user, Response::HTTP_OK);
    }
}
