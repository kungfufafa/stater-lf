<div>
    @php
        $navigation = filament()->getNavigation();
    @endphp

    <div class="h-full fi-sidebar-wrapper">
        <!-- Desktop Sidebar -->
        <aside
            class="sh-si hidden h-full lg:flex lg:shrink-0 fi-sidebar fi-main-sidebar"
            x-bind:class="{
                'fi-sidebar-open': $store.sidebar.isOpen,
                'sh-si-collapsed': $store.sidebar.isCollapsed,
            }"
        >
            <div class="sh-si-content h-full flex-1 overflow-hidden">
                <div class="from-primary-600 to-primary-100 dark:to-primary-600/10 h-1 bg-linear-to-br"></div>
                <div class="flex h-full flex-col">
                    <!-- Header / Branding -->
                    <div class="py-4 px-6 border-b border-dashed border-gray-200 dark:border-white/20">
                        <div class="relative flex items-center gap-3">
                            <x-shopper::brand class="size-6 shrink-0" aria-hidden="true" />
                            <div
                                class="min-w-0 truncate overflow-hidden transition-all duration-200"
                                x-show="! $store.sidebar.isCompact()"
                            >
                                <h4 class="truncate text-sm font-medium text-gray-900 dark:text-white">
                                    {{ config('app.name') }}
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <nav class="fi-sidebar-nav flex-1 overflow-y-auto px-4 py-4">
                        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIDEBAR_NAV_START) }}

                        <ul class="fi-sidebar-nav-groups space-y-6">
                            @foreach ($navigation as $group)
                                <x-filament-panels::sidebar.group
                                    :active="$group->isActive()"
                                    :collapsible="$group->isCollapsible()"
                                    :icon="$group->getIcon()"
                                    :items="$group->getItems()"
                                    :label="$group->getLabel()"
                                    :attributes="\Filament\Support\prepare_inherited_attributes($group->getExtraSidebarAttributeBag())"
                                />
                            @endforeach
                        </ul>

                        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIDEBAR_NAV_END) }}
                    </nav>
                </div>
            </div>
        </aside>

        <!-- Mobile Sidebar -->
        <div x-cloak x-show="$store.sidebar.isOpen" class="lg:hidden">
            <!-- Backdrop -->
            <div
                x-show="$store.sidebar.isOpen"
                x-transition:enter="transition-opacity duration-300 ease-linear"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity duration-300 ease-linear"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="$store.sidebar.close()"
                class="fixed inset-0 z-40 bg-gray-950/50 backdrop-blur-xs dark:bg-gray-950/75"
            ></div>

            <!-- Sidebar Panel -->
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
                        <!-- Header / Branding -->
                        <div class="px-3 py-4 border-b border-dashed border-gray-200 dark:border-white/20">
                            <div class="relative flex items-center gap-3">
                                <x-shopper::brand class="size-6 shrink-0" aria-hidden="true" />
                                <div class="truncate">
                                    <h4 class="font-heading truncate text-sm font-medium text-gray-900 dark:text-white">
                                        {{ config('app.name') }}
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation -->
                        <nav class="fi-sidebar-nav flex-1 overflow-y-auto px-4 py-4">
                            <ul class="fi-sidebar-nav-groups space-y-6">
                                @foreach ($navigation as $group)
                                    <x-filament-panels::sidebar.group
                                        :active="$group->isActive()"
                                        :collapsible="$group->isCollapsible()"
                                        :icon="$group->getIcon()"
                                        :items="$group->getItems()"
                                        :label="$group->getLabel()"
                                        :attributes="\Filament\Support\prepare_inherited_attributes($group->getExtraSidebarAttributeBag())"
                                    />
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
