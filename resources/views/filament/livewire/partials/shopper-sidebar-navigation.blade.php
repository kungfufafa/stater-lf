<div class="sh-sidebar">
    @foreach ($navigation as $group)
        @php
            $groupLabel = $group->getLabel();
            $groupItems = $group->getItems();
            $groupKey = filled($groupLabel) ? $groupLabel : 'default';
        @endphp

        <div
            class="sh-sidebar-group"
            x-data="{ label: @js($groupKey) }"
        >
            @if (filled($groupLabel))
                <button
                    type="button"
                    class="sh-sidebar-group-label w-full"
                    x-on:click="$store.sidebar.toggleCollapsedGroup(label)"
                >
                    <span>{{ $groupLabel }}</span>

                    <span
                        class="sh-sidebar-group-toggle transition-transform"
                        x-bind:class="{ 'rotate-180': $store.sidebar.groupIsCollapsed(label) }"
                    >
                        <x-filament::icon
                            :icon="\Filament\Support\Icons\Heroicon::ChevronUp"
                            class="size-4"
                        />
                    </span>
                </button>
            @endif

            <ul
                role="list"
                class="sh-sidebar-group-items"
                @if (filled($groupLabel))
                    x-show="! $store.sidebar.groupIsCollapsed(label)"
                    x-collapse.duration.200ms
                @endif
            >
                @foreach ($groupItems as $item)
                    @include('filament.livewire.partials.shopper-sidebar-item', [
                        'item' => $item,
                    ])
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
