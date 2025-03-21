@props(['messages'])

@if ($messages)
        @foreach ((array) $messages as $message)
            <span style="color:red; font-size:12px">{{ $message }}</span>
        @endforeach
@endif
