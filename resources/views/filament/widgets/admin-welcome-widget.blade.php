<x-filament-widgets::widget>
    <x-filament::section style="background: linear-gradient(135deg, #054f2a 0%, #064e27 50%, #0c2b1c 100%); color: white; border-radius: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.15); box-shadow: 0 10px 25px -5px rgba(10, 107, 57, 0.3); padding: 1.5rem;">
        <div style="display: flex; flex-direction: column; justify-content: space-between; align-items: flex-start; gap: 1rem;">
            <div style="max-width: 48rem;">
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; background-color: rgba(245, 158, 11, 0.2); color: #fcd34d; border: 1px solid rgba(245, 158, 11, 0.4); padding: 0.25rem 0.85rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.75rem;">
                    <span style="width: 0.5rem; height: 0.5rem; border-radius: 9999px; background-color: #fcd34d;"></span>
                    <span>PORTAL SI-UKRI &bull; PERAN: {{ auth()->user()->roles->pluck('name')->implode(', ') ?: 'Administrator' }}</span>
                </div>

                <h2 style="font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 1.75rem; line-height: 1.2; color: #ffffff; margin: 0 0 0.5rem 0;">
                    Selamat Datang Kembali, <span style="color: #fcd34d;">{{ auth()->user()->name }}</span>!
                </h2>

                <p style="font-family: 'Inter', sans-serif; font-size: 0.875rem; line-height: 1.6; color: #e8f5e9; margin: 0;">
                    Kelola seluruh informasi akademik, berita prodi, jajaran dosen & staf, kelompok keahlian, dan konten publikasi website Sistem Informasi Universitas Kebangsaan RI secara terpusat.
                </p>
            </div>

            <div style="display: flex; flex-wrap: wrap; items-center; gap: 0.75rem; margin-top: 0.5rem;">
                <a href="/" target="_blank" style="display: inline-flex; align-items: center; gap: 0.5rem; background-color: rgba(255, 255, 255, 0.15); color: #ffffff; font-weight: 600; font-size: 0.75rem; padding: 0.6rem 1.2rem; border-radius: 0.75rem; border: 1px solid rgba(255, 255, 255, 0.25); text-decoration: none; transition: all 0.2s;">
                    <span>Lihat Website Publik &rarr;</span>
                </a>
                <a href="https://pmb.ukri.ac.id/" target="_blank" style="display: inline-flex; align-items: center; gap: 0.5rem; background: linear-gradient(135deg, #ef3829 0%, #d32f2f 100%); color: #ffffff; font-weight: 700; font-size: 0.75rem; padding: 0.6rem 1.25rem; border-radius: 0.75rem; text-decoration: none; box-shadow: 0 4px 12px rgba(239, 56, 41, 0.3); transition: all 0.2s;">
                    <span>Portal PMB Online &rarr;</span>
                </a>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
