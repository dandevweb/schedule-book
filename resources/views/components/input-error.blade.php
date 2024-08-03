@props(['messages' => null, 'for' => null])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-danger mb-0']) }}>
        {{ $message }}</p>
@enderror

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-danger']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
