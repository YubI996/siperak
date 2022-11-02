@extends('admin::layouts.app')

@section('custom-css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('admin/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}" />
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
@section('title', 'Penerima')
@section('item')
    <a href="{{route('home2')}}">Home</a>
@endsection

@section('papan-kanan')
    <button id="tambah-button" type="button" class="btn btn-outline-primary pull-right">Tambah Penerima</button>
@endsection

@section('item-active', 'Penerima')

@section('content')
    <!-- Simple Datatable start -->
        <div class="card-box mb-30" id="data-box">
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">Penerima</th>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th>Alamat</th>
                            <th>Penyakit</th>
                            <th>Status</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penerima as $data)
                            <tr>
                            <td class="table-plus">
                                <img class="border-radius-100 shadow" style="max-height: 118pt; max-:99pt" src="{{asset('storage/foto_penerima/'.$data->foto_penerima)}}" alt="">
                                {{-- {{file_exist(asset('storage/'.$data->foto_penerima))?'default.png':$data->foto_penerima}} --}}
                            </td>
                            <td>{{$data->nama}}</td>
                            <td>{{Carbon::parse($data->bd)->age}} Tahun</td>
                            <td>{{$data->alamat}}</td>
                            <td>{{$data->penyakit}}</td>
                            <td>{{$data->Histories[0]->status_trima ?? 'Data tidak ada.'}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item view-data" id="{{$data->slug}}" url="{{ url('receptions', $data->id) }}" href="#"  data-toggle="modal" data-target="#view-penerima"><i class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <center><h4>Data penerima tidak ditemukan.</h4></center>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    <!-- Simple Datatable End -->

    <!-- form input penerima-->
        <div class="pd-20 card-box mb-30" id="create-box">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Input Data Penerima</h4>
                    <p class="mb-30">Mengajukan penerima Rantang Kasih</p>
                </div>

            </div>
            <form name="input-penerima" id="input-penerima" method="POST" action="{{route('receptions.store')}}" enctype="multipart/form-data">
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
                        <select class="custom-select" name="kec" id="kec">
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
                        <select class="custom-select col-12" name="kel" id="kel">

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Rukun Tetangga (RT)</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="rt_id" id="rt">

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

    {{-- modal view --}}
        <div class="modal fade bs-example-modal-lg" id="view-penerima" tabindex="-1"
            role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Biodata Penerima Bantuan
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-responsive table-bordered tableView">
                            <tbody>
                            <tr>
                                <td style="text-align: center;" valign="middle">Nama</td>
                                <td style="text-align: center;" valign="middle" id="nama"></td>
                                <td style="text-align: center;" valign="middle">Penyakit</td>
                                <td style="text-align: center;" valign="middle" id="penyakit"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" valign="middle">Nomor Induk Kependudukan</td>
                                <td style="text-align: center;" valign="middle" id="nik"></td>
                                <td style="text-align: center;" valign="middle">Status Kepemilikan Rumah</td>
                                <td style="text-align: center;" valign="middle" id="status"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" valign="middle">Tangal Lahir (Umur)</td>
                                <td style="text-align: center;" valign="middle" id="tgl"></td>
                                <td style="text-align: center;" valign="middle">Foto KTP</td>
                                <td style="text-align: center;" valign="middle" id="ktp"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" valign="middle">Pekerjaan</td>
                                <td style="text-align: center;" valign="middle" id="pekerjaan"></td>
                                <td style="text-align: center;" valign="middle">Foto Kartu Keluarga</td>
                                <td style="text-align: center;" valign="middle" id="ft_kk"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" valign="middle">Jenis Kelamin</td>
                                <td style="text-align: center;" valign="middle" id="jk"></td>
                                <td style="text-align: center;" valign="middle">Foto Rumah</td>
                                <td style="text-align: center;" valign="middle" id="ft_rmh"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" valign="middle">Alamat</td>
                                <td style="text-align: center;" valign="middle" id="alamat"></td>
                                <td style="text-align: center;" valign="middle">Lokasi</td>
                                <td style="text-align: center;" valign="middle"><a  target=”_blank” id="lokasi" href=""></a> </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    {{-- akhir modal view --}}
@endsection

@section('custom-scripts')
    	<script src="{{asset('admin/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('admin/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('admin/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('admin/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
        <!-- buttons for Export datatable -->
        <script src="{{asset('admin/src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('admin/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('admin/src/plugins/datatables/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('admin/src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('admin/src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
        <script src="{{asset('admin/src/plugins/datatables/js/pdfmake.min.js')}}"></script>
        <script src="{{asset('admin/src/plugins/datatables/js/vfs_fonts.js')}}"></script>
        <!-- Datatable Setting js -->
        <script src="{{asset('admin/vendors/scripts/datatable-setting.js')}}"></script>
        <script>
            $(document).ready(function() {
                $("#alert").hide();
                $("#create-box").hide();
                $("#myWish").click(function showAlert() {
                    $("#alert").fadeTo(10000, 500).slideUp(500, function() {
                    $("#alert").slideUp(500);
                    });
                });

                $(".view-data").click(function(){
                // $('body').on('click', '#view-data', function (){
                    var userURL = $(this).attr('url');
                    $.get(userURL, function (data) {
                        data = data.penerima
                        console.log(data);
                            // $('#userShowModal').modal('show');
                            $('.tableView #nama').text(data.nama);
                            $('.tableView #penyakit').text(data.penyakit);
                            $('.tableView #nik').text(data.nik);
                            $('.tableView #status').text(data.status_rumah);
                            var ageDifMs = Date.now() - data.bd;
                            var ageDate = new Date(ageDifMs); // miliseconds from epoch
                            var umur =  Math.abs(ageDate.getUTCFullYear() - 1970);
                            $('.tableView #tgl').text(data.bd +' ('+ ageDifMs+')'+' Tahun');
                            $('.tableView #ktp').text(data.foto_ktp);
                            $('.tableView #pekerjaan').text(data.pekerjaan);
                            $('.tableView #ft_kk').text(data.foto_kk);
                            $('.tableView #jk').text(data.jenkel);
                            $('.tableView #ft_rmh').text(data.foto_rumah);
                            $('.tableView #alamat').text(data.alamat);
                            $('.tableView #lokasi').attr("href", 'https://www.google.com/maps/search/?api=1&query='+data.lat+','+data.long );
                            $('.tableView #lokasi').text('Tautan Lokasi Google Map' );
                    })
                });
            });
            $("#tambah-button").click(function(){
                $("#create-box").show();
                $("#data-box").hide();
            });

        </script>
        @include('peta.index')
        @include('aplikasi.dropdown')
@endsection
