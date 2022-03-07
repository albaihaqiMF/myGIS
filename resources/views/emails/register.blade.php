@component('mail::message')
# A user account has been created or modified

User name: {{ $email ?? 'example@example.com' }} <br>
Temporary password: {{ $password ?? 'xxxPASSWORDxxx' }}

<br><br>
Here's what to do next:
<ul>
    <li style="color: red; font-weight: 500;">Don't give this access to anyone.</li>
    <li>
        Please sign in with email and password which already given
    </li>
</ul>


@component('mail::button', ['url' => env('APP_URL')])
Sign In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
