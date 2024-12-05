<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['nullable', 'string', 'max:15', 'regex:/^[a-zA-Z]+$/'], // Name is optional, only letters, max 15 characters
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults()->mixedCase()->letters()->numbers(), // Default + mixed case, letters, and numbers
            ],
        ], $this->validationMessages());

        // Generate a random unique username
        $username = $this->generateUniqueUsername();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $username, // Assign generated username
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard'));
    }

    /**
     * Custom validation error messages.
     */
    private function validationMessages(): array
    {
        return [
            'name.max' => 'The name may not be longer than 15 characters.',
            'name.regex' => 'The name may only contain letters.',
            'email.required' => 'Please provide an email address.',
            'email.email' => 'Please provide a valid email address.',
            'email.lowercase' => 'The email address must be in lowercase.',
            'email.unique' => 'This email is already registered. Please use another one.',
            'password.required' => 'Please provide a password.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.mixedCase' => 'The password must contain both uppercase and lowercase letters.',
            'password.letters' => 'The password must include at least one letter.',
            'password.numbers' => 'The password must include at least one number.',
            'password.min' => 'The password must be at least :min characters.',
        ];
    }

    private function generateUniqueUsername(): string
    {
        do {
            $username = 'user_' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
        } while (User::where('username', $username)->exists());

        return $username;
    }

}
