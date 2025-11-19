@props(['sortable' => null, 'direction' => null, 'sorted' => null])

<th
    class="p-3 first:pe-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white border-b border-zinc-800/10 dark:border-white/20">
    <div class="flex in-[.group\/center-align]:justify-center in-[.group\/end-align]:justify-end"
        {{ $attributes->only('wire:click') }}>
        @if (!$sortable)
            {{ $slot }}
        @else
            <button type="button"
                class="group/sortable flex items-center gap-1 -my-1 -ms-2 px-2 py-1 in-[.group\/end-align]:flex-row-reverse in-[.group\/end-align]:-me-2 in-[.group\/end-align]:-ms-8 cursor-pointer">
                <div>{{ $slot }}</div>

                @if ($sorted)
                    <div @class([
                        'rounded-sm text-zinc-400 group-hover/sortable:text-zinc-800 dark:group-hover/sortable:text-white',
                        'rotate-180' => $direction == 'desc',
                    ])>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
</svg>

                @endif
            </button>
        @endif
    </div>
</th>
