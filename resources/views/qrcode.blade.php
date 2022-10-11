<html>

<head>
    <meta charset="utf-8">
    <title>SiPerak</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>

<body>

    <div class="container mt-4">

        <div class="card">
            <div class="card-header">
                <h2>SiPerak</h2>
            </div>
            <div class="card-body">
                {{-- <img src="{{ asset('storage/logo/logo-bontang.png') }}" alt="" title=""> --}}
                @php
                    $img = asset('storage/logo/logo-bontang.png');
                @endphp
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
                <a href="http://arasih.test/dashboard">http://arasih.test/dashboard</a>
                {{-- {{ QrCode::size(300)
                    ->generate('https://techvblogs.com/blog/generate-qr-code-laravel-9') }} --}}
            </div>
        </div>

        {{-- <div class="card">
            <div class="card-header">
                <h2>Color QR Code</h2>
            </div>
            <div class="card-body">
                {!! QrCode::size(300)->backgroundColor(255,90,0)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-9') !!}
            </div>
        </div> --}}

    </div>
</body>
</html>
