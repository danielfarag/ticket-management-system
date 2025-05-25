@component('interactions::mailTemplate',['template' => $htmlTemplate])
# Introduction

Hi {{ $ticket->user->name }},

Ticket Created.

@component('mail::button', ['url' => route('website.tickets.show', $ticket->id)])
Ticket
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent