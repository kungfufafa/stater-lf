@php
    use Filament\Support\Enums\IconSize;
    use Illuminate\View\ComponentAttributeBag;

    use function Filament\Support\generate_href_html;
    use function Filament\Support\generate_icon_html;

    $isActive = $item->isActive();
    $hasActiveChildren = $item->isChildItemsActive();
    $childItems = $item->getChildItems();
    $hasChildItems = filled($childItems);
    $activeIcon = $item->getActiveIcon();
    $icon = ($isActive && $activeIcon) ? $activeIcon : $item->getIcon();
    $badge = $item->getBadge();
    $badgeColor = $item->getBadgeColor($badge);
    $badgeColor = is_string($badgeColor) ? $badgeColor : 'gray';
    $url = $item->getUrl();
@endphp

<li
    @class([
        'sh-sidebar-item',
        'sh-sidebar-item-active' => $isActive || $hasActiveChildren,
        'sh-items-has-child' => $hasChildItems,
    ])
>
    <a
        {{ generate_href_html($url, $item->shouldOpenUrlInNewTab()) }}
        x-on:click="window.matchMedia('(max-width: 1024px)').matches && $store.sidebar.close()"
        x-tooltip="{
            content: @js($item->getLabel()),
            placement: 'right',
            theme: $store.theme,
            onShow: () => $store.sidebar.isCompact(),
        }"
        class="sh-sidebar-item-link {{ ($isActive || $hasActiveChildren) ? 'sh-active' : '' }}"
    >
        @if (filled($icon))
            {{
                generate_icon_html(
                    $icon,
                    attributes: (new ComponentAttributeBag)->class(['sh-sidebar-item-icon']),
                    size: IconSize::Large,
                )
            }}
        @else
            <span class="sh-sidebar-item-dot"></span>
        @endif

        <span
            class="sh-sidebar-item-label"
        >
            {{ $item->getLabel() }}
        </span>

        @if (filled($badge) || $hasChildItems)
            <span class="sh-sidebar-item-nav">
                @if (filled($badge))
                    <span class="sh-sidebar-item-badge sh-sidebar-item-badge-{{ $badgeColor }}">
                        {{ $badge }}
                    </span>
                @endif

                @if ($hasChildItems)
                    <x-filament::icon
                        :icon="\Filament\Support\Icons\Heroicon::ChevronDown"
                        class="sh-sidebar-item-toggle size-4"
                    />
                @endif
            </span>
        @endif
    </a>

    @if ($hasChildItems)
        <ul class="sh-submenu {{ $isActive || $hasActiveChildren ? 'block' : '' }}">
            @foreach ($childItems as $childItem)
                @include('filament.livewire.partials.shopper-sidebar-item', [
                    'item' => $childItem,
                ])
            @endforeach
        </ul>
    @endif
</li>
