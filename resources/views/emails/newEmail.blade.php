@component('mail::message')
<!-- # Introduction -->


Salut {{$profile->prenom}} {{$profile->nom}},<br>
{{$email->body}}
<!--@ component('mail::panel')@ endcomponent-->

<!--@ component('mail::button', ['url' => ''])
Button Text
@ endcomponent-->

<!-- Thanks,<br> -->
{{ config('app.name') }}
@endcomponent
