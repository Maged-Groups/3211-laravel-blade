<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Post;
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

        if ($authenticated)

            // Get user Posts count
            $posts_count = Post::where('user_id', auth()->id())->count();

            session(['user_posts_count' => $posts_count]);

        return redirect()->route('home');


        return back()->withErrors([
            'message' => 'Invalid Credentials'
        ])->withInput();

    }

    
    public function register_form()
    {
        return view('auth.register-form');
    }


    public function register(RegisterRequest $request)
    {
        $photo = $request->file('profile_photo');
        if ($photo) {
            $photoPath = $photo->store('profiles');
            $request->merge(['profile_photo' => $photoPath]); // $request['profile_photo'] = $photoPath;
        }

        $data = $request->validated();

        $data['roles'] = ['user'];

        $user = User::create($data);

        if($user)
            return redirect()->route('login')->with('success', 'Account created successfully, you can now login');

        return back()->withErrors([
            'message' => 'Cannot create account at the moment'
        ])->withInput();

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
        Auth::logout();

        return redirect()->route('login');

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
