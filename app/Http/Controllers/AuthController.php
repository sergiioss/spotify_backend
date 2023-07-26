<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    const ROLE_USER = 1;

    public function register(Request $request)
    {
        try {
            Log::info('Getting register');

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'photo' => 'string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->password),
                'photo' => 'https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png'
            ]);

            $user->roles()->attach(self::ROLE_USER);

            return response()->json(compact('user'), 201);

        } catch (\Exception $exception) {
            Log::error('Error getting user' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error creating user'
            ], 500);
        }
    }
    
    public function login(Request $request)
    {
        try {
            /* El only te accede solo a los campos que tu le dices. */

            $input = $request->only('email', 'password');
            $jwt_token = null;

            if (!$jwt_token = JWTAuth::attempt($input)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Email or Password',
                ], Response::HTTP_UNAUTHORIZED);
            }
            $userEmail = auth()->user();

            return response()->json([
                'success' => true,
                'token' => $jwt_token,
                'user' => $userEmail,
            ]);
        } catch (\Exception $exception) {
            Log::error('Error login' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error login'
            ], 500);
        }
    }

    public function me()
    {
        try {
            return response()->json(auth()->user());
        } catch (\Exception $exception) {
            Log::error('Customer information error' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Customer information error'
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        try {
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updatedUser(Request $request)
    {
        try {

            Log::info("Updated User");

            $validator = Validator::make($request->all(), [
                'name' => 'string|max:255',
                'email' => 'string|email|max:255|unique:users',
                /* 'password' => 'string|min:6', */
                'photo' => 'string',

            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ], 400);
            };

            $userEmail = auth()->user()->email;

            /* $userPassword = auth()->user()->password; */
            
            $user = User::query()
            ->where('email', $userEmail)
            ->get();

            if (!$user) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Error'
                        ]
                    );
                }
                
                $name = $request->input('name');
                /* $password = bcrypt($request->$userPassword); */
                $email = $request->input('email');
                $photo = $request->input('photo');
                
                if (isset($name)) {
                    $user = User::query()
                    ->where('email', $userEmail)
                    ->update(['users.name' => $name]);
                }
                
                /* if (isset($password)) {
                    $user = User::query()
                    ->where('email', $userEmail)
                    ->update(['users.password' => $password]);
                    print_r('hola');
                } */
                
                if (isset($photo)) {
                $user = User::query()
                ->where('email', $userEmail)
                ->update(['users.photo' => $photo]);
            }
            
            if (isset($email)) {
                $user = User::query()
                ->where('email', $userEmail)
                ->update(['users.email' => $email]);
            }

            $userData = auth()->user();

            return response()->json([
                'success' => true,
                'message' => "User updated"
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Error updated user' . $exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error updated user'
                ],
                500
            );
        }
    }
}
