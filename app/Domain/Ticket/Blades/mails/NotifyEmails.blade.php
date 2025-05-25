@component('mail::message')
# Introduction

New Ticket Created.

@component('mail::button', ['url' => route('tickets.show', $ticket->id)])
Ticket
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent