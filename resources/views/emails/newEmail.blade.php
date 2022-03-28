@component('mail::message')
<!-- # Introduction -->

@component('mail::panel')
Salut {{$profile->prenom}} {{$profile->nom}},<br>
{{$email->body}}
@endcomponent

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

<!-- Thanks,<br> -->
{{ config('app.name') }}
@endcomponent
