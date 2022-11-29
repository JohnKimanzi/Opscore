@component('mail::message')
# Employees whose contracts expiry is on the clock!
<br>

Hello HR Management, 
<br>
<br>
Here is a table for employees whose contract will come to an end next month: 

@component('mail::table')
| Name       | SAP         | Contract Expiry Date         |

| :--------- | :------------- |


| {{$emp->name}} | {{$emp->sap}} | {{$emp->contract_expiry}}

@endcomponent

Thanks,<br>
{{ config('app.name') }} Dev Team
@endcomponent
