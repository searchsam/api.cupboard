@component('mail::message')
# New Order Created

New Order `{{ $order->name }}` created.
You can start requesting now.
The order expires on _{{ $order->deadline }}_.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
