@props(
    [
        "text" => 'OK',
        'type'
    ]
)

<button type="{{ $type }}">
    {{ $text }}
</button>