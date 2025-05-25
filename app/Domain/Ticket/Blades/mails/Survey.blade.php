@component('mail::message')
# Introduction

Hi {{ $ticket->user->name }},

Thank you for creating a ticket into our platform.

We'd like to know your opinion about your experience.

@component('mail::button', ['url' => route('website.tickes.survey', $ticket->id)])
Rate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent