<?php

namespace App\Http\Controllers\API;

use App\Actions\Fortify\PasswordValidationRules;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Mail;
use App\Mail\User\OtpRequest;
// use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;


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
            
            //jika password request tdk sama dengan yg ada di db
            // if ($user->otp != null) {
                // echo "null";
                // throw new \Exception('Invalid Email Verificaation');
            // }

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

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user = User::where('email', $request->email)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            
            //kirim otp ke email
            Mail::to($user->email)->send(new OtpRequest($user));

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

        return ResponseFormatter::success($token,'Token Kadaluarsa');
    }

    public function fetch(Request $request)
    {
        return ResponseFormatter::success($request->user(),'Data profile user berhasil diambil');
    }
    
    public function history(Request $request)
    {
        
        //$limit = $request->input('limit', 100);
        
        $complaint = Complaint::with(['user','caption'])->select([
            'id',
            'description',
            'picture_path',
            'latitude',
            'longitude',
            'district',
            'is_public',
            'is_anon',
            'caption_id',
            'user_id',
            'status',
            'created_at'
        ])->where('user_id', $request->user()->id)->orderBy('created_at','desc');


        return ResponseFormatter::success(
            $complaint->get(),
            'Data list aduan berhasil diambil'
        );
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
            $details = [
            'title' => 'Kode Verifikasi Register',
            'body' => 'Berikut Adalah Kode Verifikasi Anda',
            'otp' => $user->otp
            ];
            
            \Mail::to($user->email)->send(new \App\Mail\MyTestMail($details));
            
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
    
    public function otprequestulang(Request $request)
    {
        try {
            //validasi biasa
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);

            //cek email tsb apakah ada 
            $user = User::where('email', $request->email)->first();
            
            if($user){
                //generate otp baru
                $otpbaru = rand(234567,999999);
                
                //ganti otp baru
                User::where('email','=',$request->email)->update(['otp' => $otpbaru]);
                
                //ambil user baru
                $user2 = User::where('email', $request->email)->first();
                
                //kirim email berisi otp
                $details = [
                'title' => 'Kode Verifikasi Register',
                'body' => 'Berikut Adalah Kode Verifikasi Anda',
                'otp' => $user2->otp
                ];
            
            \Mail::to($user->email)->send(new \App\Mail\MyTestMail($details));
            
            //kembalikan response
            return ResponseFormatter::success([
                    // 'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                    'user' => $user
                ],'Email Berisi Kode OTP Sudah Dikirimkan ke email anda');    
            
            }
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
