@php
    use Filament\Enums\DatabaseNotificationsPosition;
    use Filament\Enums\UserMenuPosition;
    use Filament\Support\Icons\Heroicon;
    use Illuminate\View\ComponentAttributeBag;

    use function Filament\Support\generate_icon_html;

    $navigation = filament()->getNavigation();
    $hasDatabaseNotificationsInSidebar = filament()->hasDatabaseNotifications()
        && filament()->getDatabaseNotificationsPosition() === DatabaseNotificationsPosition::Sidebar;
    $hasUserMenuInSidebar = filament()->hasUserMenu()
        && filament()->getUserMenuPosition() === UserMenuPosition::Sidebar;
@endphp

<div class="h-full">
    <script>
        if (
            localStorage.getItem('collapsedGroups') === null ||
            localStorage.getItem('collapsedGroups') === 'null'
        ) {
            localStorage.setItem('collapsedGroups', JSON.stringify([]))
        }
    </script>

    <aside
        x-data="{}"
        x-cloak="-lg"
        x-bind:class="{
            'fi-sidebar-open': $store.sidebar.isOpen,
            'sh-si-collapsed': $store.sidebar.isCollapsed,
            'sh-si-transitioning': $store.sidebar.isTransitioning,
        }"
        class="fi-sidebar fi-main-sidebar sh-si hidden h-full lg:flex lg:shrink-0"
    >
        <div class="sh-si-content h-full flex-1 overflow-hidden">
            <div class="from-primary-600 to-primary-100 dark:to-primary-600/10 h-1 bg-linear-to-br"></div>

            <div class="flex h-full flex-col">
                <div class="border-b border-dashed border-gray-200 px-6 py-4 dark:border-white/20">
                    <div class="relative flex items-center gap-3">
                        <x-shopper::brand class="size-6 shrink-0" aria-hidden="true" />

                        <div
                            class="min-w-0 truncate overflow-hidden transition-all duration-200"
                            x-show="! $store.sidebar.isCompact()"
                            x-transition:enter="transition-opacity delay-100 duration-200"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition-opacity duration-100"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                        >
                            <h4 class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                {{ config('app.name') }}
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="flex min-h-0 flex-1 flex-col justify-between">
                    <div class="relative min-h-0 flex-1">
                        <div class="pointer-events-none absolute left-0 right-0.5 top-0 z-10 h-6 bg-linear-to-b from-gray-50 to-transparent dark:from-gray-950"></div>

                        <div class="h-full overflow-y-auto">
                            <nav class="fi-sidebar-nav sh-si-nav px-3 py-3">
                                @include('filament.livewire.partials.shopper-sidebar-navigation', [
                                    'navigation' => $navigation,
                                ])
                            </nav>
                        </div>

                        <div class="pointer-events-none absolute bottom-0 left-0 right-0.5 z-10 h-6 bg-linear-to-t from-gray-50 to-transparent dark:from-gray-950"></div>
                    </div>

                    @if (filament()->auth()->check() && ($hasDatabaseNotificationsInSidebar || $hasUserMenuInSidebar))
                        <div class="sh-sidebar border-t border-gray-200 px-3 pb-6 pt-3 dark:border-white/20">
                            @if ($hasDatabaseNotificationsInSidebar)
                                @livewire(filament()->getDatabaseNotificationsLivewireComponent(), [
                                    'lazy' => filament()->hasLazyLoadedDatabaseNotifications(),
                                ])
                            @endif

                            @if ($hasUserMenuInSidebar)
                                <x-filament-panels::user-menu />
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </aside>

    <div x-cloak x-show="$store.sidebar.isOpen" class="lg:hidden">
        <div
            x-show="$store.sidebar.isOpen"
            x-transition:enter="transition-opacity duration-300 ease-linear"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity duration-300 ease-linear"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-on:click="$store.sidebar.close()"
            class="fixed inset-0 z-40 bg-gray-950/50 backdrop-blur-xs dark:bg-gray-950/75"
        ></div>

        <div class="pointer-events-none fixed inset-0 z-50 flex">
            <div
                x-cloak
                x-show="$store.sidebar.isOpen"
                x-transition:enter="transform transition duration-200 ease-in-out"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition duration-200 ease-in-out"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="pointer-events-auto relative flex w-full max-w-xs flex-col bg-white dark:bg-gray-900"
            >
                <div class="from-primary-600 to-primary-100 dark:to-primary-600/10 h-1 bg-linear-to-br"></div>

                <div class="flex h-full flex-col overflow-hidden">
                    <div class="px-3 py-4">
                        <div class="relative flex items-center gap-3 rounded-lg bg-white px-3 py-2 shadow-xs ring-1 ring-gray-200 dark:bg-white/5 dark:ring-white/20">
                            <a href="{{ filament()->getUrl() }}" class="shrink-0">
                                <x-shopper::brand class="size-8" aria-hidden="true" />
                                <span class="absolute inset-0"></span>
                            </a>

                            <div class="truncate">
                                <h4 class="font-heading truncate text-sm font-medium text-gray-900 dark:text-white">
                                    {{ config('app.name') }}
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="flex min-h-0 flex-1 flex-col justify-between">
                        <div class="relative min-h-0 flex-1">
                            <div class="h-full overflow-y-auto">
                                <nav class="sh-si-nav px-3 py-3">
                                    @include('filament.livewire.partials.shopper-sidebar-navigation', [
                                        'navigation' => $navigation,
                                    ])
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-filament-actions::modals />
</div>
