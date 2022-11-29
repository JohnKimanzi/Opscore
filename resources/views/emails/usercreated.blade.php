@component('mail::message')
# Welcome to Opscore!

Your account has been successfully created! Remember to change your password upon first login!

Here are your Login Details: <br>
Email: {{$recipient->email}} <br>
Password: TBL@2022

@component('mail::button', ['url' => config("app.url")])
Go to Opscore
@endcomponent

Thanks,<br>
{{ config('app.name') }} Dev Team
@endcomponent
