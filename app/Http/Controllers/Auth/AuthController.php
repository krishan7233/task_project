<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\AuthService;

use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }


    public function showLoginForm(){
        return view('login');
    }

       public function login(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email'],
                'password' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if (!$this->authService->login($request->email, $request->password)) {
                return redirect()->back()
                    ->with('error', 'Invalid credentials')
                    ->withInput();
            }
            $user = auth()->user();

            if ($user->usertype == 1) {
                return redirect()->intended('/dashboard')->with('success', 'Logged in as Admin!');
            } else {
                return redirect()->intended('/')->with('success', 'Logged in successfully!');
            }


            return redirect()->intended('/dashboard')->with('success', 'Logged in successfully!');
        }

    public function logout()
    {
        auth()->logout();
        return redirect('/login')->with('success', 'Logged out successfully!');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'mobile'   => 'required|digits:10|unique:users,mobile',
            'password' => 'required|string|min:6',
        ]);
    
        $this->authService->register($validated);
    
        return redirect()->route('login')->with('success', 'Registered successfully! Please log in.');
    }



}
