@component('mail::message')
# Employee Account Credentials

Hello {{$first_name}},

Your account credentials have been approved. Here are your login details:

**Email:** {{$email}}

**Password:** {{ $password }}

Please use the above credentials to log in to our website.

Thank you.

Regards,
{{ config('app.name') }}
@endcomponent
