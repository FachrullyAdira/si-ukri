<?php

namespace App\Filament\Pages;

use App\Models\PengaturanSitus;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class PengaturanLogin extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Pengaturan & Sistem';
    protected static ?string $title = 'Pengaturan Background Login';
    protected static ?string $navigationLabel = 'Latar Belakang Login';
    protected static ?int $navigationSort = 5;
    protected static ?string $slug = 'pengaturan-login';

    protected static string $view = 'filament.pages.pengaturan-login';

    public ?array $data = [];

    public function mount(): void
    {
        $rawBackgrounds = PengaturanSitus::getValue('login_backgrounds', '[]');
        $backgrounds = json_decode($rawBackgrounds, true) ?: [];
        $overlay = PengaturanSitus::getValue('login_overlay', 'left_to_right');
        $blur = PengaturanSitus::getValue('login_blur', '0');
        $carouselSpeed = PengaturanSitus::getValue('login_carousel_speed', '6000');

        $this->form->fill([
            'backgrounds' => $backgrounds,
            'overlay' => $overlay,
            'blur' => $blur,
            'carousel_speed' => $carouselSpeed,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Galeri Latar Belakang Login')
                    ->description('Unggah beberapa foto kampus, gedung, atau kegiatan mahasiswa. Sistem akan mengacak foto secara dinamis setiap kali pengguna membuka halaman login.')
                    ->schema([
                        Forms\Components\FileUpload::make('backgrounds')
                            ->label('Daftar Foto Latar Belakang')
                            ->multiple()
                            ->image()
                            ->reorderable()
                            ->disk('public')
                            ->directory('login-backgrounds')
                            ->helperText('Format: JPG, PNG, WebP. Jika dikosongkan, sistem akan otomatis menggunakan foto default kampus.'),
                    ]),

                Forms\Components\Section::make('Pengaturan Gradasi Warna & Efek Visual')
                    ->description('Pilih arah gradasi warna dan efek blur pada gambar latar belakang agar foto terlihat soft, estetik, dan tetap terlihat jelas.')
                    ->schema([
                        Forms\Components\Select::make('overlay')
                            ->label('Arah & Warna Gradasi')
                            ->options([
                                'left_to_right' => 'Gradasi Kiri ke Kanan Soft (Navy Transparan → Emerald Lembut) [Rekomendasi]',
                                'diagonal' => 'Gradasi Diagonal 135° Soft (Emerald Lembut → Slate Transparan)',
                                'top_to_bottom' => 'Gradasi Atas ke Bawah Soft',
                                'soft_emerald' => 'Gradasi Emerald Soft Elegan',
                                'dark_clean' => 'Gelap Soft Minimalis',
                            ])
                            ->default('left_to_right')
                            ->required(),

                        Forms\Components\Select::make('blur')
                            ->label('Intensitas Efek Blur Gambar')
                            ->options([
                                '0' => '0px - Foto Tajam & Jelas (Rekomendasi agar foto kelihatan)',
                                '1' => '1px - Soft Sangat Halus',
                                '2' => '2px - Soft Lembut',
                                '4' => '4px - Blur Sedang',
                                '8' => '8px - Blur Sinematik',
                            ])
                            ->default('0')
                            ->required(),

                        Forms\Components\Select::make('carousel_speed')
                            ->label('Kecepatan Putar Carousel (Slideshow)')
                            ->options([
                                '4000' => '4 Detik (Cepat)',
                                '6000' => '6 Detik (Ideal - Direkomendasikan)',
                                '8000' => '8 Detik (Santai)',
                                '10000' => '10 Detik (Lambat)',
                            ])
                            ->default('6000')
                            ->required(),
                    ])->columns(3),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        PengaturanSitus::updateOrCreate(
            ['key' => 'login_backgrounds'],
            [
                'group' => 'general',
                'value' => json_encode($state['backgrounds'] ?? []),
            ]
        );

        PengaturanSitus::updateOrCreate(
            ['key' => 'login_overlay'],
            [
                'group' => 'general',
                'value' => $state['overlay'] ?? 'left_to_right',
            ]
        );

        PengaturanSitus::updateOrCreate(
            ['key' => 'login_blur'],
            [
                'group' => 'general',
                'value' => $state['blur'] ?? '2',
            ]
        );

        PengaturanSitus::updateOrCreate(
            ['key' => 'login_carousel_speed'],
            [
                'group' => 'general',
                'value' => $state['carousel_speed'] ?? '6000',
            ]
        );

        Notification::make()
            ->title('Pengaturan Berhasil Disimpan')
            ->body('Foto latar belakang login, carousel slideshow, dan gradasi telah aktif.')
            ->success()
            ->send();
    }
}
