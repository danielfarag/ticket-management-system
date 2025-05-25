@component('mail::message')

<div>{!! $mail->body !!}</div>

Thanks,<br>
{{ config('app.name') }}
@endcomponent