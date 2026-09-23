<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Component;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CustomLogin extends BaseLogin
{
    use WithRateLimiting;

    protected static string $view = 'filament.pages.auth.custom-login';

    protected static string $layout = 'filament-panels::components.layout.base';

    public ?array $data = [
        'email' => '',
        'password' => '',
        'remember' => false,
    ];

    public function mount(): void
    {
        if (filament()->auth()->check() || auth()->check()) {
            $user = filament()->auth()->user() ?? auth()->user();
            if ($user) {
                $targetUrl = $this->getTargetUrlForUser($user);
                $this->redirect($targetUrl, navigate: false);
                return;
            }
        }

        $this->form->fill();
    }

    public function setDemoUser(string $role): void
    {
        $credentials = match ($role) {
            'superadmin' => ['email' => 'superadmin@ukri.ac.id', 'password' => 'password'],
            'dosen' => ['email' => 'dosen@ukri.ac.id', 'password' => 'password'],
            'mahasiswa' => ['email' => 'mahasiswa@ukri.ac.id', 'password' => 'password'],
            default => ['email' => '', 'password' => ''],
        };

        $this->data['email'] = $credentials['email'];
        $this->data['password'] = $credentials['password'];
        $this->form->fill($this->data);
    }

    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();
            return null;
        }

        $this->validate([
            'data.email' => 'required',
            'data.password' => 'required',
        ], [
            'data.email.required' => 'NPM, NIDN atau Email wajib diisi.',
            'data.password.required' => 'Kata sandi wajib diisi.',
        ]);

        $loginInput = trim($this->data['email'] ?? '');
        $password = $this->data['password'] ?? '';
        $remember = (bool) ($this->data['remember'] ?? false);

        // Cari user berdasarkan email langsung atau format domain UKRI
        $user = User::where('email', $loginInput)->first();
        if (! $user && ! str_contains($loginInput, '@')) {
            $user = User::where('email', $loginInput . '@ukri.ac.id')->first();
        }

        if (! $user || ! Hash::check($password, $user->password)) {
            $this->addError('data.email', __('filament-panels::pages/auth/login.messages.failed'));
            return null;
        }

        filament()->auth()->login($user, $remember);
        auth()->login($user, $remember);
        session()->regenerate();
        session()->forget('url.intended');

        $targetUrl = $this->getTargetUrlForUser($user);

        // Langsung redirect ke target panel dengan navigate: false
        $this->redirect($targetUrl, navigate: false);

        return new class($targetUrl) implements LoginResponse {
            public function __construct(protected string $url) {}

            public function toResponse($request): \Illuminate\Http\RedirectResponse | \Livewire\Features\SupportRedirects\Redirector
            {
                return redirect()->to($this->url);
            }
        };
    }

    public function getTargetUrlForUser(User $user): string
    {
        if ($user->hasRole(['Super Admin', 'Admin Akademik', 'Editor Konten', 'Admin Kemahasiswaan'])) {
            return url('/superadmin');
        }

        if ($user->hasRole('Dosen')) {
            return url('/dosen');
        }

        if ($user->hasRole('Mahasiswa')) {
            return url('/mahasiswa');
        }

        return url('/superadmin');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('NPM / NIDN / Email')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->placeholder('10000001 atau admin@ukri.ac.id')
            ->prefixIcon('heroicon-m-envelope');
    }

    public function getTitle(): string|Htmlable
    {
        return 'Masuk ke Sistem - SI UKRI';
    }

    public function getHeading(): string|Htmlable
    {
        return 'Selamat Datang';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Masuk menggunakan kredensial NIP, NPM atau Email resmi UKRI Anda.';
    }
}
