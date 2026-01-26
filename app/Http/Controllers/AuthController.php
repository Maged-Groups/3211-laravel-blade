<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login_form()
    {
        return view('auth.login-form');
    }

    public function login(LoginRequest $request)
    {

        // return $request->all();
        $loginData = $request->validated();

        $authenticated = Auth::attempt($loginData);

        if ($authenticated) {
            $user = auth()->user();

            $token = $user->createToken('login', $user->roles, now()->addDays(360))->plainTextToken;
            $user->token = $token;

            return $user;

        } else {
            return ['message' => 'Invalid data'];
        }
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $data['roles'] = 'user';

        $user = User::create($data);

        $token = $user->createToken('register', $user->roles, now()->addMinutes(20))->plainTextToken;

        $user->token = $token;

        return $user;
    }

    public function change_password(ChangePasswordRequest $request)
    {
        $data = $request->validated();

        $user = auth()->user();

        $currentPasswrd = $user->password;

        $oldPassword = $data['old_password'];

        $match = Hash::check($oldPassword, $currentPasswrd);

        if (!$match)
            return response()->json([
                'message' => 'invalid password',
                'data' => [],
                'success' => false,
            ], 422);


        $newPassword = $data['new_password'];

        $newPasswordHashed = Hash::make($newPassword);

        $user->password = $newPasswordHashed;

        $updated = $user->save();

        if ($updated)
            return response()->json([
                'message' => 'Password Changed Successfully',
                'data' => [],
                'success' => true,
            ], 202);

        return response()->json([
            'message' => 'Password Not Changed',
            'data' => [],
            'success' => false,
        ], 400);

    }

    public function forget_password()
    {
        //
    }

    public function reset_password()
    {
        //
    }

    /**
     * Summary of active_sessions
     */
    public function active_sessions()
    {
        return auth()->user()->tokens()->get();
    }


    /* Summary of logout_current
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout_current()
    {
        $deleted = auth()->user()->currentAccessToken()->delete();


        if ($deleted)
            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully',
                'data' => []
            ]);

        return response()->json([
            'success' => false,
            'message' => 'Cannot Log out at the moment',
            'data' => []
        ]);
    }

    /**
     * Summary of logout_all
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout_all(): \Illuminate\Http\JsonResponse
    {
        $deleted = auth()->user()->tokens()->delete();

        if ($deleted)
            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully',
                'data' => []
            ]);

        return response()->json([
            'success' => false,
            'message' => 'Cannot Log out at the moment',
            'data' => []
        ]);
    }

    /**
     * Summary of logout_others
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout_others()
    {
        $current = auth()->user()->currentAccessToken();

        $all = auth()->user()->tokens()->get();

        // return $all;

        $deleted = 0;

        foreach ($all as $token) {
            if ($token->id !== $current->id) {
                $token->delete();
                $deleted++;
            }
        }

        if ($deleted > 0)
            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully from other sessionss',
                'data' => []
            ]);

        return response()->json([
            'success' => false,
            'message' => 'Cannot Log out at the moment',
            'data' => []
        ]);
    }
}
