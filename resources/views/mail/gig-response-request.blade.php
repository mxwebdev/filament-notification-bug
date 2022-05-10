@component('mail::message')
# {{ $gigResponse->gig->name }}

{{ __(':creator has created a new gig for **:team** and invited you to join.', ['creator' => $gigResponse->gig->creator->name, 'team' => $gigResponse->gig->team->name]) }}

- **Date:** {{ $gigResponse->gig->gig_start->toFormattedDateString() }}
- **Location:** {{ $gigResponse->gig->location }}

{{ __('You may accept this invitation by clicking the button below:') }}

@component('mail::button', ['url' => $acceptUrl])
{{ __('Accept Invitation') }}
@endcomponent

@component('mail::button', ['url' => $declineUrl])
{{ __('Decline Invitation') }}
@endcomponent

@endcomponent
