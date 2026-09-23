@props([
    'notifications',
    'unreadNotificationsCount',
])

@php
    $totalCount = $notifications->count();
    $unreadNotifications = $notifications->filter(fn ($n) => $n->unread());
    $isPaginated = $notifications instanceof \Illuminate\Contracts\Pagination\Paginator && $notifications->hasPages();
@endphp

<div
    x-data="{
        isOpen: false,
        activeTab: 'unread',
        open() {
            this.isOpen = true;
        },
        close() {
            this.isOpen = false;
        },
        toggle() {
            this.isOpen = !this.isOpen;
        }
    }"
    x-on:open-modal.window="if ($event.detail.id === 'database-notifications') toggle()"
    x-on:close-modal.window="if ($event.detail.id === 'database-notifications') close()"
    x-on:keydown.window.escape="close()"
    x-cloak
    class="relative inline-block"
>
    {{-- Teleport ke Body Dokumen untuk Presisi Posisi --}}
    <template x-teleport="body">
        <div x-show="isOpen" style="position: fixed; inset: 0; z-index: 99999; pointer-events: none;">
            {{-- Backdrop Halus / Klik Di Luar Untuk Menutup --}}
            <div
                x-show="isOpen"
                x-transition:enter="ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-on:click="close()"
                style="position: fixed; inset: 0; background: rgba(15, 23, 42, 0.15); backdrop-filter: blur(2px); -webkit-backdrop-filter: blur(2px); pointer-events: auto;"
            ></div>

            {{-- Kartu Notifikasi Modern & Mewah (Dropdown Popover) --}}
            <div
                x-show="isOpen"
                x-transition:enter="transition ease-out duration-250 transform"
                x-transition:enter-start="opacity-0 translate-y-3 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-150 transform"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                style="position: fixed; top: 4.5rem; right: 1.25rem; width: 410px; max-width: calc(100vw - 2rem); background: #ffffff; border-radius: 1.25rem; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25), 0 0 0 1px rgba(226, 232, 240, 0.95); overflow: hidden; pointer-events: auto; z-index: 100000; font-family: 'Inter', -apple-system, sans-serif; color: #1e293b; display: flex; flex-direction: column;"
            >
                {{-- 1. Header Card --}}
                <div style="padding: 1.15rem 1.25rem 0.85rem; border-bottom: 1px solid #f1f5f9; background: #ffffff;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.9rem;">
                        <div style="display: flex; align-items: center; gap: 0.6rem;">
                            <div style="width: 2.25rem; height: 2.25rem; border-radius: 0.75rem; background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border: 1px solid #a7f3d0; display: flex; align-items: center; justify-content: center; color: #0A6B39; box-shadow: 0 2px 6px rgba(10, 107, 57, 0.1);">
                                <svg style="width: 1.2rem; height: 1.2rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                            </div>
                            <div>
                                <h3 style="font-family: 'Poppins', sans-serif; font-size: 1.05rem; font-weight: 700; color: #0f172a; margin: 0; line-height: 1.2;">
                                    Notifikasi
                                </h3>
                                <p style="font-size: 0.75rem; color: #64748b; margin: 0; line-height: 1.3;">
                                    Pemberitahuan aktivitas & sistem
                                </p>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 0.35rem;">
                            @if ($unreadNotificationsCount > 0)
                                <button
                                    type="button"
                                    wire:click="markAllNotificationsAsRead"
                                    style="padding: 0.35rem 0.65rem; border-radius: 0.5rem; border: none; background: #ecfdf5; color: #0A6B39; font-size: 0.75rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.3rem; transition: all 0.2s ease;"
                                    onmouseover="this.style.backgroundColor='#d1fae5';"
                                    onmouseout="this.style.backgroundColor='#ecfdf5';"
                                    title="Tandai semua pesan sudah dibaca"
                                >
                                    <svg style="width: 0.85rem; height: 0.85rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Baca Semua</span>
                                </button>
                            @endif

                            <button
                                type="button"
                                x-on:click="close()"
                                style="width: 2rem; height: 2rem; border-radius: 0.5rem; border: none; background: #f8fafc; color: #94a3b8; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease;"
                                onmouseover="this.style.backgroundColor='#f1f5f9'; this.style.color='#334155';"
                                onmouseout="this.style.backgroundColor='#f8fafc'; this.style.color='#94a3b8';"
                                title="Tutup Notifikasi"
                            >
                                <svg style="width: 1.15rem; height: 1.15rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- 2. Modern Segmented Tab Bar (Pill Style) --}}
                    <div style="background-color: #f1f5f9; padding: 0.25rem; border-radius: 0.75rem; display: grid; grid-template-columns: 1fr 1fr; gap: 0.25rem;">
                        {{-- Tab Belum Dibaca --}}
                        <button
                            type="button"
                            @click="activeTab = 'unread'"
                            :style="activeTab === 'unread'
                                ? 'background-color: #ffffff; color: #0A6B39; font-weight: 600; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08);'
                                : 'background-color: transparent; color: #64748b; font-weight: 500;'"
                            style="border: none; padding: 0.45rem 0.75rem; border-radius: 0.6rem; font-size: 0.775rem; display: flex; align-items: center; justify-content: center; gap: 0.4rem; cursor: pointer; transition: all 0.2s ease;"
                        >
                            <span>Belum Dibaca</span>
                            <span
                                :style="activeTab === 'unread'
                                    ? 'background: linear-gradient(135deg, #0A6B39, #054f2a); color: #ffffff;'
                                    : 'background-color: #e2e8f0; color: #64748b;'"
                                style="padding: 0.1rem 0.45rem; border-radius: 9999px; font-size: 0.65rem; font-weight: 700; min-width: 1.1rem; text-align: center; transition: all 0.2s ease;"
                            >
                                {{ $unreadNotificationsCount }}
                            </span>
                        </button>

                        {{-- Tab Semua Riwayat --}}
                        <button
                            type="button"
                            @click="activeTab = 'all'"
                            :style="activeTab === 'all'
                                ? 'background-color: #ffffff; color: #0A6B39; font-weight: 600; box-shadow: 0 1px 3px rgba(15, 23, 42, 0.08);'
                                : 'background-color: transparent; color: #64748b; font-weight: 500;'"
                            style="border: none; padding: 0.45rem 0.75rem; border-radius: 0.6rem; font-size: 0.775rem; display: flex; align-items: center; justify-content: center; gap: 0.4rem; cursor: pointer; transition: all 0.2s ease;"
                        >
                            <span>Semua Riwayat</span>
                            <span
                                :style="activeTab === 'all'
                                    ? 'background: linear-gradient(135deg, #0A6B39, #054f2a); color: #ffffff;'
                                    : 'background-color: #e2e8f0; color: #64748b;'"
                                style="padding: 0.1rem 0.45rem; border-radius: 9999px; font-size: 0.65rem; font-weight: 700; min-width: 1.1rem; text-align: center; transition: all 0.2s ease;"
                            >
                                {{ $totalCount }}
                            </span>
                        </button>
                    </div>
                </div>

                {{-- 3. Body Konten Notifikasi --}}
                <div style="max-height: 380px; overflow-y: auto; scrollbar-width: thin;">

                    {{-- TAB 1: BELUM DIBACA --}}
                    <div x-show="activeTab === 'unread'">
                        @if ($unreadNotificationsCount == 0)
                            {{-- Premium Empty State --}}
                            <div style="padding: 3.25rem 2rem; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                                <div style="position: relative; margin-bottom: 1.25rem;">
                                    <div style="width: 4.5rem; height: 4.5rem; border-radius: 9999px; background: radial-gradient(circle, #f0fdf4 0%, #ecfdf5 100%); border: 2px dashed #bbf7d0; display: flex; align-items: center; justify-content: center; color: #0A6B39; box-shadow: 0 10px 25px -5px rgba(10, 107, 57, 0.12);">
                                        <svg style="width: 2.25rem; height: 2.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 3l18 18"/>
                                        </svg>
                                    </div>
                                    <div style="position: absolute; bottom: -2px; right: -2px; width: 1.5rem; height: 1.5rem; border-radius: 9999px; background-color: #0A6B39; color: #ffffff; display: flex; align-items: center; justify-content: center; border: 2px solid #ffffff; box-shadow: 0 2px 5px rgba(0,0,0,0.15);">
                                        <svg style="width: 0.8rem; height: 0.8rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                </div>
                                <h4 style="font-family: 'Poppins', sans-serif; font-size: 0.95rem; font-weight: 700; color: #0f172a; margin: 0 0 0.35rem 0;">
                                    Semua Sudah Dibaca
                                </h4>
                                <p style="font-size: 0.8rem; color: #64748b; margin: 0; line-height: 1.55; max-width: 270px;">
                                    Hebat! Anda tidak memiliki pemberitahuan baru yang tertunda saat ini.
                                </p>
                            </div>
                        @else
                            <div style="display: flex; flex-direction: column;">
                                @foreach ($unreadNotifications as $notification)
                                    <div style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9; position: relative; border-left: 3.5px solid #0A6B39; background-color: #fdfefe; transition: background-color 0.15s ease;" onmouseover="this.style.backgroundColor='#f8fafc';" onmouseout="this.style.backgroundColor='#fdfefe';">
                                        {{ $this->getNotification($notification)->inline() }}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- TAB 2: SEMUA RIWAYAT --}}
                    <div x-show="activeTab === 'all'">
                        @if ($totalCount == 0)
                            <div style="padding: 3.25rem 2rem; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                                <div style="width: 4.5rem; height: 4.5rem; border-radius: 9999px; background-color: #f8fafc; border: 2px dashed #e2e8f0; display: flex; align-items: center; justify-content: center; color: #94a3b8; margin-bottom: 1.25rem;">
                                    <svg style="width: 2.25rem; height: 2.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                                <h4 style="font-family: 'Poppins', sans-serif; font-size: 0.95rem; font-weight: 700; color: #0f172a; margin: 0 0 0.35rem 0;">
                                    Belum Ada Riwayat
                                </h4>
                                <p style="font-size: 0.8rem; color: #64748b; margin: 0; line-height: 1.55; max-width: 260px;">
                                    Pemberitahuan, tugas kelas, dan aktivitas pengumuman akan tercatat di sini.
                                </p>
                            </div>
                        @else
                            <div style="display: flex; flex-direction: column;">
                                @foreach ($notifications as $notification)
                                    <div style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9; position: relative; {{ $notification->unread() ? 'border-left: 3.5px solid #0A6B39; background-color: #fdfefe;' : 'border-left: 3.5px solid transparent; background-color: #ffffff;' }} transition: background-color 0.15s ease;" onmouseover="this.style.backgroundColor='#f8fafc';" onmouseout="this.style.backgroundColor='{{ $notification->unread() ? '#fdfefe' : '#ffffff' }}';">
                                        {{ $this->getNotification($notification)->inline() }}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                </div>

                {{-- 4. Footer Card --}}
                <div style="padding: 0.85rem 1.25rem; background-color: #f8fafc; border-top: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; font-size: 0.775rem;">
                    <div style="display: flex; align-items: center; gap: 0.45rem; color: #64748b; font-size: 0.725rem;">
                        <span style="display: inline-block; width: 0.5rem; height: 0.5rem; border-radius: 9999px; background-color: #10b981; box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);"></span>
                        <span>Terhubung Real-Time</span>
                    </div>

                    <div style="display: flex; align-items: center; gap: 0.85rem;">
                        <button
                            type="button"
                            @click="activeTab = (activeTab === 'unread' ? 'all' : 'unread')"
                            style="border: none; background: none; color: #0A6B39; font-weight: 600; font-size: 0.775rem; cursor: pointer; display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.2rem 0.4rem; border-radius: 0.375rem; transition: all 0.2s ease;"
                            onmouseover="this.style.backgroundColor='#ecfdf5';"
                            onmouseout="this.style.backgroundColor='transparent';"
                        >
                            <svg style="width: 0.95rem; height: 0.95rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                            <span x-text="activeTab === 'unread' ? 'Lihat Riwayat Lengkap ({{ $totalCount }})' : 'Tampilkan Belum Dibaca ({{ $unreadNotificationsCount }})'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
