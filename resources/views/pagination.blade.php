<div>
    @if ($paginator->hasPages())
    @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ?
    $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ :
    $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

    <!-- Pagination -->
    <nav class="border-t border-gray-200 pb-4 px-4 flex items-center justify-between sm:px-0" aria-label="Pagination">

        <!-- Previous Page Link -->
        <div class="-mt-px w-0 pl-4 flex-1 flex">
            @unless ($paginator->onFirstPage())
            <a wire:click="previousPage('{{ $paginator->getPageName() }}')"
               dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
               rel="prev" aria-label="{{ __('pagination.previous') }}"
               class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500
            hover:text-gray-700 cursor-pointer">
                <!-- Heroicon name: solid/arrow-narrow-left -->
                <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                     fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                          clip-rule="evenodd" />
                </svg>
                {{ __('pagination.previous') }}
            </a>
            @endunless
        </div>

        {{-- Pagination Elements --}}
        <div class="hidden md:-mt-px md:flex">

            @foreach ($elements as $element)

            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <span aria-disabled="true">
                <span>{{ $element }}</span>
            </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            <span
                  wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page{{ $page }}">

                @if ($page == $paginator->currentPage())
                <span class="border-blue-700 text-blue-700 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium cursor-pointer"
                      aria-current="page"> {{ $page }} </span>
                @else
                <a wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                   aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                   class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium cursor-pointer">
                    {{ $page }} </a>
                @endif
            </span>
            @endforeach
            @endif

            @endforeach

        </div>

        <!-- Next Page Link -->
        <div class="-mt-px pr-4 w-0 flex-1 flex justify-end">
            @if ($paginator->hasMorePages())
            <a wire:click="nextPage('{{ $paginator->getPageName() }}')"
               dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
               rel="next" aria-label="{{ __('pagination.next') }}"
               class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500
               hover:text-gray-700 cursor-pointer">
                {{ __('pagination.next') }}
                <!-- Heroicon name: solid/arrow-narrow-right -->
                <svg class="ml-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                     fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                          clip-rule="evenodd" />
                </svg>
            </a>
            @endif
        </div>

    </nav>

    @endif
</div>
