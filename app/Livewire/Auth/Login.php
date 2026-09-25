<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Sign In • Anemony Cloud')]
class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public string $errorMessage = '';

    public bool $showPassword = false;

    protected function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:4'],
        ];
    }

    public function mount()
    {
        // If already authenticated, redirect to appropriate panel
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->isSuperAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->tenant) {
                return redirect()->route('store.dashboard', $user->tenant->slug);
            }

            return redirect()->route('home');
        }
    }

    public function fillCredentials(string $role): void
    {
        $this->errorMessage = '';
        if ($role === 'super_admin') {
            $this->email = 'admin@anemony.in';
            $this->password = 'admin123';
        } elseif ($role === 'merchant') {
            $this->email = 'sharma@anemony.in';
            $this->password = 'password';
        } elseif ($role === 'biztraffics') {
            $this->email = '8999355932';
            $this->password = 'password123';
        }
    }

    public function togglePassword(): void
    {
        $this->showPassword = ! $this->showPassword;
    }

    public function login()
    {
        $this->errorMessage = '';
        $this->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string', 'min:4'],
        ]);

        $input = trim($this->email);

        // 1. Try direct attempt by email
        $authenticated = Auth::attempt(['email' => $input, 'password' => $this->password, 'is_active' => true], $this->remember);

        // 2. If failed, try by phone
        if (! $authenticated) {
            $authenticated = Auth::attempt(['phone' => $input, 'password' => $this->password, 'is_active' => true], $this->remember);
        }

        // 3. If failed, match normalized phone number (handles +91, spaces, dashes)
        if (! $authenticated) {
            $cleanDigits = preg_replace('/[^0-9]/', '', $input);
            $last10 = strlen($cleanDigits) >= 10 ? substr($cleanDigits, -10) : $cleanDigits;
            if ($last10) {
                $userByPhone = User::all()->first(function ($u) use ($last10) {
                    $uDigits = preg_replace('/[^0-9]/', '', $u->phone ?? '');

                    return str_ends_with($uDigits, $last10);
                });

                if ($userByPhone && Hash::check($this->password, $userByPhone->password) && $userByPhone->is_active) {
                    Auth::login($userByPhone, $this->remember);
                    $authenticated = true;
                }
            }
        }

        if (! $authenticated) {
            $this->errorMessage = 'Invalid email/phone or password. Please check your credentials.';

            return;
        }

        session()->regenerate();

        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        if ($user->isMerchant() && $user->tenant) {
            return redirect()->intended(route('store.dashboard', $user->tenant->slug));
        }

        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('components.layouts.app');
    }
}
