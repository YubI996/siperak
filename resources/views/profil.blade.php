
<!-- resources/views/recipients/show.blade.php -->
@extends('admin::layouts.app')

@section('content')
    @foreach ($data as $item)
    {{-- @php
    dd($data->nama);
@endphp --}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"> <strong> Penerima Rantang Kasih : </strong>{{ $item->nama }}</div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                @if (!empty($item->foto_penerima) && file_exists('storage/foto_penerima/'.$item->foto_penerima))
                                    <img src="{{ asset('storage/foto_penerima/'.$item->foto_penerima) }}" alt="{{ $item->nama }}" class="img-fluid">
                                @else
                                    <img src="{{ asset('admin/vendors/images/img404.gif') }}" alt="Prepared" class="img-fluid">
                                @endif
                            </div>
                                <div class="col-md-8">
                                    <p><strong>Jenis Kelamin:</strong> {{ $item->jenkel }}</p>
                                    <p><strong>Alamat:</strong> {{ $item->alamat }}</p>
                                    <p><strong>Penyakit:</strong> {{ $item->penyakit }}</p>
                                    <p><strong>Status Rumah:</strong> {{ $item->status_rumah }}</p>
                                    <p><strong>Status Terima:</strong> {{ $item->status_trima }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
