<div class="md:flex md:items-center md:justify-between md:space-x-5">
    <div class="flex items-start space-x-5">
        <div class="flex-shrink-0">
            <div class="relative">
                <img class="h-16 w-16 rounded-full"
                     src="{{ $url }}"
                     alt="{{ $alt }}">
                <span class="absolute inset-0 shadow-inner rounded-full" aria-hidden="true"></span>
            </div>
        </div>
        <div class="pt-1.5">
            <h1 class="text-2xl font-bold text-gray-900">{{ $title }}</h1>
            {{ $subtitle }}
            {{-- <p class="text-sm font-medium text-gray-500">Applied for <a href="#" class="text-gray-900">Front End
                    Developer</a> on <time datetime="2020-08-25">August 25, 2020</time></p> --}}
        </div>
    </div>
    <div
         class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
        {{ $action }}
    </div>
</div>
