@props([
    'navigation',
    'livewire' => null,
])

@php
    $breadcrumbs = [];
    if ($livewire && method_exists($livewire, 'getBreadcrumbs') && filament()->hasBreadcrumbs()) {
        $breadcrumbs = $livewire->getBreadcrumbs();
    }
    if (empty($breadcrumbs) && filament()->hasBreadcrumbs()) {
        $title = ($livewire && method_exists($livewire, 'getTitle')) ? $livewire->getTitle() : null;
        if ($title) {
            $breadcrumbs = [$title];
        }
    }
@endphp

<div
    {{
        $attributes->class([
            'fi-topbar sticky top-0 z-20 overflow-x-clip',
            'fi-topbar-with-navigation' => filament()->hasTopNavigation(),
        ])
    }}
>
    <nav
        class="flex h-16 items-center gap-x-3 sm:gap-x-4 bg-white/95 backdrop-blur-md px-4 shadow-sm border-b-2 border-[#0A6B39] md:px-6 lg:px-8"
        style="height: 4.25rem; box-shadow: 0 4px 20px -2px rgba(10, 107, 57, 0.08), 0 1px 3px rgba(0, 0, 0, 0.04);"
    >
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_START) }}

        {{-- Sidebar Toggle Buttons --}}
        @if (filament()->hasNavigation())
            <x-filament::icon-button
                color="gray"
                icon="heroicon-o-bars-3"
                icon-alias="panels::topbar.open-sidebar-button"
                icon-size="lg"
                :label="__('filament-panels::layout.actions.sidebar.expand.label')"
                x-cloak
                x-data="{}"
                x-on:click="$store.sidebar.open()"
                x-show="! $store.sidebar.isOpen"
                @class([
                    'fi-topbar-open-sidebar-btn',
                    'lg:hidden' => (! filament()->isSidebarFullyCollapsibleOnDesktop()) || filament()->isSidebarCollapsibleOnDesktop(),
                ])
            />

            <x-filament::icon-button
                color="gray"
                icon="heroicon-o-x-mark"
                icon-alias="panels::topbar.close-sidebar-button"
                icon-size="lg"
                :label="__('filament-panels::layout.actions.sidebar.collapse.label')"
                x-cloak
                x-data="{}"
                x-on:click="$store.sidebar.close()"
                x-show="$store.sidebar.isOpen"
                class="fi-topbar-close-sidebar-btn lg:hidden"
            />
        @endif

        {{-- BREADCRUMBS HALAMAN DI DALAM TOPBAR --}}
        <div class="flex items-center gap-2 overflow-x-auto py-1 max-w-full">
            <div id="topbar-breadcrumbs-target" class="flex items-center text-sm">
                @if (! empty($breadcrumbs))
                    <x-filament::breadcrumbs
                        :breadcrumbs="$breadcrumbs"
                        class="flex items-center"
                    />
                @endif
            </div>
        </div>

        @if (filament()->hasTopNavigation() || (! filament()->hasNavigation()))
            <div class="me-6 hidden lg:flex">
                @if ($homeUrl = filament()->getHomeUrl())
                    <a {{ \Filament\Support\generate_href_html($homeUrl) }}>
                        <x-filament-panels::logo />
                    </a>
                @else
                    <x-filament-panels::logo />
                @endif
            </div>
        @endif

        @if (filament()->hasTenancy() && filament()->hasTenantMenu())
            <x-filament-panels::tenant-menu class="hidden lg:block" />
        @endif

        @if (filament()->hasTopNavigation())
            <ul class="me-4 hidden items-center gap-x-4 lg:flex">
                @foreach ($navigation as $group)
                    @if ($groupLabel = $group->getLabel())
                        <x-filament::dropdown
                            placement="bottom-start"
                            teleport
                            :attributes="\Filament\Support\prepare_inherited_attributes($group->getExtraTopbarAttributeBag())"
                        >
                            <x-slot name="trigger">
                                <x-filament-panels::topbar.item
                                    :active="$group->isActive()"
                                    :icon="$group->getIcon()"
                                >
                                    {{ $groupLabel }}
                                </x-filament-panels::topbar.item>
                            </x-slot>

                            @php
                                $lists = [];
                                foreach ($group->getItems() as $item) {
                                    if ($childItems = $item->getChildItems()) {
                                        $lists[] = [$item, ...$childItems];
                                        $lists[] = [];
                                        continue;
                                    }
                                    if (empty($lists)) {
                                        $lists[] = [$item];
                                        continue;
                                    }
                                    $lists[count($lists) - 1][] = $item;
                                }
                                if (empty($lists[count($lists) - 1])) {
                                    array_pop($lists);
                                }
                            @endphp

                            @foreach ($lists as $list)
                                <x-filament::dropdown.list>
                                    @foreach ($list as $item)
                                        <x-filament::dropdown.list.item
                                            :badge="$item->getBadge()"
                                            :badge-color="$item->getBadgeColor()"
                                            :badge-tooltip="$item->getBadgeTooltip()"
                                            :color="$item->isActive() ? 'primary' : 'gray'"
                                            :href="$item->getUrl()"
                                            :icon="$item->isActive() ? ($item->getActiveIcon() ?? $item->getIcon()) : $item->getIcon()"
                                            tag="a"
                                            :target="$item->shouldOpenUrlInNewTab() ? '_blank' : null"
                                        >
                                            {{ $item->getLabel() }}
                                        </x-filament::dropdown.list.item>
                                    @endforeach
                                </x-filament::dropdown.list>
                            @endforeach
                        </x-filament::dropdown>
                    @else
                        @foreach ($group->getItems() as $item)
                            <x-filament-panels::topbar.item
                                :active="$item->isActive()"
                                :active-icon="$item->getActiveIcon()"
                                :badge="$item->getBadge()"
                                :badge-color="$item->getBadgeColor()"
                                :badge-tooltip="$item->getBadgeTooltip()"
                                :icon="$item->getIcon()"
                                :should-open-url-in-new-tab="$item->shouldOpenUrlInNewTab()"
                                :url="$item->getUrl()"
                            >
                                {{ $item->getLabel() }}
                            </x-filament-panels::topbar.item>
                        @endforeach
                    @endif
                @endforeach
            </ul>
        @endif

        {{-- SISI KANAN TOPBAR: WAKTU REALTIME + NOTIFIKASI + PROFIL --}}
        <div
            @if (filament()->hasTenancy())
                x-persist="topbar.end.panel-{{ filament()->getId() }}.tenant-{{ filament()->getTenant()?->getKey() }}"
            @else
                x-persist="topbar.end.panel-{{ filament()->getId() }}"
            @endif
            class="ms-auto flex items-center gap-x-2.5 sm:gap-x-4"
        >
            {{-- WAKTU REALTIME INDONESIA (LIVE TICKING DIGITAL CLOCK) --}}
            <div
                x-data="{
                    time: '',
                    date: '',
                    init() {
                        this.update();
                        setInterval(() => this.update(), 1000);
                    },
                    update() {
                        const now = new Date();
                        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

                        const dayName = days[now.getDay()];
                        const dateNum = now.getDate();
                        const monthName = months[now.getMonth()];
                        const yearNum = now.getFullYear();

                        const hours = String(now.getHours()).padStart(2, '0');
                        const minutes = String(now.getMinutes()).padStart(2, '0');
                        const seconds = String(now.getSeconds()).padStart(2, '0');

                        this.date = `${dayName}, ${dateNum} ${monthName} ${yearNum}`;
                        this.time = `${hours}:${minutes}:${seconds} WIB`;
                    }
                }"
                class="flex items-center gap-2.5 px-3.5 py-1.5 rounded-xl bg-slate-50/90 border border-slate-200/80 shadow-2xs hover:border-emerald-300 transition-colors cursor-default"
                title="Waktu Real-time Server SI-UKRI (WIB)"
            >
                {{-- Live Radar Pulse Dot --}}
                <div class="relative flex items-center justify-center">
                    <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-[#0A6B39]"></span>
                </div>

                {{-- Tanggal & Jam Digital --}}
                <div class="flex items-center gap-2 text-xs">
                    <span x-text="date" class="font-medium text-slate-600 hidden md:inline font-inter"></span>
                    <span class="text-slate-300 hidden md:inline">•</span>
                    <span x-text="time" class="font-bold text-slate-800 font-mono tracking-tight text-[12px]"></span>
                </div>
            </div>

            {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::GLOBAL_SEARCH_BEFORE) }}

            @if (filament()->isGlobalSearchEnabled())
                @livewire(Filament\Livewire\GlobalSearch::class)
            @endif

            {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::GLOBAL_SEARCH_AFTER) }}

            @if (filament()->auth()->check())
                {{-- Lonceng Notifikasi --}}
                @if (filament()->hasDatabaseNotifications())
                    @livewire(Filament\Livewire\DatabaseNotifications::class, [
                        'lazy' => filament()->hasLazyLoadedDatabaseNotifications(),
                    ])
                @endif

                {{-- User Avatar Menu --}}
                <x-filament-panels::user-menu />
            @endif
        </div>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::TOPBAR_END) }}
    </nav>
</div>
