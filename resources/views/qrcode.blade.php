<!DOCTYPE html>
<head>
    <title>Kartu Kode Qr Penerima</title>
</head>
<body class="aligncenter">
    <div>
            <h1 style="color: rgba(55,65,81,1);text-align: center;">Kode QR</h1>
    </div>

    <div style="text-align: center;background-color: rgba(255,255,255);">
        <div>
            <h3 style="font-weight: 700;font-size: 1.5rem;line-height: 2rem;">Nama :{{$nama}}</h3>
            <p style="color: rgba(75,85,99,1);">Menerima Sejak : {{$sejak}}</p>
        </div>

        <div style="text-align: center;"><img style="width: 14rem" src="{{asset('storage/'.$data)}}"></div>
        {{-- <div class="aligncenter" style="display: flex;justify-content: center;">
            <img style="width: 14rem" src="{{asset('storage/logo/logo-bontang.png')}}" alt="">
            {{-- <img src="{{asset('storage/'.$data)}}" alt="">--}
        </div> --}}
    </div>
</body>
</html>
