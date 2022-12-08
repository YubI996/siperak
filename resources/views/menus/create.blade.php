@extends('admin::layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <style>
        .leaflet-container{
            height: 73.5vh;
                width: 90vw;
                max-width: 101%;
                max-height: 100%;
                z-index: 1;
                /* padding-left: 82vw */
        }
    </style>
@endsection

@section('content')
                <!-- form input penerima-->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Input Data Penerima</h4>
							<p class="mb-30">Mengajukan penerima Rantang Kasih</p>
						</div>

					</div>
					<form name="input-penerima" id="input-penerima" method="POST" action="{{route('recipients.store')}}">
                        @csrf
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Nama Lengkap</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Nama Lengkap" id="nama" name="nama"/>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Tanggal Lahir</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control " placeholder="Pilih tanggal lahir" type="date" name="bd"/>
							</div>
						</div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Jenis Kelamin</label>
									<div class="custom-control custom-radio mb-5">
										<input type="radio" id="jk1" name="jenkel"
											class="custom-control-input" value="Laki-laki" />
										<label class="custom-control-label" for="jk1">Laki-laki</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input type="radio" id="jk2" name="jenkel"
											class="custom-control-input" value="Perempuan" />
										<label class="custom-control-label" for="jk2">Perempuan</label>
									</div>
                        </div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Nomor Induk Kependudukan (NIK)</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Nomor Induk Kependudukan(NIK)" id="nik" name="nik"/>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Alamat</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Alamat" id="alamat" name="alamat"/>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Pekerjaan</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Pekerjaan" id="pekerjaan" name="pekerjaan"/>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Penyakit</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Penyakit" id="penyakit" name="penyakit"/>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Kecamatan</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select" name="kec">
									<option selected="0">Pilih Kecamatan...</option>
                                    @forelse ($kecs as $dc)
									<option value="{{$dc->id}}">Kecamatan {{$dc->nama_kec}}</option>
                                    @empty
									<option value="">Data Kecamatan tidak ditemukan</option>
                                    @endforelse
								</select>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Kelurahan</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12" name="kel">
									<option selected="0">Pilih Kelurahan...</option>
                                    @forelse ($kels as $dl)
									<option value="{{$dl->id}}">Kelurahan {{$dl->nama_kel}}</option>
                                    @empty
									<option value="">Data Kelurahan tidak ditemukan</option>
                                    @endforelse
								</select>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Rukun Tetangga (RT)</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12" name="rt">
									<option selected="0">Pilih Rukun Tetangga(RT)...</option>
                                    @forelse ($rts as $dr)
									<option value="{{$dr->id}}">Rukun Tetangga(RT) {{$dr->nama_rt}}</option>
                                    @empty
									<option value="">Data Rukun Tetangga(RT) tidak ditemukan</option>
                                    @endforelse
								</select>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Nomor Handphone</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Nomor handphone" id="hp" name="no_hp"/>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Foto Penerima</label>
                            <div class="custom-file col-sm-12 col-md-10">
                                <input type="file" class="form-control-file form-control height-auto" name="foto_penerima" />
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Foto Kartu Tanda Penduduk</label>
                            <div class="custom-file col-sm-12 col-md-10">
                                <input type="file" class="form-control-file form-control height-auto" name="foto_ktp" />
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Foto Kartu Keluarga</label>
                            <div class="custom-file col-sm-12 col-md-10">
                                <input type="file" class="form-control-file form-control height-auto" name="foto_kk" />
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Foto Rumah/Tempat Tinggal</label>
                            <div class="custom-file col-sm-12 col-md-10">
                                <input type="file" class="form-control-file form-control height-auto" name="foto_rumah" />
							</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Status Kepemilikan Tempat Tinggal</label>
									<div class="custom-control custom-radio mb-5">
										<input type="radio" id="tmpt1" name="status_rumah"
											class="custom-control-input" value="Milik Sendiri" />
										<label class="custom-control-label" for="tmpt1">Milik Sendiri</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input type="radio" id="tmpt2" name="status_rumah"
											class="custom-control-input" value="Mengontrak/Menyewa" />
										<label class="custom-control-label" for="tmpt2">Mengontrak/Menyewa</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input type="radio" id="tmpt3" name="status_rumah"
											class="custom-control-input" value="Menumpang" />
										<label class="custom-control-label" for="tmpt3">Menumpang</label>
									</div>
                        </div>
                        <div class="form-group row ">
							<label class="col-sm-12 col-md-2 col-form-label">Koordinat Rumah Penerima</label>
                            <div class="col-sm-12 col-md-10 ">
                                <div id="map"></div>
								<input class="form-control" type="hidden" id="long" name="long"/>
								<input class="form-control" type="hidden" id="lat" name="lat" />
								<input class="form-control" type="hidden" id="lat" name="actor"  value="{{Auth::user()->id}}"/>
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Alasan Pengajuan</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Isi alasan pengajuan" id="alasan" name="alasan"/>
							</div>
						</div>

                        <div class="form-group row pull-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
				<!-- akhir form input penerima -->

@endsection
@section('custom-scripts')
@include('peta.index')
@endsection
