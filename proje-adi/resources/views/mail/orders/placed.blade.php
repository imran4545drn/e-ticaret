<x-mail::message>
# sipariş başarılı


siparişiniz için teşekkürler. senin sipariş numaran : {{$order->id}}.

<x-mail::button :url="$url">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
