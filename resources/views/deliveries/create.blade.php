{{-- @php
    dd($Dv);
@endphp --}}
@extends('admin::layouts.app')

@section('content')
                <!-- form input pengiriman-->
				<div class="pd-20 card-box mb-30" id="form-box">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4 judul-form"></h4>{{--set judul form--}}
                    <p class="mb-30 ket-form"></p>{{--set keterangan form, +edit data {{nama_Pengantaran}} --}}
                </div>

            </div>
            <form name="input-Pengantaran" id="input-Pengantaran" method="POST" action="{{route('deliveries.update', $Dv->id)}}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Penerima</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" type="text" readonly value="{{ $Dv->Penerima->nama }}">
                    </div>
                </div>
                <input class="form-control" type="hidden" name="penerima" id="penerima" value="10"/>
                <input class="form-control" type="hidden" id="menu" name="menu" value="{{$Dv->menu}}"/>
                <input class="form-control" type="hidden" id="pengantar" name="pengantar" value="{{$Dv->pengantar}}"/>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Status Pengantaran</label>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="Belum_diantar" name="status" class="custom-control-input" value="Belum diantar" />
                        <label class="custom-control-label" for="Belum_diantar">Belum Diantarkan.</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="Sudah_diantar" name="status" class="custom-control-input" value="Sudah diantar" checked="checked" />
                        <label class="custom-control-label" for="Sudah_diantar">Sudah Diantarkan.</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Pengaduan</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" type="text" placeholder="Pengaduan terkait menu" id="pengaduan" name="pengaduan"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Dokumentasi Pengantaran</label>
                    <div class="custom-file col-sm-12 col-md-10">
                        <input type="file" class="form-control-file form-control height-auto" name="dok" id="dok" accept="image/*" capture/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Total konsumsi karbohidrat</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" id="karbo_consmd" name="karbo_consmd" value="0.5" step="0.25" type="range" min="0" max="1" oninput="this.nextElementSibling.value = this.value">
                        <output></output>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Total konsumsi Protein Hewani</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" id="l_hwn_consmd" name="l_hwn_consmd" value="0.5" step="0.25" type="range" min="0" max="1" oninput="this.nextElementSibling.value = this.value">
                        <output></output>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Total konsumsi Protein Nabati</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" id="l_nbt_consmd" name="l_nbt_consmd" value="0.5" step="0.25" type="range" min="0" max="1" oninput="this.nextElementSibling.value = this.value">
                        <output></output>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Total konsumsi Sayur</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" id="sayur_consmd" name="sayur_consmd" value="0.5" step="0.25" type="range" min="0" max="1" oninput="this.nextElementSibling.value = this.value">
                        <output></output>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Total konsumsi Buah</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" id="buah_consmd" name="buah_consmd" value="0.5" step="0.25" type="range" min="0" max="1" oninput="this.nextElementSibling.value = this.value">
                        <output></output>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-10 col-sm-12"></div>
                    <div class="col-md-2 col-sm-12">
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </div>
                </div>
            </form>

        </div>
				<!-- akhir form input penerima -->

@endsection
@section('custom-scripts')
@include('peta.index')
@endsection
