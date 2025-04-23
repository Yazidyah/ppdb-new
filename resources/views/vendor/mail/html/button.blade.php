@props([
    'url',
    'color' => 'tertiary',
    'align' => 'center',
])
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<a href="{{ $url }}" class="button button-{{ $color }}" target="_blank" rel="noopener" style="color: white; text-decoration: none; background-color: #28a745; padding: 12px 24px; border-radius: 6px; font-weight: bold; font-family: sans-serif;">
    {{ $slot }}
</a>

</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
