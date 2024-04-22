<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Show register form.
     * 
     * @return Illuminate\Contracts\View\View
     *  The register form.
     */
    public function create(): View
    {
        return view('user.register');
    }

    /**
     * Store newly registered user.
     * 
     * @param Illuminate\Http\Request
     *  The request object.
     */
    public function store(Request $request): RedirectResponse
    {
        $form_fields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'avatar' => [
                File::image()
                    ->min('1kb')
                    ->max('2mb')
            ],
            'password' => 'required|confirmed|min:8',
        ]);

        if ($request->hasFile('avatar')) {
            $form_fields['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $form_fields['password'] = bcrypt($form_fields['password']);
        $user = User::create($form_fields);
        auth()->login($user);

        return redirect('/')->with('message', 'Account created. You are now logged in.');
    }

    /**
     * Show login form.
     * 
     * @return Illuminate\Contracts\View\View
     *  The login form.
     */
    public function login(): View
    {
        return view('user.login');
    }

    /**
     * Authenticate user.
     * 
     * @param Illuminate\Http\Request
     *  The Request object.
     * 
     * @return Illuminate\Http\RedirectResponse
     *  Redirect.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $form_fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (auth()->attempt($form_fields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in.');
        } else {
            return back()
                ->with('message', 'Invalid e-mail or password.')
                ->onlyInput('email');
        }
    }

    /**
     * Logout user.
     * 
     * @param Illuminate\Http\Request
     *  The Request object.
     * 
     * @return Illuminate\Http\RedirectResponse
     *  Redirect.
     */
    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You are now logged out.');
    }
}
