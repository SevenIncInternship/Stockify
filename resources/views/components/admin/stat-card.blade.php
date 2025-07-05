@props([
    'title' => 'Judul',
    'value' => 0,
    'color' => 'gray', // hanya warna dasar: gray, blue, red, dst.
    'icon' => null
])

<div class="bg-white shadow rounded-xl p-4 flex flex-col justify-between">
    <h3 class="text-sm font-medium text-gray-600 mb-2">{{ $title }}</h3>
    <div class="flex items-center justify-between">
        <p class="text-2xl font-bold text-{{ $color }}-600">{{ $value }}</p>
        @if ($icon)
            <div class="text-3xl text-{{ $color }}-500">
                {!! $icon !!}
            </div>
        @endif
    </div>
</div>
