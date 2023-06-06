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
					<form name="input-penerima" method="POST" action="{{url('recipients')}}">
                        @csrf
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Nama Lengkap</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Nama Lengkap" id="nama" />
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Tanggal Lahir</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control date-picker" placeholder="Pilih tanggal lahir" type="text" name="bd"/>
							</div>
						</div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Jenis Kelamin</label>
									<div class="custom-control custom-radio mb-5">
										<input type="radio" id="jk1" name="jk"
											class="custom-control-input" value="Laki-laki" />
										<label class="custom-control-label" for="jk1">Laki-laki</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input type="radio" id="jk2" name="jk"
											class="custom-control-input" value="Perempuan" />
										<label class="custom-control-label" for="jk2">Perempuan</label>
									</div>
                        </div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Nomor Induk Kependudukan (NIK)</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Nomor Induk Kependudukan(NIK)" id="nik" />
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Alamat</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Alamat" id="alamat" />
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Pekerjaan</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Pekerjaan" id="pekerjaan" />
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Penyakit</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Penyakit" id="penyakit" />
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Kecamatan</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select" name="kec">
									<option selected="0">Pilih Kecamatan...</option>
									<option value="1">Kecamatan Bontang Utara</option>
									<option value="2">Kecamatan Bontang Barat</option>
									<option value="3">Kecamatan Bontang Selatan</option>
								</select>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Kelurahan</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12" name="kel">
									<option selected="0">Pilih Kelurahan...</option>
									<option value="1">Kelurahan Bontang Kuala</option>
									<option value="2">Kelurahan Belimbing</option>
									<option value="3">Kelurahan Bontang Lestari</option>
								</select>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Rukun Tetangga (RT)</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12" name="rt">
									<option selected="0">Pilih Rukun Tetangga(RT)...</option>
									<option value="1">Rukun Tetangga(RT) 1</option>
									<option value="2">Rukun Tetangga(RT) 2</option>
									<option value="3">Rukun Tetangga(RT) 3</option>
								</select>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Nomor Handphone</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="number" placeholder="Nomor handphone" id="hp" />
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Foto Penerima</label>
                            <div class="custom-file col-sm-12 col-md-10">
                                <input type="file" class="form-control-file form-control height-auto" name="ft" />
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Foto Kartu Tanda Penduduk</label>
                            <div class="custom-file col-sm-12 col-md-10">
                                <input type="file" class="form-control-file form-control height-auto" name="ft_ktp" />
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Foto Kartu Keluarga</label>
                            <div class="custom-file col-sm-12 col-md-10">
                                <input type="file" class="form-control-file form-control height-auto" name="ft_kk" />
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Foto Rumah/Tempat Tinggal</label>
                            <div class="custom-file col-sm-12 col-md-10">
                                <input type="file" class="form-control-file form-control height-auto" name="ft_rmh" />
							</div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Status Kepemilikan Tempat Tinggal</label>
									<div class="custom-control custom-radio mb-5">
										<input type="radio" id="tmpt1" name="tmpt"
											class="custom-control-input" value="Milik Sendiri" />
										<label class="custom-control-label" for="tmpt1">Milik Sendiri</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input type="radio" id="tmpt2" name="tmpt"
											class="custom-control-input" value="Menyewa/Mengontrak" />
										<label class="custom-control-label" for="tmpt2">Menyewa/Mengontrak</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input type="radio" id="tmpt3" name="tmpt"
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
							</div>
                        </div>
                        <div class="form-group row ">
                            <button type="button" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
				<!-- akhir form input penerima -->
                <!-- Default Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Default Basic Forms</h4>
							<p class="mb-30">All bootstrap element classies</p>
						</div>
						<div class="pull-right">
							<a href="#basic-form1" class="btn btn-primary btn-sm scroll-click" rel="content-y"
								data-toggle="collapse" role="button"><i class="fa fa-code"></i> Source Code</a>
						</div>
					</div>
					<form>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Text</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Johnny Brown" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Search</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" placeholder="Search Here" type="search" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Email</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" value="bootstrap@example.com" type="email" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">URL</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" value="https://getbootstrap.com" type="url" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Telephone</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" value="1-(111)-111-1111" type="tel" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Password</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" value="password" type="password" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Number</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" value="100" type="number" />
							</div>
						</div>
						<div class="form-group row">
							<label for="example-datetime-local-input" class="col-sm-12 col-md-2 col-form-label">Date and
								time</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control datetimepicker" placeholder="Choose Date anf time"
									type="text" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Date</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control date-picker" placeholder="Select Date" type="text" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Month</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control month-picker" placeholder="Select Month" type="text" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Time</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control time-picker" placeholder="Select time" type="text" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Select</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12">
									<option selected="">Choose...</option>
									<option value="1">One</option>
									<option value="2">Two</option>
									<option value="3">Three</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Color</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" value="#563d7c" type="color" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Input Range</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" value="50" type="range" />
							</div>
						</div>
					</form>
					<div class="collapse collapse-box" id="basic-form1">
						<div class="code-box">
							<div class="clearfix">
								<a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left"
									data-clipboard-target="#copy-pre"><i class="fa fa-clipboard"></i> Copy Code</a>
								<a href="#basic-form1" class="btn btn-primary btn-sm pull-right" rel="content-y"
									data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
							</div>
							<pre><code class="xml copy-pre" id="copy-pre">
                            <form>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Text</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control" type="text" placeholder="Johnny Brown">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Search</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control" placeholder="Search Here" type="search">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control" value="bootstrap@example.com" type="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">URL</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control" value="https://getbootstrap.com" type="url">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Telephone</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control" value="1-(111)-111-1111" type="tel">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Password</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control" value="password" type="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Number</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control" value="100" type="number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-datetime-local-input" class="col-sm-12 col-md-2 col-form-label">Date and time</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control datetimepicker" placeholder="Choose Date anf time" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Date</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control date-picker" placeholder="Select Date" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Month</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control month-picker" placeholder="Select Month" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Time</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control time-picker" placeholder="Select time" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Select</label>
                                    <div class="col-sm-12 col-md-10">
                                        <select class="custom-select col-12">
                                            <option selected="">Choose...</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Color</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control" value="#563d7c" type="color">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Input Range</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control" value="50" type="range">
                                    </div>
                                </div>
                            </form>
							</code></pre>
						</div>
					</div>
				</div>
				<!-- Default Basic Forms End -->

				<!-- horizontal Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">horizontal Basic Forms</h4>
							<p class="mb-30">All bootstrap element classies</p>
						</div>
						<div class="pull-right">
							<a href="#horizontal-basic-form1" class="btn btn-primary btn-sm scroll-click"
								rel="content-y" data-toggle="collapse" role="button"><i class="fa fa-code"></i> Source
								Code</a>
						</div>
					</div>
					<form>
						<div class="form-group">
							<label>Text</label>
							<input class="form-control" type="text" placeholder="Johnny Brown" />
						</div>
						<div class="form-group">
							<label>Email</label>
							<input class="form-control" value="bootstrap@example.com" type="email" />
						</div>
						<div class="form-group">
							<label>URL</label>
							<input class="form-control" value="https://getbootstrap.com" type="url" />
						</div>
						<div class="form-group">
							<label>Telephone</label>
							<input class="form-control" value="1-(111)-111-1111" type="tel" />
						</div>
						<div class="form-group">
							<label>Password</label>
							<input class="form-control" value="password" type="password" />
						</div>
						<div class="form-group">
							<label>Readonly input</label>
							<input class="form-control" type="text" placeholder="Readonly input here…" readonly />
						</div>
						<div class="form-group">
							<label>Disabled input</label>
							<input type="text" class="form-control" placeholder="Disabled input" disabled="" />
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<label class="weight-600">Custom Checkbox</label>
									<div class="custom-control custom-checkbox mb-5">
										<input type="checkbox" class="custom-control-input" id="customCheck1" />
										<label class="custom-control-label" for="customCheck1">Check this custom
											checkbox</label>
									</div>
									<div class="custom-control custom-checkbox mb-5">
										<input type="checkbox" class="custom-control-input" id="customCheck2" />
										<label class="custom-control-label" for="customCheck2">Check this custom
											checkbox</label>
									</div>
									<div class="custom-control custom-checkbox mb-5">
										<input type="checkbox" class="custom-control-input" id="customCheck3" />
										<label class="custom-control-label" for="customCheck3">Check this custom
											checkbox</label>
									</div>
									<div class="custom-control custom-checkbox mb-5">
										<input type="checkbox" class="custom-control-input" id="customCheck4" />
										<label class="custom-control-label" for="customCheck4">Check this custom
											checkbox</label>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<label class="weight-600">Custom Radio</label>
									<div class="custom-control custom-radio mb-5">
										<input type="radio" id="customRadio1" name="customRadio"
											class="custom-control-input" />
										<label class="custom-control-label" for="customRadio1">Toggle this custom
											radio</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input type="radio" id="customRadio2" name="customRadio"
											class="custom-control-input" />
										<label class="custom-control-label" for="customRadio2">Or toggle this other
											custom radio</label>
									</div>
									<div class="custom-control custom-radio mb-5">
										<input type="radio" id="customRadio3" name="customRadio"
											class="custom-control-input" />
										<label class="custom-control-label" for="customRadio3">Or toggle this other
											custom radio</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Disabled select menu</label>
							<select class="form-control" disabled="">
								<option>Disabled select</option>
							</select>
						</div>
						<div class="form-group">
							<label>input plaintext</label>
							<input type="text" readonly class="form-control-plaintext" value="email@example.com" />
						</div>
						<div class="form-group">
							<label>Textarea</label>
							<textarea class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label>Help text</label>
							<input type="text" class="form-control" />
							<small class="form-text text-muted">
								Your password must be 8-20 characters long, contain letters
								and numbers, and must not contain spaces, special characters,
								or emoji.
							</small>
						</div>
						<div class="form-group">
							<label>Example file input</label>
							<input type="file" class="form-control-file form-control height-auto" />
						</div>
						<div class="form-group">
							<label>Custom file input</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" />
								<label class="custom-file-label">Choose file</label>
							</div>
						</div>
					</form>
					<div class="collapse collapse-box" id="horizontal-basic-form1">
						<div class="code-box">
							<div class="clearfix">
								<a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left"
									data-clipboard-target="#horizontal-basic"><i class="fa fa-clipboard"></i> Copy
									Code</a>
								<a href="#horizontal-basic-form1" class="btn btn-primary btn-sm pull-right"
									rel="content-y" data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i>
									Hide Code</a>
							</div>
							<pre><code class="xml copy-pre" id="horizontal-basic">
                            <form>
                                <div class="form-group">
                                    <label>Text</label>
                                    <input class="form-control" type="text" placeholder="Johnny Brown">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" value="bootstrap@example.com" type="email">
                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <input class="form-control" value="https://getbootstrap.com" type="url">
                                </div>
                                <div class="form-group">
                                    <label>Telephone</label>
                                    <input class="form-control" value="1-(111)-111-1111" type="tel">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" value="password" type="password">
                                </div>
                                <div class="form-group">
                                    <label>Readonly input</label>
                                    <input class="form-control" type="text" placeholder="Readonly input here…" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Disabled input</label>
                                    <input type="text" class="form-control" placeholder="Disabled input" disabled="">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label class="weight-600">Custom Checkbox</label>
                                            <div class="custom-control custom-checkbox mb-5">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1-1">
                                                <label class="custom-control-label" for="customCheck1-1">Check this custom checkbox</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-5">
                                                <input type="checkbox" class="custom-control-input" id="customCheck2-1">
                                                <label class="custom-control-label" for="customCheck2-1">Check this custom checkbox</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-5">
                                                <input type="checkbox" class="custom-control-input" id="customCheck3-1">
                                                <label class="custom-control-label" for="customCheck3-1">Check this custom checkbox</label>
                                            </div>
                                            <div class="custom-control custom-checkbox mb-5">
                                                <input type="checkbox" class="custom-control-input" id="customCheck4-1">
                                                <label class="custom-control-label" for="customCheck4-1">Check this custom checkbox</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label class="weight-600">Custom Radio</label>
                                            <div class="custom-control custom-radio mb-5">
                                                <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio4">Toggle this custom radio</label>
                                            </div>
                                            <div class="custom-control custom-radio mb-5">
                                                <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio5">Or toggle this other custom radio</label>
                                            </div>
                                            <div class="custom-control custom-radio mb-5">
                                                <input type="radio" id="customRadio6" name="customRadio" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio6">Or toggle this other custom radio</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Disabled select menu</label>
                                    <select class="form-control" disabled="">
                                        <option>Disabled select</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>input plaintext</label>
                                    <input type="text" readonly class="form-control-plaintext" value="email@example.com">
                                </div>
                                <div class="form-group">
                                    <label>Textarea</label>
                                    <textarea class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Help text</label>
                                    <input type="text" class="form-control">
                                    <small class="form-text text-muted">
                                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label>Example file input</label>
                                    <input type="file" class="form-control-file form-control height-auto">
                                </div>
                                <div class="form-group">
                                    <label>Custom file input</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </form>

                            </code></pre>
						</div>
					</div>
				</div>
				<!-- horizontal Basic Forms End -->

				<!-- Form grid Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Form grid</h4>
							<p class="mb-30">All bootstrap element classies</p>
						</div>
						<div class="pull-right">
							<a href="#form-grid-form" class="btn btn-primary btn-sm scroll-click" rel="content-y"
								data-toggle="collapse" role="button"><i class="fa fa-code"></i> Source Code</a>
						</div>
					</div>
					<form>
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label>col-md-4</label>
									<input type="text" class="form-control" />
								</div>
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label>col-md-4</label>
									<input type="text" class="form-control" />
								</div>
							</div>
							<div class="col-md-4 col-sm-12">
								<div class="form-group">
									<label>col-md-4</label>
									<input type="text" class="form-control" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 col-sm-12">
								<div class="form-group">
									<label>col-md-3</label>
									<input type="text" class="form-control" />
								</div>
							</div>
							<div class="col-md-3 col-sm-12">
								<div class="form-group">
									<label>col-md-3</label>
									<input type="text" class="form-control" />
								</div>
							</div>
							<div class="col-md-3 col-sm-12">
								<div class="form-group">
									<label>col-md-3</label>
									<input type="text" class="form-control" />
								</div>
							</div>
							<div class="col-md-3 col-sm-12">
								<div class="form-group">
									<label>col-md-3</label>
									<input type="text" class="form-control" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>col-md-6</label>
									<input type="text" class="form-control" />
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>col-md-6</label>
									<input type="text" class="form-control" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>col-md-6</label>
									<input type="text" class="form-control" />
								</div>
							</div>
							<div class="col-md-3 col-sm-12">
								<div class="form-group">
									<label>col-md-3</label>
									<input type="text" class="form-control" />
								</div>
							</div>
							<div class="col-md-3 col-sm-12">
								<div class="form-group">
									<label>col-md-3</label>
									<input type="text" class="form-control" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="form-group">
									<label>col-md-12</label>
									<input type="text" class="form-control" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 col-sm-12">
								<div class="form-group">
									<label>col-md-2</label>
									<input type="text" class="form-control" />
								</div>
							</div>
							<div class="col-md-2 col-sm-12">
								<div class="form-group">
									<label>col-md-2</label>
									<input type="text" class="form-control" />
								</div>
							</div>
							<div class="col-md-2 col-sm-12">
								<div class="form-group">
									<label>col-md-2</label>
									<input type="text" class="form-control" />
								</div>
							</div>
							<div class="col-md-2 col-sm-12">
								<div class="form-group">
									<label>col-md-2</label>
									<input type="text" class="form-control" />
								</div>
							</div>
							<div class="col-md-2 col-sm-12">
								<div class="form-group">
									<label>col-md-2</label>
									<input type="text" class="form-control" />
								</div>
							</div>
							<div class="col-md-2 col-sm-12">
								<div class="form-group">
									<label>col-md-2</label>
									<input type="text" class="form-control" />
								</div>
							</div>
						</div>
					</form>
					<div class="collapse collapse-box" id="form-grid-form">
						<div class="code-box">
							<div class="clearfix">
								<a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left"
									data-clipboard-target="#form-grid"><i class="fa fa-clipboard"></i> Copy Code</a>
								<a href="#form-grid-form" class="btn btn-primary btn-sm pull-right" rel="content-y"
									data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
							</div>
							<pre><code class="xml copy-pre" id="form-grid">
                                <form>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-4</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-4</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-4</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-3</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-3</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-3</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-3</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-6</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-6</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-6</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-3</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-3</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-12</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-2</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-2</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-2</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-2</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-2</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-12">
                                            <div class="form-group">
                                                <label>col-md-2</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </form>
							</code></pre>
						</div>
					</div>
				</div>
				<!-- Form grid End -->

				<!-- Input Validation Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Input Validation</h4>
							<p class="mb-30">
								Validation styles for error, warning, and success
							</p>
						</div>
						<div class="pull-right">
							<a href="#input-validation-form" class="btn btn-primary btn-sm scroll-click" rel="content-y"
								data-toggle="collapse" role="button"><i class="fa fa-code"></i> Source Code</a>
						</div>
					</div>
					<form>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group has-success">
									<label class="form-control-label">Input with success</label>
									<input type="text" class="form-control form-control-success" />
									<div class="form-control-feedback">
										Success! You've done it.
									</div>
									<small class="form-text text-muted">Example help text that remains
										unchanged.</small>
								</div>
								<div class="form-group has-warning">
									<label class="form-control-label">Input with warning</label>
									<input type="text" class="form-control form-control-warning" />
									<div class="form-control-feedback">
										Shucks, check the formatting of that and try again.
									</div>
									<small class="form-text text-muted">Example help text that remains
										unchanged.</small>
								</div>
								<div class="form-group has-danger">
									<label class="form-control-label">Input with danger</label>
									<input type="text" class="form-control form-control-danger" />
									<div class="form-control-feedback">
										Sorry, that username's taken. Try another?
									</div>
									<small class="form-text text-muted">Example help text that remains
										unchanged.</small>
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group has-success row">
									<label class="form-control-label col-sm-12 col-md-3 col-form-label">Input with
										success</label>
									<div class="col-sm-12 col-md-9">
										<input type="text" class="form-control form-control-success" />
										<div class="form-control-feedback">
											Success! You've done it.
										</div>
										<small class="form-text text-muted">Example help text that remains
											unchanged.</small>
									</div>
								</div>
								<div class="form-group has-warning row">
									<label class="form-control-label col-sm-12 col-md-3 col-form-label">Input with
										warning</label>
									<div class="col-sm-12 col-md-9">
										<input type="text" class="form-control form-control-warning" />
										<div class="form-control-feedback">
											Shucks, check the formatting of that and try again.
										</div>
										<small class="form-text text-muted">Example help text that remains
											unchanged.</small>
									</div>
								</div>
								<div class="form-group has-danger row">
									<label class="form-control-label col-sm-12 col-md-3 col-form-label">Input with
										danger</label>
									<div class="col-sm-12 col-md-9">
										<input type="text" class="form-control form-control-danger" />
										<div class="form-control-feedback">
											Sorry, that username's taken. Try another?
										</div>
										<small class="form-text text-muted">Example help text that remains
											unchanged.</small>
									</div>
								</div>
							</div>
						</div>
					</form>
					<div class="collapse collapse-box" id="input-validation-form">
						<div class="code-box">
							<div class="clearfix">
								<a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left"
									data-clipboard-target="#input-validation"><i class="fa fa-clipboard"></i> Copy
									Code</a>
								<a href="#input-validation-form" class="btn btn-primary btn-sm pull-right"
									rel="content-y" data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i>
									Hide Code</a>
							</div>
							<pre><code class="xml copy-pre" id="input-validation">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group has-success">
                                                <label class="form-control-label">Input with success</label>
                                                <input type="text" class="form-control form-control-success">
                                                <div class="form-control-feedback">Success! You've done it.</div>
                                                <small class="form-text text-muted">Example help text that remains unchanged.</small>
                                            </div>
                                            <div class="form-group has-warning">
                                                <label class="form-control-label">Input with warning</label>
                                                <input type="text" class="form-control form-control-warning">
                                                <div class="form-control-feedback">Shucks, check the formatting of that and try again.</div>
                                                <small class="form-text text-muted">Example help text that remains unchanged.</small>
                                            </div>
                                            <div class="form-group has-danger">
                                                <label class="form-control-label">Input with danger</label>
                                                <input type="text" class="form-control form-control-danger">
                                                <div class="form-control-feedback">Sorry, that username's taken. Try another?</div>
                                                <small class="form-text text-muted">Example help text that remains unchanged.</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group has-success row">
                                                <label class="form-control-label col-sm-12 col-md-2 col-form-label">Input with success</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input type="text" class="form-control form-control-success">
                                                    <div class="form-control-feedback">Success! You've done it.</div>
                                                    <small class="form-text text-muted">Example help text that remains unchanged.</small>
                                                </div>
                                            </div>
                                            <div class="form-group has-warning row">
                                                <label class="form-control-label col-sm-12 col-md-2 col-form-label">Input with warning</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input type="text" class="form-control form-control-warning">
                                                    <div class="form-control-feedback">Shucks, check the formatting of that and try again.</div>
                                                    <small class="form-text text-muted">Example help text that remains unchanged.</small>
                                                </div>
                                            </div>
                                            <div class="form-group has-danger row">
                                                <label class="form-control-label col-sm-12 col-md-2 col-form-label">Input with danger</label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input type="text" class="form-control form-control-danger">
                                                    <div class="form-control-feedback">Sorry, that username's taken. Try another?</div>
                                                    <small class="form-text text-muted">Example help text that remains unchanged.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
							</code></pre>
						</div>
					</div>
				</div>
				<!-- Input Validation End -->
@endsection
@section('custom-scripts')
<script>
	var map = L.map('map').fitWorld().setView([0.114627, 117.476463], 12);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
	var marker = L.marker([0.17473, 117.466164]).addTo(map)
	var marker = L.marker([0.10967, 117.453632]).addTo(map)
	var marker = L.marker([0.131299, 117.507019]).addTo(map)
	var marker = L.marker([0.094221, 117.457066]).addTo(map)
	var marker = L.marker([0.07551, 117.46891]).addTo(map)
		.bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();
	var circle = L.circle([ 0.134823, 117.45176], {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5,
		radius: 10
	}).addTo(map).bindPopup('I am a circle.');
	var polygon = L.polygon([
		[
        0.2056499, 117.5042725

      ],
      [
        0.1982685, 117.4924278

      ],
      [
        0.2017875, 117.4879217

      ],
      [
        0.199277, 117.4679446

      ],
      [
        0.1836344, 117.4687815

      ],
      [
        0.1757381, 117.4677515

      ],
      [
        0.1680992, 117.4504566

      ],
      [
        0.1671121, 117.4499416

      ],
      [
        0.1598165, 117.4461651

      ],
      [
        0.1584862, 117.4467015

      ],
      [
        0.1437663, 117.4415517

      ],
      [
        0.1389383, 117.4398994

      ],
      [
        0.1362668, 117.4392986

      ],
      [
        0.13543, 117.4393201

      ],
      [
        0.1317178, 117.437979

      ],
      [
        0.1311599, 117.4374962

      ],
      [
        0.1306771, 117.4371207

      ],
      [
        0.1299046, 117.4367988

      ],
      [
        0.1269435, 117.4359512

      ],
      [
        0.1216327, 117.4339664

      ],
      [
        0.1191973, 117.4323249

      ],
      [
        0.1139402, 117.4309516

      ],
      [
        0.111494, 117.4312842

      ],
      [
        0.1104426, 117.429986

      ],
      [
        0.1101851, 117.4296212

      ],
      [
        0.1088493, 117.4294764

      ],
      [
        0.1079749, 117.4291545

      ],
      [
        0.1074331, 117.4285859

      ],
      [
        0.1071059, 117.4284679

      ],
      [
        0.1063603, 117.4283499

      ],
      [
        0.1054751, 117.4278134

      ],
      [
        0.1048153, 117.4270999

      ],
      [
        0.1044666, 117.4263436

      ],
      [
        0.1038497, 117.4253297

      ],
      [
        0.1031523, 117.4249113

      ],
      [
        0.1020473, 117.4245358

      ],
      [
        0.0919246, 117.4027777

      ],
      [
        0.0799942, 117.3968983

      ],
      [
        0.0782776, 117.3964262

      ],
      [
        0.0763893, 117.3953104

      ],
      [
        0.0642872, 117.389946

      ],
      [
        0.0599956, 117.3895168

      ],
      [
        0.0554681, 117.3896456

      ],
      [
        0.0513911, 117.3895168

      ],
      [
        0.0496101, 117.3900533

      ],
      [
        0.0478077, 117.3902249

      ],
      [
        0.0460052, 117.3897743

      ],
      [
        0.042336, 117.3894525

      ],
      [
        0.0382805, 117.3895168

      ],
      [
        0.034976, 117.3896456

      ],
      [
        0.031414, 117.3891735

      ],
      [
        0.0275516, 117.3890018

      ],
      [
        0.0245047, 117.3887873

      ],
      [
        0.0240809, 117.3886102

      ],
      [
        0.0239468, 117.3896885

      ],
      [
        0.0240326, 117.3915982

      ],
      [
        0.0239253, 117.3931646

      ],
      [
        0.022316, 117.4781799

      ],
      [
        0.021801, 117.5163746

      ],
      [
        0.0261354, 117.5190139

      ],
      [
        0.0277233, 117.5165033

      ],
      [
        0.0292039, 117.5162888

      ],
      [
        0.0286889, 117.5143147

      ],
      [
        0.0289893, 117.5128126

      ],
      [
        0.031414, 117.5119972

      ],
      [
        0.0343966, 117.5135851

      ],
      [
        0.0346756, 117.5142932

      ],
      [
        0.0370574, 117.5147653

      ],
      [
        0.0374651, 117.5141215

      ],
      [
        0.036521, 117.5128126

      ],
      [
        0.0363493, 117.5106883

      ],
      [
        0.0358987, 117.5084782

      ],
      [
        0.0344181, 117.5036073

      ],
      [
        0.0358343, 117.5027704

      ],
      [
        0.038023, 117.5035429

      ],
      [
        0.0387311, 117.5015044

      ],
      [
        0.0356412, 117.4988651

      ],
      [
        0.03371, 117.4990582

      ],
      [
        0.0323367, 117.4974489

      ],
      [
        0.0301051, 117.4964404

      ],
      [
        0.0290108, 117.4931788

      ],
      [
        0.0296116, 117.4916983

      ],
      [
        0.030899, 117.4909687

      ],
      [
        0.0333667, 117.4904108

      ],
      [
        0.0369716, 117.492342

      ],
      [
        0.0374866, 117.4915266

      ],
      [
        0.0367355, 117.490046

      ],
      [
        0.038259, 117.4892306

      ],
      [
        0.0387096, 117.4903893

      ],
      [
        0.0396109, 117.4908185

      ],
      [
        0.0401258, 117.4897671

      ],
      [
        0.0422502, 117.4895096

      ],
      [
        0.0425935, 117.4896812

      ],
      [
        0.0427008, 117.4910975

      ],
      [
        0.0419068, 117.4937797

      ],
      [
        0.0426149, 117.4942517

      ],
      [
        0.0438595, 117.4934578

      ],
      [
        0.044117, 117.4935651

      ],
      [
        0.0453615, 117.4949169

      ],
      [
        0.0484514, 117.495153

      ],
      [
        0.0489879, 117.4956679

      ],
      [
        0.0495887, 117.4978781

      ],
      [
        0.0500607, 117.4988866

      ],
      [
        0.0509834, 117.4999166

      ],
      [
        0.0512624, 117.5005174

      ],
      [
        0.0512409, 117.5012469

      ],
      [
        0.0512624, 117.5019765

      ],
      [
        0.0510907, 117.503221

      ],
      [
        0.050919, 117.5042725

      ],
      [
        0.0497389, 117.5074053

      ],
      [
        0.0501895, 117.5089717

      ],
      [
        0.0504684, 117.5096583

      ],
      [
        0.050962, 117.5107312

      ],
      [
        0.0519705, 117.5116539

      ],
      [
        0.0531506, 117.5120401

      ],
      [
        0.0536871, 117.5120616

      ],
      [
        0.0543737, 117.5117612

      ],
      [
        0.0548887, 117.5116968

      ],
      [
        0.0555754, 117.511847

      ],
      [
        0.0569701, 117.512362

      ],
      [
        0.0580645, 117.5124478

      ],
      [
        0.0594592, 117.5118899

      ],
      [
        0.0612402, 117.510581

      ],
      [
        0.063858, 117.5091434

      ],
      [
        0.0630426, 117.5046587

      ],
      [
        0.0603175, 117.4990153

      ],
      [
        0.0596094, 117.496655

      ],
      [
        0.0602102, 117.4917197

      ],
      [
        0.0598025, 117.4908185

      ],
      [
        0.0574851, 117.4894452

      ],
      [
        0.0570774, 117.48878

      ],
      [
        0.0572276, 117.4880934

      ],
      [
        0.058794, 117.4873638

      ],
      [
        0.06109, 117.4887371

      ],
      [
        0.0621843, 117.4882865

      ],
      [
        0.0626564, 117.4879646

      ],
      [
        0.0631499, 117.487514

      ],
      [
        0.0632787, 117.486999

      ],
      [
        0.0629997, 117.4859691

      ],
      [
        0.0624633, 117.4843383

      ],
      [
        0.0609398, 117.4842525

      ],
      [
        0.0597811, 117.4846601

      ],
      [
        0.0566912, 117.4808192

      ],
      [
        0.0551248, 117.4802613

      ],
      [
        0.0533438, 117.4802184

      ],
      [
        0.0527215, 117.4798322

      ],
      [
        0.0508976, 117.4797034

      ],
      [
        0.0498891, 117.4788022

      ],
      [
        0.0479364, 117.4775147

      ],
      [
        0.0474858, 117.475841

      ],
      [
        0.0459838, 117.4748111

      ],
      [
        0.0459409, 117.4738884

      ],
      [
        0.0472283, 117.4724293

      ],
      [
        0.0475073, 117.4714422

      ],
      [
        0.0465631, 117.4698114

      ],
      [
        0.0462413, 117.4676228

      ],
      [
        0.0477219, 117.4686956

      ],
      [
        0.0477004, 117.4696398

      ],
      [
        0.049181, 117.4726868

      ],
      [
        0.0518203, 117.4729228

      ],
      [
        0.0524425, 117.473824

      ],
      [
        0.0546741, 117.4748325

      ],
      [
        0.0570559, 117.4750042

      ],
      [
        0.0585365, 117.474618

      ],
      [
        0.0590944, 117.4736953

      ],
      [
        0.0601458, 117.4736094

      ],
      [
        0.061841, 117.4757767

      ],
      [
        0.0621414, 117.4769568

      ],
      [
        0.0634289, 117.4773645

      ],
      [
        0.0643086, 117.4769139

      ],
      [
        0.064888, 117.4761629

      ],
      [
        0.065403, 117.4749398

      ],
      [
        0.0657034, 117.4724293

      ],
      [
        0.0664544, 117.4715495

      ],
      [
        0.0676775, 117.4714208

      ],
      [
        0.0678277, 117.4722362

      ],
      [
        0.0686645, 117.4722791

      ],
      [
        0.0691366, 117.4725795

      ],
      [
        0.0694156, 117.4730515

      ],
      [
        0.070939, 117.4735022

      ],
      [
        0.071454, 117.474575

      ],
      [
        0.0716471, 117.4753046

      ],
      [
        0.0716042, 117.4767852

      ],
      [
        0.0716471, 117.4777079

      ],
      [
        0.0726127, 117.4783087

      ],
      [
        0.0739217, 117.4776435

      ],
      [
        0.075767, 117.4783087

      ],
      [
        0.0776124, 117.4782443

      ],
      [
        0.0780201, 117.4778152

      ],
      [
        0.078063, 117.477107

      ],
      [
        0.0770759, 117.4754333

      ],
      [
        0.0773978, 117.474618

      ],
      [
        0.0783849, 117.4739099

      ],
      [
        0.0799727, 117.4737597

      ],
      [
        0.08111, 117.4747896

      ],
      [
        0.0819683, 117.4754763

      ],
      [
        0.0834703, 117.4755836

      ],
      [
        0.0840497, 117.4756265

      ],
      [
        0.0843715, 117.4759269

      ],
      [
        0.0845217, 117.4763775

      ],
      [
        0.0843072, 117.4764848

      ],
      [
        0.0837922, 117.4767637

      ],
      [
        0.0832557, 117.4770427

      ],
      [
        0.0834703, 117.4773645

      ],
      [
        0.0895214, 117.4747038

      ],
      [
        0.0897789, 117.4741244

      ],
      [
        0.0890493, 117.4739957

      ],
      [
        0.0885343, 117.4738669

      ],
      [
        0.0879979, 117.4724507

      ],
      [
        0.0878262, 117.4707341

      ],
      [
        0.0877618, 117.4692321

      ],
      [
        0.0858736, 117.4678588

      ],
      [
        0.0858092, 117.4676442

      ],
      [
        0.0875258, 117.4670005

      ],
      [
        0.0885772, 117.4665284

      ],
      [
        0.0896287, 117.4662066

      ],
      [
        0.0905084, 117.4660349

      ],
      [
        0.0924182, 117.4659705

      ],
      [
        0.0933194, 117.4655628

      ],
      [
        0.0944781, 117.4652624

      ],
      [
        0.096023, 117.4640393

      ],
      [
        0.097568, 117.4638891

      ],
      [
        0.0986409, 117.4628162

      ],
      [
        0.0988125, 117.46243

      ],
      [
        0.0986194, 117.461915

      ],
      [
        0.0979542, 117.4607992

      ],
      [
        0.098083, 117.4600482

      ],
      [
        0.0991988, 117.4588895

      ],
      [
        0.100336, 117.4578381

      ],
      [
        0.1019239, 117.4575591

      ],
      [
        0.1022243, 117.4580312

      ],
      [
        0.1007008, 117.4607134

      ],
      [
        0.1007437, 117.4613786

      ],
      [
        0.1013445, 117.4621296

      ],
      [
        0.1017254, 117.4623442

      ],
      [
        0.1022833, 117.4625695

      ],
      [
        0.1027446, 117.4626446

      ],
      [
        0.1033508, 117.4627841

      ],
      [
        0.1026588, 117.4630791

      ],
      [
        0.101087, 117.4632722

      ],
      [
        0.1001912, 117.4639106

      ],
      [
        0.0997942, 117.4644578

      ],
      [
        0.0989788, 117.4646777

      ],
      [
        0.0980669, 117.4655575

      ],
      [
        0.097348, 117.4656218

      ],
      [
        0.0966346, 117.4654716

      ],
      [
        0.0954705, 117.465477

      ],
      [
        0.0951862, 117.4664533

      ],
      [
        0.0942689, 117.4678051

      ],
      [
        0.0936412, 117.4682128

      ],
      [
        0.0930136, 117.4686688

      ],
      [
        0.0924718, 117.4693072

      ],
      [
        0.0921446, 117.4704069

      ],
      [
        0.092327, 117.4708039

      ],
      [
        0.091989, 117.4713886

      ],
      [
        0.0919836, 117.4715817

      ],
      [
        0.0920856, 117.4717534

      ],
      [
        0.0922358, 117.4717748

      ],
      [
        0.0923967, 117.4717373

      ],
      [
        0.0927507, 117.4712867

      ],
      [
        0.0934857, 117.4708682

      ],
      [
        0.0951808, 117.4689907

      ],
      [
        0.0954008, 117.4689156

      ],
      [
        0.0958085, 117.4688298

      ],
      [
        0.0960338, 117.468642

      ],
      [
        0.0973534, 117.4686366

      ],
      [
        0.0973588, 117.46876

      ],
      [
        0.097112, 117.4691945

      ],
      [
        0.0971657, 117.4696559

      ],
      [
        0.0973963, 117.4699616

      ],
      [
        0.0977289, 117.4710345

      ],
      [
        0.0972408, 117.4713081

      ],
      [
        0.0969028, 117.4716139

      ],
      [
        0.0957655, 117.4713081

      ],
      [
        0.0951808, 117.4713993

      ],
      [
        0.0949019, 117.4716246

      ],
      [
        0.0948858, 117.4722201

      ],
      [
        0.094285, 117.4725097

      ],
      [
        0.0939631, 117.4728799

      ],
      [
        0.0940114, 117.4733841

      ],
      [
        0.0941884, 117.4737167

      ],
      [
        0.0946497, 117.4738187

      ],
      [
        0.0967526, 117.4738294

      ],
      [
        0.0967526, 117.4739528

      ],
      [
        0.0964897, 117.4743283

      ],
      [
        0.0960016, 117.4748755

      ],
      [
        0.0958997, 117.4747896

      ],
      [
        0.0955241, 117.4751705

      ],
      [
        0.0956475, 117.4752939

      ],
      [
        0.0952398, 117.4756747

      ],
      [
        0.0924611, 117.4755728

      ],
      [
        0.0916993, 117.4757016

      ],
      [
        0.0901436, 117.4756104

      ],
      [
        0.0895911, 117.4756587

      ],
      [
        0.0819736, 117.4789631

      ],
      [
        0.0819415, 117.4790946

      ],
      [
        0.0819964, 117.4792756

      ],
      [
        0.0821346, 117.4795747

      ],
      [
        0.082215, 117.4795613

      ],
      [
        0.082376, 117.4799609

      ],
      [
        0.0824699, 117.4799395

      ],
      [
        0.0829205, 117.4824366

      ],
      [
        0.0826844, 117.4837267

      ],
      [
        0.0830841, 117.4840567

      ],
      [
        0.0839129, 117.4835122

      ],
      [
        0.0851896, 117.4845341

      ],
      [
        0.0847953, 117.4848559

      ],
      [
        0.0845539, 117.4850062

      ],
      [
        0.0844386, 117.4852315

      ],
      [
        0.0841275, 117.4860898

      ],
      [
        0.0841704, 117.4861783

      ],
      [
        0.083709, 117.4864304

      ],
      [
        0.0836956, 117.4864063

      ],
      [
        0.0835588, 117.4864653

      ],
      [
        0.0834864, 117.4863499

      ],
      [
        0.0833791, 117.4864009

      ],
      [
        0.0834167, 117.4865189

      ],
      [
        0.0836822, 117.4870473

      ],
      [
        0.0838378, 117.486999

      ],
      [
        0.083937, 117.4867442

      ],
      [
        0.0838324, 117.4865887

      ],
      [
        0.0839343, 117.4864009

      ],
      [
        0.0842267, 117.4862856

      ],
      [
        0.0852701, 117.4882221

      ],
      [
        0.0861284, 117.4883401

      ],
      [
        0.0868982, 117.4897563

      ],
      [
        0.0864717, 117.4898878

      ],
      [
        0.0866675, 117.4905476

      ],
      [
        0.0870511, 117.4905905

      ],
      [
        0.0871208, 117.4906495

      ],
      [
        0.08733, 117.4906844

      ],
      [
        0.0877431, 117.4906334

      ],
      [
        0.0877297, 117.4904966

      ],
      [
        0.0876251, 117.4902311

      ],
      [
        0.0853747, 117.4857974

      ],
      [
        0.0853961, 117.4854487

      ],
      [
        0.0870216, 117.4835443

      ],
      [
        0.0878691, 117.4825895

      ],
      [
        0.0880676, 117.4824983

      ],
      [
        0.0886631, 117.4830401

      ],
      [
        0.0891459, 117.4850893

      ],
      [
        0.0896608, 117.4852073

      ],
      [
        0.0892263, 117.4859262

      ],
      [
        0.089339, 117.4860764

      ],
      [
        0.0895053, 117.485953

      ],
      [
        0.0901061, 117.485218

      ],
      [
        0.0904494, 117.4852288

      ],
      [
        0.091474, 117.4860013

      ],
      [
        0.0926381, 117.4846333

      ],
      [
        0.0924182, 117.4840164

      ],
      [
        0.092681, 117.4835926

      ],
      [
        0.0924772, 117.4831098

      ],
      [
        0.0920641, 117.4828845

      ],
      [
        0.0919675, 117.4826109

      ],
      [
        0.0919675, 117.4823105

      ],
      [
        0.092622, 117.481463

      ],
      [
        0.0925952, 117.4811465

      ],
      [
        0.0918978, 117.4799126

      ],
      [
        0.0918227, 117.4795049

      ],
      [
        0.0912273, 117.4787486

      ],
      [
        0.0913506, 117.4784535

      ],
      [
        0.0932067, 117.4761951

      ],
      [
        0.0932979, 117.4762595

      ],
      [
        0.0938075, 117.4761093

      ],
      [
        0.0934052, 117.4766082

      ],
      [
        0.0948482, 117.4777722

      ],
      [
        0.0950414, 117.4776596

      ],
      [
        0.095331, 117.4777293

      ],
      [
        0.0958889, 117.4783248

      ],
      [
        0.0980025, 117.4791723

      ],
      [
        0.0981044, 117.4793708

      ],
      [
        0.0983351, 117.4794513

      ],
      [
        0.1005989, 117.4801862

      ],
      [
        0.1009476, 117.4800038

      ],
      [
        0.101087, 117.4801433

      ],
      [
        0.101661, 117.4796551

      ],
      [
        0.1015162, 117.4794245

      ],
      [
        0.1036834, 117.4776274

      ],
      [
        0.1041877, 117.4783194

      ],
      [
        0.1016718, 117.4825197

      ],
      [
        0.1019775, 117.484231

      ],
      [
        0.1018917, 117.4843919

      ],
      [
        0.101543, 117.484569

      ],
      [
        0.1014196, 117.4846977

      ],
      [
        0.1017039, 117.4851912

      ],
      [
        0.1019185, 117.4851269

      ],
      [
        0.1018702, 117.4847299

      ],
      [
        0.1019722, 117.4847245

      ],
      [
        0.1022779, 117.4856043

      ],
      [
        0.1022726, 117.4871171

      ],
      [
        0.1009958, 117.4870849

      ],
      [
        0.1003092, 117.4877715

      ],
      [
        0.0997728, 117.4890858

      ],
      [
        0.0992202, 117.4906629

      ],
      [
        0.0987643, 117.492283

      ],
      [
        0.0986301, 117.4928784

      ],
      [
        0.0988662, 117.4932379

      ],
      [
        0.0997835, 117.4932808

      ],
      [
        0.100792, 117.4931306

      ],
      [
        0.1011407, 117.493313

      ],
      [
        0.1012051, 117.4932218

      ],
      [
        0.1012319, 117.4926585

      ],
      [
        0.1014357, 117.492637

      ],
      [
        0.1014733, 117.4930125

      ],
      [
        0.1017522, 117.4931949

      ],
      [
        0.1020312, 117.4932432

      ],
      [
        0.1022458, 117.4931413

      ],
      [
        0.1024603, 117.4941069

      ],
      [
        0.1018595, 117.4945575

      ],
      [
        0.1012319, 117.4958718

      ],
      [
        0.0997245, 117.4959093

      ],
      [
        0.0989574, 117.4964243

      ],
      [
        0.0983244, 117.4971056

      ],
      [
        0.098024, 117.4979371

      ],
      [
        0.0980615, 117.4991119

      ],
      [
        0.098201, 117.4995732

      ],
      [
        0.0984209, 117.4998093

      ],
      [
        0.0988554, 117.4998951

      ],
      [
        0.1000624, 117.499761

      ],
      [
        0.100513, 117.5001526

      ],
      [
        0.1007491, 117.5006783

      ],
      [
        0.101028, 117.5007641

      ],
      [
        0.1014357, 117.5006729

      ],
      [
        0.1019346, 117.4996376

      ],
      [
        0.1024496, 117.4983716

      ],
      [
        0.1031577, 117.4977708

      ],
      [
        0.1039141, 117.4972397

      ],
      [
        0.1044773, 117.4963707

      ],
      [
        0.105046, 117.4953997

      ],
      [
        0.1051586, 117.495051

      ],
      [
        0.1051479, 117.4947077

      ],
      [
        0.1048582, 117.4942625

      ],
      [
        0.1045846, 117.4941123

      ],
      [
        0.1043111, 117.494005

      ],
      [
        0.1028412, 117.4941176

      ],
      [
        0.1027178, 117.4940264

      ],
      [
        0.1024442, 117.4919879

      ],
      [
        0.1047187, 117.4912423

      ],
      [
        0.1052552, 117.4922937

      ],
      [
        0.105518, 117.4921703

      ],
      [
        0.1040214, 117.4868488

      ],
      [
        0.1037746, 117.4862802

      ],
      [
        0.1035654, 117.4861622

      ],
      [
        0.1033294, 117.4861836

      ],
      [
        0.1031792, 117.4864411

      ],
      [
        0.1031094, 117.4868596

      ],
      [
        0.1025354, 117.4868542

      ],
      [
        0.1025301, 117.4854487

      ],
      [
        0.1019883, 117.4830937

      ],
      [
        0.102353, 117.4827987

      ],
      [
        0.1026803, 117.4829167

      ],
      [
        0.1030665, 117.4835229

      ],
      [
        0.1044666, 117.4834263

      ],
      [
        0.1049655, 117.4833083

      ],
      [
        0.1054268, 117.4831152

      ],
      [
        0.1067411, 117.4818116

      ],
      [
        0.1071596, 117.4812162

      ],
      [
        0.1082432, 117.4793708

      ],
      [
        0.1085918, 117.4790329

      ],
      [
        0.1094072, 117.4788558

      ],
      [
        0.1101475, 117.4784374

      ],
      [
        0.1102012, 117.4787164

      ],
      [
        0.1103728, 117.4788827

      ],
      [
        0.1104962, 117.4793172

      ],
      [
        0.1104426, 117.479859

      ],
      [
        0.1104587, 117.4800146

      ],
      [
        0.1110917, 117.4803042

      ],
      [
        0.1110809, 117.4805939

      ],
      [
        0.1103138, 117.4805564

      ],
      [
        0.1100724, 117.4808192

      ],
      [
        0.109831, 117.4815112

      ],
      [
        0.1094126, 117.4829328

      ],
      [
        0.1092785, 117.4830401

      ],
      [
        0.109257, 117.4833405

      ],
      [
        0.1089405, 117.4835819

      ],
      [
        0.1068484, 117.4839574

      ],
      [
        0.1060867, 117.4847192

      ],
      [
        0.1055985, 117.485674

      ],
      [
        0.1057219, 117.4864143

      ],
      [
        0.1062154, 117.4872136

      ],
      [
        0.1070737, 117.4876213

      ],
      [
        0.1084041, 117.4877501

      ],
      [
        0.1085275, 117.4878144

      ],
      [
        0.1082163, 117.489987

      ],
      [
        0.1093375, 117.4900621

      ],
      [
        0.1095092, 117.4893969

      ],
      [
        0.1100402, 117.4883777

      ],
      [
        0.1106786, 117.4881148

      ],
      [
        0.1122182, 117.4865001

      ],
      [
        0.1137953, 117.4859905

      ],
      [
        0.1141762, 117.4861407

      ],
      [
        0.1142781, 117.4863392

      ],
      [
        0.1142674, 117.4866289

      ],
      [
        0.1131945, 117.4876589

      ],
      [
        0.112583, 117.4884689

      ],
      [
        0.1123952, 117.4890697

      ],
      [
        0.1123201, 117.4901211

      ],
      [
        0.1123738, 117.4914247

      ],
      [
        0.1124864, 117.4919987

      ],
      [
        0.112583, 117.4921167

      ],
      [
        0.1149272, 117.4916768

      ],
      [
        0.1154797, 117.4924707

      ],
      [
        0.1143908, 117.4927121

      ],
      [
        0.1139187, 117.4924117

      ],
      [
        0.1113867, 117.493034

      ],
      [
        0.1111238, 117.4931145

      ],
      [
        0.1103299, 117.494123

      ],
      [
        0.1099812, 117.4957001

      ],
      [
        0.1103567, 117.4959522

      ],
      [
        0.1102173, 117.4964136

      ],
      [
        0.1103246, 117.4969178

      ],
      [
        0.1100724, 117.4976099

      ],
      [
        0.1099705, 117.4979371

      ],
      [
        0.1099383, 117.4982268

      ],
      [
        0.1099276, 117.4988329

      ],
      [
        0.109992, 117.4994338

      ],
      [
        0.1103031, 117.4998254

      ],
      [
        0.1107162, 117.5002384

      ],
      [
        0.1108449, 117.5005013

      ],
      [
        0.1108181, 117.5013435

      ],
      [
        0.1106464, 117.5035322

      ],
      [
        0.1101636, 117.504648

      ],
      [
        0.1098471, 117.5059086

      ],
      [
        0.1095467, 117.5062197

      ],
      [
        0.109257, 117.5061768

      ],
      [
        0.1088064, 117.5057691

      ],
      [
        0.1080286, 117.5054848

      ],
      [
        0.1077228, 117.5055653

      ],
      [
        0.1074814, 117.5058442

      ],
      [
        0.1074331, 117.5062948

      ],
      [
        0.1075672, 117.5068206

      ],
      [
        0.1079696, 117.5074804

      ],
      [
        0.1084524, 117.5078183

      ],
      [
        0.1087367, 117.5082529

      ],
      [
        0.1088547, 117.5085801

      ],
      [
        0.1089835, 117.5088859

      ],
      [
        0.1092195, 117.5093096

      ],
      [
        0.1095789, 117.509771

      ],
      [
        0.1118212, 117.5111336

      ],
      [
        0.1120894, 117.5113267

      ],
      [
        0.1144927, 117.5119543

      ],
      [
        0.1165419, 117.5139767

      ],
      [
        0.117942, 117.5141591

      ],
      [
        0.1186501, 117.5157094

      ],
      [
        0.1200449, 117.5167984

      ],
      [
        0.1227807, 117.5183487

      ],
      [
        0.1249318, 117.5219858

      ],
      [
        0.125361, 117.5221092

      ],
      [
        0.1258813, 117.5220877

      ],
      [
        0.1269113, 117.5215244

      ],
      [
        0.1276355, 117.5214547

      ],
      [
        0.1289229, 117.5215405

      ],
      [
        0.1307844, 117.5203711

      ],
      [
        0.1321416, 117.5184613

      ],
      [
        0.1326458, 117.5182414

      ],
      [
        0.1335256, 117.5181073

      ],
      [
        0.1339762, 117.5181395

      ],
      [
        0.1355587, 117.5178766

      ],
      [
        0.1362775, 117.5170827

      ],
      [
        0.1365082, 117.51616

      ],
      [
        0.1367013, 117.516557

      ],
      [
        0.1370768, 117.5169218

      ],
      [
        0.1366477, 117.5177586

      ],
      [
        0.1356285, 117.5190246

      ],
      [
        0.1348774, 117.520355

      ],
      [
        0.1341854, 117.5215781

      ],
      [
        0.1334451, 117.5219697

      ],
      [
        0.1332306, 117.522034

      ],
      [
        0.1336114, 117.5225812

      ],
      [
        0.1341747, 117.5223988

      ],
      [
        0.1348506, 117.5222486

      ],
      [
        0.1349579, 117.5221145

      ],
      [
        0.1348238, 117.5214225

      ],
      [
        0.1351725, 117.5208807

      ],
      [
        0.1364707, 117.5217229

      ],
      [
        0.1374094, 117.5208002

      ],
      [
        0.1380102, 117.5192231

      ],
      [
        0.1413737, 117.5194752

      ],
      [
        0.1424305, 117.5184131

      ],
      [
        0.1428275, 117.5174743

      ],
      [
        0.1417761, 117.5160956

      ],
      [
        0.1419155, 117.5156021

      ],
      [
        0.14154, 117.5147438

      ],
      [
        0.1415508, 117.5145024

      ],
      [
        0.1421891, 117.5132257

      ],
      [
        0.1420765, 117.5128019

      ],
      [
        0.1419745, 117.5123459

      ],
      [
        0.1421462, 117.5118738

      ],
      [
        0.1426397, 117.5119972

      ],
      [
        0.1430474, 117.5123996

      ],
      [
        0.1433425, 117.5127214

      ],
      [
        0.1436107, 117.5127429

      ],
      [
        0.1440077, 117.5125712

      ],
      [
        0.1447748, 117.5113428

      ],
      [
        0.1458155, 117.5105059

      ],
      [
        0.146148, 117.5099587

      ],
      [
        0.1467703, 117.5088429

      ],
      [
        0.1474999, 117.5082314

      ],
      [
        0.1477466, 117.5079954

      ],
      [
        0.1477252, 117.507534

      ],
      [
        0.1478968, 117.5074375

      ],
      [
        0.1485084, 117.5084889

      ],
      [
        0.1489268, 117.5098944

      ],
      [
        0.1491199, 117.5102055

      ],
      [
        0.1499031, 117.5105381

      ],
      [
        0.1510189, 117.5109243

      ],
      [
        0.1525424, 117.5098836

      ],
      [
        0.1538942, 117.5089502

      ],
      [
        0.154774, 117.5086927

      ],
      [
        0.1555572, 117.5078237

      ],
      [
        0.1568876, 117.5073838

      ],
      [
        0.1572416, 117.5076413

      ],
      [
        0.1578961, 117.5078237

      ],
      [
        0.1584647, 117.507813

      ],
      [
        0.1584111, 117.5079632

      ],
      [
        0.1579497, 117.5083709

      ],
      [
        0.1577673, 117.5090361

      ],
      [
        0.1581428, 117.5091755

      ],
      [
        0.158336, 117.508961

      ],
      [
        0.1587007, 117.5084889

      ],
      [
        0.1591728, 117.508285

      ],
      [
        0.1594518, 117.5079095

      ],
      [
        0.1592908, 117.5071478

      ],
      [
        0.1588402, 117.5061071

      ],
      [
        0.1579283, 117.5056565

      ],
      [
        0.1572524, 117.5041652

      ],
      [
        0.1561687, 117.5030279

      ],
      [
        0.1549564, 117.4997342

      ],
      [
        0.1544521, 117.4991226

      ],
      [
        0.1528321, 117.4980605

      ],
      [
        0.1517485, 117.4974489

      ],
      [
        0.1514803, 117.4972129

      ],
      [
        0.1510404, 117.4964941

      ],
      [
        0.1505254, 117.4960756

      ],
      [
        0.149989, 117.495743

      ],
      [
        0.1492594, 117.4954319

      ],
      [
        0.1486371, 117.4948847

      ],
      [
        0.148444, 117.4943483

      ],
      [
        0.1486693, 117.4938333

      ],
      [
        0.1491199, 117.4935329

      ],
      [
        0.149592, 117.493608

      ],
      [
        0.150225, 117.4941015

      ],
      [
        0.151212, 117.4945843

      ],
      [
        0.1527248, 117.495153

      ],
      [
        0.1571987, 117.4962151

      ],
      [
        0.1584969, 117.4956572

      ],
      [
        0.1589046, 117.4948525

      ],
      [
        0.1586793, 117.4931467

      ],
      [
        0.1579068, 117.4911726

      ],
      [
        0.1560615, 117.4905181

      ],
      [
        0.1549564, 117.4904644

      ],
      [
        0.1538728, 117.4907863

      ],
      [
        0.1527248, 117.4909151

      ],
      [
        0.1517163, 117.4907756

      ],
      [
        0.151255, 117.4905449

      ],
      [
        0.1508151, 117.490502

      ],
      [
        0.1508204, 117.4904484

      ],
      [
        0.1516841, 117.4903142

      ],
      [
        0.1516305, 117.4899119

      ],
      [
        0.1508419, 117.4899817

      ],
      [
        0.1503698, 117.4892092

      ],
      [
        0.1494793, 117.4887264

      ],
      [
        0.1491521, 117.488367

      ],
      [
        0.1490073, 117.4878252

      ],
      [
        0.149254, 117.4873906

      ],
      [
        0.1495437, 117.487278

      ],
      [
        0.1502357, 117.4876964

      ],
      [
        0.1522045, 117.4888229

      ],
      [
        0.1526658, 117.4888766

      ],
      [
        0.1561956, 117.4885762

      ],
      [
        0.1573918, 117.4886298

      ],
      [
        0.1582609, 117.4885225

      ],
      [
        0.1598755, 117.487734

      ],
      [
        0.1600204, 117.4875355

      ],
      [
        0.1600687, 117.4869883

      ],
      [
        0.1598487, 117.486527

      ],
      [
        0.1594947, 117.4861139

      ],
      [
        0.1592533, 117.4859208

      ],
      [
        0.1587544, 117.4848211

      ],
      [
        0.1584164, 117.4846065

      ],
      [
        0.1580248, 117.4844402

      ],
      [
        0.1574133, 117.4844402

      ],
      [
        0.1563833, 117.4840057

      ],
      [
        0.1561258, 117.4831259

      ],
      [
        0.1561473, 117.4827826

      ],
      [
        0.1554553, 117.4812752

      ],
      [
        0.1559488, 117.480154

      ],
      [
        0.1564477, 117.4792635

      ],
      [
        0.1566086, 117.4782765

      ],
      [
        0.1572148, 117.4782282

      ],
      [
        0.1581267, 117.4785233

      ],
      [
        0.1596073, 117.479623

      ],
      [
        0.1605997, 117.4799716

      ],
      [
        0.1609699, 117.4802667

      ],
      [
        0.1611684, 117.4802023

      ],
      [
        0.161104, 117.4797517

      ],
      [
        0.1612542, 117.479462

      ],
      [
        0.1618926, 117.4793279

      ],
      [
        0.1622466, 117.4790597

      ],
      [
        0.1621876, 117.4784482

      ],
      [
        0.1618765, 117.4781209

      ],
      [
        0.1618926, 117.4777669

      ],
      [
        0.1621286, 117.4774879

      ],
      [
        0.1622412, 117.4774879

      ],
      [
        0.1624451, 117.477622

      ],
      [
        0.1628635, 117.4774826

      ],
      [
        0.1628367, 117.4770588

      ],
      [
        0.1635609, 117.4763721

      ],
      [
        0.1640222, 117.4762541

      ],
      [
        0.1641939, 117.4763507

      ],
      [
        0.1640598, 117.4768335

      ],
      [
        0.1645908, 117.4772251

      ],
      [
        0.1649878, 117.476812

      ],
      [
        0.1652238, 117.4770319

      ],
      [
        0.1664791, 117.4773216

      ],
      [
        0.1666132, 117.4775416

      ],
      [
        0.166463, 117.4783301

      ],
      [
        0.165991, 117.4785447

      ],
      [
        0.1652882, 117.4785233

      ],
      [
        0.1647089, 117.4787271

      ],
      [
        0.1644997, 117.4792796

      ],
      [
        0.1644192, 117.4798429

      ],
      [
        0.1646552, 117.4802452

      ],
      [
        0.1652614, 117.48061

      ],
      [
        0.1654867, 117.4807978

      ],
      [
        0.1655135, 117.4813128

      ],
      [
        0.1654492, 117.4818546

      ],
      [
        0.165535, 117.4820852

      ],
      [
        0.1660661, 117.4823534

      ],
      [
        0.1659802, 117.4824607

      ],
      [
        0.1657013, 117.4826753

      ],
      [
        0.1643494, 117.4831313

      ],
      [
        0.1626221, 117.4806529

      ],
      [
        0.162311, 117.4805671

      ],
      [
        0.1604334, 117.4821872

      ],
      [
        0.1610986, 117.4834049

      ],
      [
        0.1619194, 117.4845475

      ],
      [
        0.1632283, 117.4837911

      ],
      [
        0.1644353, 117.4854434

      ],
      [
        0.1652882, 117.4849713

      ],
      [
        0.1655082, 117.4852556

      ],
      [
        0.1653419, 117.4853951

      ],
      [
        0.1650522, 117.4854809

      ],
      [
        0.1645694, 117.4855989

      ],
      [
        0.1645908, 117.4859637

      ],
      [
        0.1649664, 117.4862695

      ],
      [
        0.1651702, 117.4865431

      ],
      [
        0.1649503, 117.4866933

      ],
      [
        0.1651487, 117.4869776

      ],
      [
        0.1644299, 117.4875784

      ],
      [
        0.1646069, 117.4877286

      ],
      [
        0.1653955, 117.4871546

      ],
      [
        0.165991, 117.4879539

      ],
      [
        0.1661197, 117.4878842

      ],
      [
        0.1668814, 117.4888283

      ],
      [
        0.1667151, 117.4892199

      ],
      [
        0.166683, 117.4894452

      ],
      [
        0.1667366, 117.4897134

      ],
      [
        0.1684371, 117.4901426

      ],
      [
        0.1702235, 117.4905288

      ],
      [
        0.1705936, 117.490502

      ],
      [
        0.1713446, 117.4891073

      ],
      [
        0.1712105, 117.4890053

      ],
      [
        0.1719454, 117.4873853

      ],
      [
        0.1723639, 117.4858671

      ],
      [
        0.1725248, 117.4856579

      ],
      [
        0.1735279, 117.4856687

      ],
      [
        0.1735279, 117.4859691

      ],
      [
        0.176017, 117.4860227

      ],
      [
        0.1760599, 117.4856955

      ],
      [
        0.1764783, 117.4856687

      ],
      [
        0.1764676, 117.4854863

      ],
      [
        0.1769075, 117.4855399

      ],
      [
        0.1772562, 117.485953

      ],
      [
        0.1776049, 117.4858081

      ],
      [
        0.1785919, 117.4852771

      ],
      [
        0.1794717, 117.4848372

      ],
      [
        0.1796058, 117.4850625

      ],
      [
        0.1789835, 117.4853039

      ],
      [
        0.1787582, 117.4855292

      ],
      [
        0.1780823, 117.4859101

      ],
      [
        0.1777014, 117.4861568

      ],
      [
        0.1771113, 117.4867684

      ],
      [
        0.1766554, 117.4870044

      ],
      [
        0.1764408, 117.4877071

      ],
      [
        0.1760224, 117.4882919

      ],
      [
        0.1758936, 117.4882114

      ],
      [
        0.1757756, 117.4883723

      ],
      [
        0.175899, 117.4884742

      ],
      [
        0.1753786, 117.4892789

      ],
      [
        0.1750568, 117.4896812

      ],
      [
        0.1751694, 117.4898422

      ],
      [
        0.1756737, 117.4901319

      ],
      [
        0.1760921, 117.4901748

      ],
      [
        0.1772776, 117.4896169

      ],
      [
        0.1776853, 117.4895632

      ],
      [
        0.1785275, 117.4882704

      ],
      [
        0.1797077, 117.488957

      ],
      [
        0.1791391, 117.4899387

      ],
      [
        0.1792786, 117.4899977

      ],
      [
        0.1789138, 117.4906415

      ],
      [
        0.1788494, 117.4907488

      ],
      [
        0.178726, 117.4907917

      ],
      [
        0.1783934, 117.4904805

      ],
      [
        0.1780394, 117.490443

      ],
      [
        0.1777014, 117.4904752

      ],
      [
        0.1773635, 117.4906951

      ],
      [
        0.176988, 117.4909526

      ],
      [
        0.1744452, 117.4919021

      ],
      [
        0.1736513, 117.4931949

      ],
      [
        0.1737586, 117.4947345

      ],
      [
        0.1736299, 117.4998039

      ],
      [
        0.174574, 117.5020838

      ],
      [
        0.17562, 117.5043958

      ],
      [
        0.1768485, 117.5041974

      ],
      [
        0.1790372, 117.5032854

      ],
      [
        0.1797506, 117.5007963

      ],
      [
        0.1786992, 117.4985164

      ],
      [
        0.1795146, 117.4974114

      ],
      [
        0.1808342, 117.4969125

      ],
      [
        0.1809522, 117.4970841

      ],
      [
        0.1811722, 117.4970037

      ],
      [
        0.1811936, 117.4965852

      ],
      [
        0.1815906, 117.4964619

      ],
      [
        0.1806304, 117.4938548

      ],
      [
        0.1803032, 117.493726

      ],
      [
        0.1801744, 117.4933344

      ],
      [
        0.1812527, 117.4930286

      ],
      [
        0.1813814, 117.493313

      ],
      [
        0.1817784, 117.4932271

      ],
      [
        0.1816603, 117.4928516

      ],
      [
        0.18217, 117.4927229

      ],
      [
        0.1825294, 117.4928892

      ],
      [
        0.1828244, 117.4927711

      ],
      [
        0.1831356, 117.4927336

      ],
      [
        0.1836613, 117.4920148

      ],
      [
        0.1837417, 117.4923581

      ],
      [
        0.1843479, 117.4922347

      ],
      [
        0.1860055, 117.4918699

      ],
      [
        0.1866868, 117.4910653

      ],
      [
        0.1876631, 117.4909043

      ],
      [
        0.1880762, 117.4913067

      ],
      [
        0.1882585, 117.4913067

      ],
      [
        0.1882532, 117.4909955

      ],
      [
        0.1883658, 117.4909633

      ],
      [
        0.188736, 117.4911404

      ],
      [
        0.188854, 117.4904537

      ],
      [
        0.1893797, 117.4901748

      ],
      [
        0.1893046, 117.4905127

      ],
      [
        0.1899161, 117.4901158

      ],
      [
        0.1899644, 117.4901909

      ],
      [
        0.1897659, 117.4904108

      ],
      [
        0.1888486, 117.4921113

      ],
      [
        0.188457, 117.4933237

      ],
      [
        0.1887413, 117.4939513

      ],
      [
        0.189149, 117.4941927

      ],
      [
        0.1891115, 117.494359

      ],
      [
        0.1887092, 117.4945521

      ],
      [
        0.1890096, 117.4957913

      ],
      [
        0.1887628, 117.4962097

      ],
      [
        0.1888433, 117.4969018

      ],
      [
        0.1868638, 117.499187

      ],
      [
        0.1866653, 117.4996054

      ],
      [
        0.1866707, 117.5004208

      ],
      [
        0.1871213, 117.500909

      ],
      [
        0.1877918, 117.500968

      ],
      [
        0.1884731, 117.5008875

      ],
      [
        0.1890739, 117.5007051

      ],
      [
        0.1892724, 117.5005388

      ],
      [
        0.1893743, 117.5000507

      ],
      [
        0.189546, 117.4999166

      ],
      [
        0.1896962, 117.4998683

      ],
      [
        0.1901844, 117.4998361

      ],
      [
        0.1913431, 117.4997449

      ],
      [
        0.1919224, 117.4995947

      ],
      [
        0.1924052, 117.4993908

      ],
      [
        0.1926573, 117.4991763

      ],
      [
        0.1929417, 117.4988276

      ],
      [
        0.1933333, 117.4982053

      ],
      [
        0.1937785, 117.4975348

      ],
      [
        0.1938751, 117.4973899

      ],
      [
        0.1953664, 117.4954373

      ],
      [
        0.1967236, 117.4938011

      ],
      [
        0.1974746, 117.4929053

      ],
      [
        0.1976301, 117.4926156

      ],
      [
        0.1978393, 117.4926478

      ],
      [
        0.1977696, 117.4929374

      ],
      [
        0.197437, 117.4933022

      ],
      [
        0.1961817, 117.4946272

      ],
      [
        0.195876, 117.4957001

      ],
      [
        0.1958384, 117.4965852

      ],
      [
        0.1953985, 117.4974811

      ],
      [
        0.1953395, 117.4984199

      ],
      [
        0.1958331, 117.4986076

      ],
      [
        0.1964285, 117.4986291

      ],
      [
        0.1973029, 117.4991816

      ],
      [
        0.1982524, 117.4996322

      ],
      [
        0.198703, 117.4997985

      ],
      [
        0.1992287, 117.4998844

      ],
      [
        0.1994057, 117.4998683

      ],
      [
        0.1992448, 117.5000238

      ],
      [
        0.1987781, 117.500174

      ],
      [
        0.1983597, 117.5000882

      ],
      [
        0.1979037, 117.5002277

      ],
      [
        0.1973136, 117.5000507

      ],
      [
        0.1960959, 117.4996912

      ],
      [
        0.1953503, 117.4997771

      ],
      [
        0.1951035, 117.5001258

      ],
      [
        0.1951089, 117.5019068

      ],
      [
        0.1943525, 117.5019979

      ],
      [
        0.1936605, 117.502926

      ],
      [
        0.1931187, 117.5039452

      ],
      [
        0.1932152, 117.5045139

      ],
      [
        0.192652, 117.5052863

      ],
      [
        0.1925125, 117.5061017

      ],
      [
        0.1919868, 117.5065255

      ],
      [
        0.1917454, 117.5068742

      ],
      [
        0.1916381, 117.5078452

      ],
      [
        0.1919385, 117.5092024

      ],
      [
        0.1921531, 117.5100338

      ],
      [
        0.1923516, 117.5102913

      ],
      [
        0.1926627, 117.5105435

      ],
      [
        0.1929685, 117.5106186

      ],
      [
        0.1933654, 117.5105435

      ],
      [
        0.19358, 117.510066

      ],
      [
        0.1939287, 117.5098461

      ],
      [
        0.1943579, 117.5098246

      ],
      [
        0.1953234, 117.5102109

      ],
      [
        0.1958974, 117.5108224

      ],
      [
        0.1960423, 117.5111765

      ],
      [
        0.1960315, 117.5115627

      ],
      [
        0.1961013, 117.5120348

      ],
      [
        0.1975121, 117.5133061

      ],
      [
        0.1983436, 117.5155753

      ],
      [
        0.1981129, 117.51719

      ],
      [
        0.1979413, 117.5176942

      ],
      [
        0.1979681, 117.5181878

      ],
      [
        0.198306, 117.5182307

      ],
      [
        0.1989766, 117.5173885

      ],
      [
        0.2001943, 117.5172168

      ],
      [
        0.2031286, 117.516337

      ],
      [
        0.2033647, 117.5160581

      ],
      [
        0.2031715, 117.515763

      ],
      [
        0.2021952, 117.514438

      ],
      [
        0.202678, 117.5131398

      ],
      [
        0.2036436, 117.5109726

      ],
      [
        0.2038367, 117.5104469

      ],
      [
        0.203767, 117.509433

      ],
      [
        0.2042659, 117.5087517

      ],
      [
        0.2045824, 117.5078613

      ],
      [
        0.2046253, 117.5074321

      ],
      [
        0.204636, 117.5063002

      ],
      [
        0.2039708, 117.504546

      ],
      [
        0.2043249, 117.5043046

      ],
      [
        0.2050008, 117.5042617

      ],
      [
        0.2057411, 117.5047016

      ],
      [
        0.2056499, 117.5042725

      ]
	]).addTo(map);
	var pulau1 = L.polygon([
        [
        0.0618195, 117.5180966

      ],
      [
        0.0617981, 117.518295

      ],
      [
        0.0616586, 117.5185472

      ],
      [
        0.0614065, 117.5195396

      ],
      [
        0.0614494, 117.5196683

      ],
      [
        0.0616479, 117.5197488

      ],
      [
        0.061841, 117.5204837

      ],
      [
        0.0619858, 117.5207198

      ],
      [
        0.0619054, 117.520929

      ],
      [
        0.0619215, 117.5217819

      ],
      [
        0.0623399, 117.5226402

      ],
      [
        0.0625008, 117.5227636

      ],
      [
        0.0624633, 117.523064

      ],
      [
        0.0625276, 117.5231659

      ],
      [
        0.0627744, 117.5234073

      ],
      [
        0.0632894, 117.5235951

      ],
      [
        0.0634771, 117.5235575

      ],
      [
        0.0637239, 117.523461

      ],
      [
        0.0640243, 117.523402

      ],
      [
        0.0644964, 117.5234717

      ],
      [
        0.0646895, 117.5234342

      ],
      [
        0.0651347, 117.5231123

      ],
      [
        0.0656229, 117.522946

      ],
      [
        0.0660091, 117.5226134

      ],
      [
        0.0662076, 117.5222647

      ],
      [
        0.066551, 117.5212294

      ],
      [
        0.0666529, 117.5211489

      ],
      [
        0.0667119, 117.5208807

      ],
      [
        0.0666636, 117.5206286

      ],
      [
        0.0666797, 117.5201082

      ],
      [
        0.0666529, 117.519958

      ],
      [
        0.0666636, 117.5197917

      ],
      [
        0.0667977, 117.519663

      ],
      [
        0.0671464, 117.5187564

      ],
      [
        0.0671357, 117.5186062

      ],
      [
        0.0670659, 117.5183916

      ],
      [
        0.0670606, 117.5181448

      ],
      [
        0.0670016, 117.5180241

      ],
      [
        0.0668299, 117.5179678

      ],
      [
        0.0667119, 117.5179625

      ],
      [
        0.0666851, 117.5178847

      ],
      [
        0.0667199, 117.5178444

      ],
      [
        0.0667414, 117.5178444

      ],
      [
        0.066838, 117.5178874

      ],
      [
        0.0670793, 117.5179034

      ],
      [
        0.0671786, 117.5178552

      ],
      [
        0.0673878, 117.5175896

      ],
      [
        0.0679725, 117.5159401

      ],
      [
        0.0678974, 117.5154626

      ],
      [
        0.0680315, 117.5150603

      ],
      [
        0.0679403, 117.5145829

      ],
      [
        0.0677848, 117.5141001

      ],
      [
        0.0670069, 117.5131828

      ],
      [
        0.0669855, 117.5128663

      ],
      [
        0.0668031, 117.5125873

      ],
      [
        0.0665456, 117.5124532

      ],
      [
        0.0662666, 117.5120991

      ],
      [
        0.0657141, 117.5117129

      ],
      [
        0.065285, 117.5116593

      ],
      [
        0.0645608, 117.5120026

      ],
      [
        0.0645125, 117.5124049

      ],
      [
        0.0639546, 117.5134349

      ],
      [
        0.063976, 117.5137353

      ],
      [
        0.0637293, 117.5143415

      ],
      [
        0.0633699, 117.5143951

      ],
      [
        0.0626778, 117.5150657

      ],
      [
        0.0621682, 117.5158489

      ],
      [
        0.0619751, 117.516101

      ],
      [
        0.0616854, 117.5177264

      ],
      [
        0.0617015, 117.5179195

      ],
      [
        0.0618195, 117.5180966

      ]
    ]).addTo(map).bindPopup('Pulau Panjang');
	var pulau2 = L.polygon([
         [
        0.0739646, 117.4987847

      ],
      [
        0.0739485, 117.497524

      ],
      [
        0.0729185, 117.4955499

      ],
      [
        0.0703114, 117.4921703

      ],
      [
        0.0702363, 117.489692

      ],
      [
        0.068509, 117.4883831

      ],
      [
        0.0647378, 117.4874872

      ],
      [
        0.0641155, 117.4910384

      ],
      [
        0.0652206, 117.492696

      ],
      [
        0.0676828, 117.4947613

      ],
      [
        0.0719154, 117.4970198

      ],
      [
        0.0739646, 117.4987847

      ]
    ]).addTo(map);
	var selangan = L.polygon([
        [
        0.0674897, 117.5096691
      ],
      [
        0.0679886, 117.5094545
      ],
      [
        0.0678116, 117.5091112
      ],
      [
        0.0691205, 117.5081509
      ],
      [
        0.0688952, 117.5077164
      ],
      [
        0.0674683, 117.5084084
      ],
      [
        0.0671249, 117.5077325
      ],
      [
        0.0666314, 117.5080597
      ],
      [
        0.0674897, 117.5096691
      ]
    ]).addTo(map).bindPopup('Perkampungan Selangan.');
	var tihi = L.polygon([
        [
        0.063512, 117.5299814
      ],
      [
        0.0646171, 117.5290856
      ],
      [
        0.064719, 117.5292867
      ],
      [
        0.0648853, 117.5292787
      ],
      [
        0.0648853, 117.5289622
      ],
      [
        0.0649524, 117.5289193
      ],
      [
        0.0651723, 117.529166
      ],
      [
        0.0653091, 117.52904
      ],
      [
        0.065065, 117.5287476
      ],
      [
        0.0652662, 117.5287047
      ],
      [
        0.0661728, 117.5285357
      ],
      [
        0.06742, 117.5284901
      ],
      [
        0.06742, 117.5281575
      ],
      [
        0.0671008, 117.5281575
      ],
      [
        0.067184, 117.5276425
      ],
      [
        0.0670391, 117.5271571
      ],
      [
        0.066669, 117.5267386
      ],
      [
        0.0657838, 117.52709
      ],
      [
        0.0658724, 117.5280878
      ],
      [
        0.0647136, 117.5283453
      ],
      [
        0.064255, 117.5286511
      ],
      [
        0.0632277, 117.5295442
      ],
      [
        0.063512, 117.5299814
      ]
    ]).addTo(map).bindPopup('Perkampungan Tihi-tihi.');
	var beras = L.polygon([
        [
        0.064947, 117.5580186

      ],
      [
        0.0643623, 117.5578952

      ],
      [
        0.0637615, 117.5578684

      ],
      [
        0.0631767, 117.5583136

      ],
      [
        0.0626993, 117.5589037

      ],
      [
        0.0624633, 117.5594562

      ],
      [
        0.0623667, 117.5599068

      ],
      [
        0.0624311, 117.5605184

      ],
      [
        0.0627315, 117.5609529

      ],
      [
        0.0631553, 117.5610012

      ],
      [
        0.0635147, 117.5609422

      ],
      [
        0.0639492, 117.5606203

      ],
      [
        0.0642335, 117.5602663

      ],
      [
        0.064432, 117.5598693

      ],
      [
        0.0646305, 117.5592309

      ],
      [
        0.0647807, 117.5587481

      ],
      [
        0.0649255, 117.5582814

      ],
      [
        0.0649805, 117.55815

      ],
      [
        0.0649792, 117.5580749

      ],
      [
        0.064947, 117.5580186

      ]
    ]).addTo(map).bindPopup('Pulau Beras Basah.');
	var gusung = L.polygon([
        [
        0.1919868, 117.5122118
      ],
      [
        0.1908335, 117.5097013
      ],
      [
        0.1895836, 117.5100821
      ],
      [
        0.1908281, 117.5127912
      ],
      [
        0.1919868, 117.5122118
      ]
    ]).addTo(map).bindPopup('Pulau Gusung.');
    function onMapClick(e) {
        $("#lat").val(e.latlng['lat']);
        $("#long").val(e.latlng['lng']);
        // console.log(e);
        popup
            .setLatLng(e.latlng)
            .setContent('Koordinat Rumah Penerima : ' + e.latlng['lat'] + ', ' + e.latlng['lng'])
            .openOn(map);
    }
	var popup = L.popup()
		.setLatLng([0.136299, 117.47921])
		.setContent('Kota Bontang.')
		.openOn(map);
	map.on('click', onMapClick);

    </script>
@endsection
