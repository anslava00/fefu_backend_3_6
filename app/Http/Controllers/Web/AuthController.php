<?php

namespace App\Http\Controllers\Web;

use function view;
use function session;
use function redirect;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BaseLoginFormRequest;
use Auth;
use App\Http\Requests\BaseRegisterFormRequest;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function login(BaseLoginFormRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data, true)){
            $request->session()->regenerate();

            return redirect(route('profile'));
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(BaseRegisterFormRequest $request)
    {
        $data = $request->validated();

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        
        $user->save();

        Auth::login($user);
        $request->session()->regenerate();

        return redirect(route('profile'));
    }
}
