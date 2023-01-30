<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private $userRepository;
    private $emailService;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
        $this->emailService = new EmailService;
    }

    public function signin(AuthRequest $request)
    {
        $formData = $request->all();
        $user = $this->userRepository->findByEmail($formData['email']);

        if (!$user) {
            $validator = Validator::make([], []);
            $validator->errors()->add('password', 'Email atau password salah!');
            return response()->json([
                "errors" => $validator->errors()
            ], 422);
        }

        $validator = Validator::make($formData, [
            'password'    => [
                function ($attribute, $value, $fail) use ($formData, $user) {
                    if (!Hash::check($formData['password'], $user->password)) {
                        $fail('Email atau password salah!');
                    }
                }
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()
            ], 422);
        }

        if ($user) {
            Auth::login($user);
        }

        Session::put('name', $user->name);
        Session::put('email', $user->email);

        return response()->json([
            'status' => 'success'
        ]);


        // return redirect()->route('document.index');
    }

    public function signout()
    {
        # code...
    }

    public function register(UserRequest $request)
    {
        // Hamada Ananta Burhanuddin
        // hamada.undetected@gmail.com
        // hamada123
        // 087763394623
        $formData   = $request->all();
        $formData['password'] = Hash::make($request->password);
        $formData['token']    = Str::random(32) . date('ymdhis');
        $user       = $this->userRepository->create($formData);

        $this->emailService->userVerification($user, $formData['token']);

        return response()->json([
            'status' => 'success',
            'message' => 'Please verify your email to sign in',
        ]);
    }

    public function verifyToken(string $token)
    {
        $user = $this->userRepository->findByToken($token);

        if ($user) {
            $this->userRepository->verifyUserEmail($user->id);
            return view('auth.verification-success.index');
        } else {
            abort(404);
        }
    }
}
