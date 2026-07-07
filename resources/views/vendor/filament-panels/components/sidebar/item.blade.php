@props([
    'active' => false,
    'activeChildItems' => false,
    'activeIcon' => null,
    'badge' => null,
    'badgeColor' => null,
    'badgeTooltip' => null,
    'childItems' => [],
    'first' => false,
    'grouped' => false,
    'icon' => null,
    'last' => false,
    'shouldOpenUrlInNewTab' => false,
    'sidebarCollapsible' => true,
    'subGrouped' => false,
    'subNavigation' => false,
    'url',
])

@php
    $sidebarCollapsible = $sidebarCollapsible && filament()->isSidebarCollapsibleOnDesktop();
@endphp

<li
    {{
        $attributes->class([
            'fi-sidebar-item sh-sidebar-item',
            'fi-active sh-sidebar-item-active' => $active,
            'fi-sidebar-item-has-active-child-items' => $activeChildItems,
            'fi-sidebar-item-has-url' => filled($url),
        ])
    }}
>
    <a
        {{ \Filament\Support\generate_href_html($url, $shouldOpenUrlInNewTab) }}
        x-on:click="window.matchMedia(`(max-width: 1024px)`).matches && $store.sidebar.close()"
        @if ($sidebarCollapsible && (! $subNavigation))
            x-data="{ tooltip: false }"
            x-effect="
                tooltip = ! $store.sidebar.isCompact()
                    ? false
                    : {
                          content: @js($slot->toHtml()),
                          placement: document.dir === 'rtl' ? 'left' : 'right',
                          theme: $store.theme,
                      }
            "
            x-tooltip.html="tooltip"
        @endif
        class="fi-sidebar-item-btn sh-sidebar-item-link flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition-colors duration-150 {{ $active ? 'bg-primary-50 text-primary-600 dark:bg-white/10 dark:text-white font-semibold' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-white/5 dark:hover:text-white' }}"
    >
        @if (filled($icon) && ((! $subGrouped) || ($sidebarCollapsible && (! $subNavigation))))
            {{
                \Filament\Support\generate_icon_html(($active && $activeIcon) ? $activeIcon : $icon, attributes: (new \Illuminate\View\ComponentAttributeBag([
                    'x-show' => ($subGrouped && $sidebarCollapsible) ? '$store.sidebar.isCompact()' : false,
                ]))->class(['fi-sidebar-item-icon sh-sidebar-item-icon size-5 shrink-0 ' . ($active ? 'text-primary-600 dark:text-white' : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-500 dark:group-hover:text-gray-300')]), size: \Filament\Support\Enums\IconSize::Large)
            }}
        @endif

        @if ((blank($icon) && $grouped) || $subGrouped)
            <div
                @if (filled($icon) && $subGrouped && $sidebarCollapsible)
                    x-show="! $store.sidebar.isCompact()"
                @endif
                class="fi-sidebar-item-grouped-border size-1.5 rounded-full bg-gray-400 dark:bg-gray-500"
            ></div>
        @endif

        <span
            @if ($sidebarCollapsible && (! $subNavigation))
                x-show="! $store.sidebar.isCompact()"
                x-transition:enter="fi-transition-enter"
                x-transition:enter-start="fi-transition-enter-start"
                x-transition:enter-end="fi-transition-enter-end"
            @endif
            class="fi-sidebar-item-label sh-sidebar-item-label flex-1 truncate"
        >
            {{ $slot }}
        </span>

        @if (filled($badge))
            <span
                @if ($sidebarCollapsible && (! $subNavigation))
                    x-show="! $store.sidebar.isCompact()"
                    x-transition:enter="fi-transition-enter"
                    x-transition:enter-start="fi-transition-enter-start"
                    x-transition:enter-end="fi-transition-enter-end"
                @endif
            >
                <x-filament::badge
                    :color="$badgeColor"
                    :tooltip="$badgeTooltip"
                    class="fi-sidebar-item-badge"
                >
                    {{ $badge }}
                </x-filament::badge>
            </span>
        @endif
    </a>

    @if ((! $sidebarCollapsible) || $subNavigation)
        @if (! empty($childItems))
            <ul class="fi-sidebar-sub-group-items space-y-1 ps-4 mt-1">
                @foreach ($childItems as $childItem)
                    @php
                        $isChildItemActive = $childItem->isActive();
                        $childItemActiveIcon = $childItem->getActiveIcon();
                        $childItemBadge = $childItem->getBadge();
                        $childItemBadgeColor = $childItem->getBadgeColor($childItemBadge);
                        $childItemBadgeTooltip = $childItem->getBadgeTooltip($childItemBadge);
                        $childItemIcon = $childItem->getIcon();
                        $shouldChildItemOpenUrlInNewTab = $childItem->shouldOpenUrlInNewTab();
                        $childItemUrl = $childItem->getUrl();
                        $childItemExtraAttributes = $childItem->getExtraAttributeBag();
                    @endphp

                    <x-filament-panels::sidebar.item
                        :active="$isChildItemActive"
                        :active-icon="$childItemActiveIcon"
                        :badge="$childItemBadge"
                        :badge-color="$childItemBadgeColor"
                        :badge-tooltip="$childItemBadgeTooltip"
                        :first="$loop->first"
                        :grouped="true"
                        :icon="$childItemIcon"
                        :last="$loop->last"
                        :should-open-url-in-new-tab="$shouldChildItemOpenUrlInNewTab"
                        :sidebar-collapsible="$sidebarCollapsible"
                        :sub-grouped="true"
                        :sub-navigation="$subNavigation"
                        :url="$childItemUrl"
                        :attributes="\Filament\Support\prepare_inherited_attributes($childItemExtraAttributes)"
                    >
                        {{ $childItem->getLabel() }}

                        @if ($childItemIcon instanceof \Illuminate\Contracts\Support\Htmlable)
                            <x-slot name="icon">
                                {{ $childItemIcon }}
                            </x-slot>
                        @endif

                        @if ($childItemActiveIcon instanceof \Illuminate\Contracts\Support\Htmlable)
                            <x-slot name="activeIcon">
                                {{ $childItemActiveIcon }}
                            </x-slot>
                        @endif
                    </x-filament-panels::sidebar.item>
                @endforeach
            </ul>
        @endif
    @else
        <x-filament::dropdown
            :placement="(__('filament-panels::layout.direction') === 'rtl') ? 'left-start' : 'right-start'"
            x-show="$store.sidebar.isCompact()"
        >
            <x-slot name="trigger">
                <button
                    x-data="{ tooltip: false }"
                    x-effect="
                        tooltip = ! $store.sidebar.isCompact()
                            ? false
                            : {
                                  content: @js($slot->toHtml()),
                                  placement: document.dir === 'rtl' ? 'left' : 'right',
                                  theme: $store.theme,
                              }
                    "
                    x-tooltip.html="tooltip"
                    class="fi-sidebar-item-dropdown-trigger-btn hidden"
                ></button>
            </x-slot>
        </x-filament::dropdown>
    @endif
</li>
