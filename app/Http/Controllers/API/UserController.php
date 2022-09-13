<?php

namespace App\Http\Controllers\API;

use App\Actions\Fortify\PasswordValidationRules;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use PasswordValidationRules;

    public function login(Request $request)
    {
        try {
            // validasi input
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);
            // dd($request)

            //cek credential login
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ],'Authentication Failed', 500);
            }

            $user = User::where('email', $request->email)->first();
            //jika password request tdk sama dengan yg ada di db
            if ( ! Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            //createToken bawaan laravel
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ],'Authenticated');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ],'Authentication Failed', 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules()
            ]);

            //bikin di database
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);


            $user = User::where('email', $request->email)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ],'User Registered');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ],'Authentication Failed', 500);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($token,'Token Revoked');
    }

    public function fetch(Request $request)
    {
        return ResponseFormatter::success($request->user(),'Data profile user berhasil diambil');
    }

    public function register2(Request $request)
    {
        try {
            //validasi biasa
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules()
            ]);

            //bikin di database
            
            $otp = rand(234567,999999);
            User::create([
                'name' => $request->name,
                'email' => $request->email, 
                'otp' => $otp,
                'password' => Hash::make($request->password),
            ]);

            //cek apakah ada 
            $user = User::where('email', $request->email)->first();

            //kirim email berisi otp
            


            //kembalikan response
            return ResponseFormatter::success([
                    // 'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                    'user' => $user
                ],'Email Berisi Kode OTP Sudah Dikirimkan ke email anda');

            
            // $user = User::where('email', $request->email)->first();

            // $tokenResult = $user->createToken('authToken')->plainTextToken;

            // return ResponseFormatter::success([
            //     'access_token' => $tokenResult,
            //     'token_type' => 'Bearer',
            //     'user' => $user
            // ],'User Registered');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ],'Authentication Failed', 500);
        }
    }

    public function submitotp(Request $request)
    {
        try {
            $request->validate([
                'otp' => ['required'],
            ]);

            //select di db email tsb
            $user  = User::where([['email','=',$request->email],['otp','=',$request->otp]])->first();
           
            //jika ketemu
            if($user){
                $tokenResult = $user->createToken('authToken')->plainTextToken;
                
                User::where('email','=',$request->email)->update(['otp' => null]);
                
                return ResponseFormatter::success([
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                    'user' => $user
                ],'User Registered');
            }else {
                return ResponseFormatter::error([
                    'message' => 'Something went wrong',
                ],'Authentication Failed', 500);
            }

            // $user = User::where('email', $request->email)->first            
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ],'Authentication Failed', 500);
        }
    }
    
}
