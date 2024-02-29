@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{-- $slot --}} {{-- slot traz a palavra do app name la no env --}}
<img src="{{asset('images/recuperar-senha.png')}}" alt="">
@endif
</a>
</td>
</tr>
