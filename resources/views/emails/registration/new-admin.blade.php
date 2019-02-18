@component('mail::message')

<p>Hi Admin {{ $tempAccount->first_name }},</p>

<p>Verify your account by click the button below!</p>

@component('mail::button', [
    'url' => route('verify.edit', [
        'token' => $tempAccount->verification_token
    ])
])
Verify Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
