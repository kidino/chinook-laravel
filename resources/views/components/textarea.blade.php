@props(['disabled' => false])

<textarea  @disabled($disabled) 
{{ $attributes->merge(['class' => 'textarea textarea-bordered']) }}
>{{ $slot }}</textarea>