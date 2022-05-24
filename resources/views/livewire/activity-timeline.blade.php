<div>
    <div class="mt-6 flow-root">
        <ul role="list" class="-mb-8">

            @forelse ($activities as $activity)

            @php
            if (is_null(App\Models\User::find($activity->causer_id))) {
            $causer_name = __('n/a');
            }
            else {
            $causer_name = App\Models\User::find($activity->causer_id)->name;
            }
            @endphp

            @if ($activity->description === 'gig_created')
            <x-timeline-activity.gig_created :lastItem="$loop->last" :date="$activity->created_at"
                                             :changes="$activity->changes" :causer_name="$causer_name" />
            @endif

            @if ($activity->description === 'gig_response_updated')
            <x-timeline-activity.gig_response_updated :lastItem="$loop->last" :date="$activity->created_at"
                                                      :changes="$activity->changes" :causer_name="$causer_name" />
            @endif

            @empty
            <x-timeline-activity.empty :lastItem="true" />
            @endforelse

        </ul>
    </div>
    {{-- <div class="mt-6 flex flex-col justify-stretch">
        <button type="button"
                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Advance
            to offer</button>
    </div> --}}
</div>
