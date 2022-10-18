
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Qr Code') }}
            </h2>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 mx-auto">
                    {{ QrCode::color(22, 84, 193)
                            ->size(300)
                            ->style('round')
                            ->eye('circle')
                            ->eyeColor(0, 22, 84, 193, 56, 163, 7)
                            ->eyeColor(1, 22, 84, 193, 56, 163, 7)
                            ->eyeColor(2, 22, 84, 193, 56, 163, 7)
                            ->errorCorrection('H')
                            // ->merge($img, .2)
                            ->generate('http://arasih.test/dashboard');}}
                </div>
            </div>
        </div>
    </div>
                {{-- <img src="{{ asset('storage/logo/logo-bontang.png') }}" alt="" title=""> --}}
                {{-- @php
                    $img = asset('storage/logo/logo-bontang.png');
                @endphp --}}

                {{-- <a href="http://arasih.test/dashboard">http://arasih.test/dashboard</a> --}}
                {{-- {{ QrCode::size(300)
                    ->generate('https://techvblogs.com/blog/generate-qr-code-laravel-9') }} --}}

        {{-- <div class="card">
            <div class="card-header">
                <h2>Color QR Code</h2>
            </div>
            <div class="card-body">
                {!! QrCode::size(300)->backgroundColor(255,90,0)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-9') !!}
            </div>
        </div> --}}
</x-app-layout>

