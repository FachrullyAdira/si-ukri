<?php

namespace App\Filament\Pages;

use App\Models\PengaturanSitus;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class PengaturanHima extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationGroup = 'Kemahasiswaan & Alumni';
    protected static ?string $title = 'Profil & Logo HIMASI';
    protected static ?string $navigationLabel = 'Profil & Logo HIMASI';
    protected static ?int $navigationSort = 1;
    protected static ?string $slug = 'pengaturan-hima';

    protected static string $view = 'filament.pages.pengaturan-hima';

    public ?array $data = [];

    public function mount(): void
    {
        $namaHimpunan = PengaturanSitus::getValue('hima_nama', 'Himpunan Mahasiswa Sistem Informasi (HMSI-UKRI)');
        $singkatan = PengaturanSitus::getValue('hima_singkatan', 'HMSI-UKRI');
        $subtitle = PengaturanSitus::getValue('hima_subtitle', 'Wadah organisasi eksekutif mahasiswa Sistem Informasi UKRI untuk pengembangan leadership dan softskill.');
        $logo = PengaturanSitus::getValue('hima_logo', null);
        $namaKabinet = PengaturanSitus::getValue('hima_nama_kabinet', 'Kabinet "Inovasi Kebangsaan"');
        $periode = PengaturanSitus::getValue('hima_periode', '2026/2027');
        $deskripsi = PengaturanSitus::getValue(
            'hima_deskripsi',
            'HIMASI UKRI berfokus pada 4 bidang utama: Riset & Teknologi, Pengabdian Masyarakat, Seni & Olahraga, serta Hubungan Luar Himpunan.'
        );
        $instagram = PengaturanSitus::getValue('hima_instagram', '@himasi_ukri');
        $email = PengaturanSitus::getValue('hima_email', 'himasi@ukri.ac.id');
        $linkedin = PengaturanSitus::getValue('hima_linkedin', '');

        $this->form->fill([
            'nama_himpunan' => $namaHimpunan,
            'singkatan' => $singkatan,
            'subtitle' => $subtitle,
            'logo' => $logo,
            'nama_kabinet' => $namaKabinet,
            'periode' => $periode,
            'deskripsi' => $deskripsi,
            'instagram' => $instagram,
            'email_hima' => $email,
            'linkedin' => $linkedin,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas & Nama Resmi Himpunan')
                    ->description('Kelola nama lengkap himpunan, akronim/singkatan, slogan/deskripsi halaman, dan logo resmi organisasi.')
                    ->schema([
                        Forms\Components\TextInput::make('nama_himpunan')
                            ->label('Nama Lengkap Himpunan')
                            ->placeholder('Contoh: Himpunan Mahasiswa Sistem Informasi (HMSI-UKRI)')
                            ->required()
                            ->columnSpan(['md' => 2]),

                        Forms\Components\TextInput::make('singkatan')
                            ->label('Singkatan / Akronim')
                            ->placeholder('Contoh: HMSI-UKRI atau HIMASI')
                            ->required()
                            ->columnSpan(['md' => 1]),

                        Forms\Components\TextInput::make('subtitle')
                            ->label('Slogan / Subtitle Halaman')
                            ->placeholder('Wadah organisasi eksekutif mahasiswa...')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo Resmi Himpunan')
                            ->image()
                            ->imageResizeTargetWidth('600')
                            ->imageResizeTargetHeight('600')
                            ->disk('public')
                            ->directory('hima-logo')
                            ->maxSize(20480)
                            ->helperText('Format: PNG, SVG, JPG, WebP (Maks 20MB). Rekomendasi rasio 1:1. Jika dikosongkan, logo default HIMASI UKRI akan digunakan.')
                            ->columnSpanFull(),
                    ])->columns(3),

                Forms\Components\Section::make('Kepengurusan & Kabinet Aktif')
                    ->description('Kelola nama kabinet yang sedang menjabat, periode aktif, dan ringkasan visi misi kabinet.')
                    ->schema([
                        Forms\Components\TextInput::make('nama_kabinet')
                            ->label('Nama Kabinet Himpunan')
                            ->placeholder('Contoh: Kabinet "Inovasi Kebangsaan"')
                            ->required(),

                        Forms\Components\TextInput::make('periode')
                            ->label('Periode Kepengurusan')
                            ->placeholder('Contoh: 2026/2027')
                            ->required(),

                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi & Fokus Utama Kabinet')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Media Sosial & Kontak Resmi Himpunan (Opsional)')
                    ->description('Tautan media sosial dan kontak resmi yang akan ditampilkan pada halaman kemahasiswaan.')
                    ->schema([
                        Forms\Components\TextInput::make('instagram')
                            ->label('Instagram')
                            ->placeholder('@himasi_ukri atau URL profil'),

                        Forms\Components\TextInput::make('email_hima')
                            ->label('Email Resmi')
                            ->email()
                            ->placeholder('himasi@ukri.ac.id'),

                        Forms\Components\TextInput::make('linkedin')
                            ->label('LinkedIn')
                            ->placeholder('URL halaman LinkedIn'),
                    ])->columns(3),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        PengaturanSitus::updateOrCreate(
            ['key' => 'hima_nama'],
            [
                'group' => 'general',
                'value' => $state['nama_himpunan'] ?? 'Himpunan Mahasiswa Sistem Informasi (HMSI-UKRI)',
            ]
        );

        PengaturanSitus::updateOrCreate(
            ['key' => 'hima_singkatan'],
            [
                'group' => 'general',
                'value' => $state['singkatan'] ?? 'HMSI-UKRI',
            ]
        );

        PengaturanSitus::updateOrCreate(
            ['key' => 'hima_subtitle'],
            [
                'group' => 'general',
                'value' => $state['subtitle'] ?? 'Wadah organisasi eksekutif mahasiswa Sistem Informasi UKRI untuk pengembangan leadership dan softskill.',
            ]
        );

        PengaturanSitus::updateOrCreate(
            ['key' => 'hima_logo'],
            [
                'group' => 'general',
                'value' => $state['logo'] ?? null,
            ]
        );

        PengaturanSitus::updateOrCreate(
            ['key' => 'hima_nama_kabinet'],
            [
                'group' => 'general',
                'value' => $state['nama_kabinet'] ?? 'Kabinet "Inovasi Kebangsaan"',
            ]
        );

        PengaturanSitus::updateOrCreate(
            ['key' => 'hima_periode'],
            [
                'group' => 'general',
                'value' => $state['periode'] ?? '2026/2027',
            ]
        );

        PengaturanSitus::updateOrCreate(
            ['key' => 'hima_deskripsi'],
            [
                'group' => 'general',
                'value' => $state['deskripsi'] ?? '',
            ]
        );

        PengaturanSitus::updateOrCreate(
            ['key' => 'hima_instagram'],
            [
                'group' => 'general',
                'value' => $state['instagram'] ?? '',
            ]
        );

        PengaturanSitus::updateOrCreate(
            ['key' => 'hima_email'],
            [
                'group' => 'general',
                'value' => $state['email_hima'] ?? '',
            ]
        );

        PengaturanSitus::updateOrCreate(
            ['key' => 'hima_linkedin'],
            [
                'group' => 'general',
                'value' => $state['linkedin'] ?? '',
            ]
        );

        Notification::make()
            ->title('Profil & Logo HIMASI Berhasil Disimpan')
            ->body('Informasi kabinet dan logo resmi HIMASI telah diperbarui.')
            ->success()
            ->send();
    }
}
