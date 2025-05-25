@component('mail::message')
    @isset($template)
        {!! $template !!}
    @else
        {{ $slot }}
    @endif
@endcomponent