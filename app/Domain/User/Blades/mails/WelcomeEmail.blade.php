@component('interactions::mailTemplate',['template' => $htmlTemplate])
# Introduction

Hi {{ $user->name }},

Welcome To Our Website.

@component('mail::button', ['url' => ''])
Profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent