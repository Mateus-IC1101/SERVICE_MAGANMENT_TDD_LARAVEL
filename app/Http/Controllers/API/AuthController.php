<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {

        $user = $this->user::where('email', $request->email)->first();

        $count_tokens = count($user->tokens()->get());
        $count_tokens > 0 ? $user->tokens()->delete() : false;

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['e-mail ou senha incorreto(s).'],
            ]);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $user = $this->user->create($data);
        $token = $user->createToken('auth')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response('Logout success');
    }

    public function all()
    {
        $users_all = $this->user->get();
        return response($users_all);
    }
}
