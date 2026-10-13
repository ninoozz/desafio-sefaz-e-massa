<?php

namespace App\Http\Controllers\Api;

use App\Actions\Profile\DeleteAccountAction;
use App\Actions\Profile\UpdatePasswordAction;
use App\Actions\Profile\UpdateProfileAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\DeleteAccountRequest;
use App\Http\Requests\Api\Profile\UpdatePasswordRequest;
use App\Http\Requests\Api\Profile\UpdateProfileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }

    public function update(UpdateProfileRequest $request, UpdateProfileAction $action): JsonResponse
    {
        $user = $action->execute(
            $request->user(),
            $request->validated('name'),
            $request->validated('email'),
        );

        return response()->json($user);
    }

    public function updatePassword(UpdatePasswordRequest $request, UpdatePasswordAction $action): JsonResponse
    {
        $action->execute($request->user(), $request->validated('password'));

        return response()->json(['message' => 'Senha atualizada com sucesso.']);
    }

    public function destroy(DeleteAccountRequest $request, DeleteAccountAction $action): JsonResponse
    {
        $action->execute($request->user());

        return response()->json(['message' => 'Conta removida com sucesso.']);
    }
}
