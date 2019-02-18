@component('mail::message')

<p>Hi Teacher {{ $tempAccount->first_name }},</p>

<p>Verify your account by click the button below!</p>

@component('mail::button', [
    'url' => route('teacher-registration.edit', [
        'token' => $tempAccount->verification_token
    ])
])
Verify Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
