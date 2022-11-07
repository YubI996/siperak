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
                                        <a class="dropdown-item edit-data" id="edit-{{$data->slug}}" url="{{ url('receptions/'.$data->id.'/edit') }}" href="#"><i class="dw dw-edit2"></i> Edit</a>
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
    {{-- ubah form input ini menjadi form input dan edit, keterangan input atau edit diset lewat jquery.
        pemanggilan input lewat button tambah penerima, menyiapkan form untuk input dengan ngeset action form ke insert, dan keterangan form input.
        trigger edit lewat menu edit di data row. Menyiapkan form untuk edit dengan mengeset action form ke update, populating old values, dan keterangan form edit.--}}
        <div class="pd-20 card-box mb-30" id="form-box">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4 judul-form"></h4>{{--set judul form--}}
                    <p class="mb-30 ket-form"></p>{{--set keterangan form, +edit data {{nama_penerima}} --}}
                </div>

            </div>
            <form name="input-penerima" id="input-penerima" method="POST" action="" enctype="multipart/form-data">
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
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="carouselPenerima" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselPenerima" data-slide-to="0"></li>
                                        <li data-target="#carouselPenerima" data-slide-to="1"></li>
                                        <li data-target="#carouselPenerima" data-slide-to="2"></li>
                                        <li data-target="#carouselPenerima" data-slide-to="3"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-50 h-50 ft-Penerima" id="ft-penerima" src="" alt="Foto Penerima" onerror="this.onerror=null;this.src='{{asset('admin/vendors/images/img404.gif')}}';" >
                                            {{-- <img class="d-block w-50 h-50 gambar-penerima" src="" alt="Foto Penerima" onerror="this.onerror=null;this.src='{{asset('admin/vendors/images/img404.gif')}}';"> --}}
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5 class="color-black">Foto Penerima</h5>
                                                {{-- <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p> --}}
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-50 h-50 gambar-ktp" src="" alt="Foto KTP" onerror="this.onerror=null;this.src='{{asset('admin/vendors/images/img404.gif')}}';">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5 class="color-black">Foto KTP</h5>
                                                {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> --}}
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-50 h-50 gambar-kk" src="" alt="Foto KK" onerror="this.onerror=null;this.src='{{asset('admin/vendors/images/img404.gif')}}';">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5 class="color-black">Foto Kartu Keluarga</h5>
                                                {{-- <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p> --}}
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-50 h-50 gambar-rumah" src="" alt="Foto Rumah" onerror="this.onerror=null;this.src='{{asset('admin/vendors/images/img404.gif')}}';">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5 class="color-black">Foto Rumah</h5>
                                                {{-- <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselPenerima" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselPenerima" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <table class="table table-striped table-responsive table-bordered tableView">
                                    <tbody>
                                    <tr>
                                        <td><strong>Nama</strong></td>
                                        <td style="text-align: center;" valign="middle" id="nama"></td>
                                        <td><strong>Penyakit</strong></td>
                                        <td style="text-align: center;" valign="middle" id="penyakit"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nomor Induk Kependudukan</strong></td>
                                        <td style="text-align: center;" valign="middle" id="nik"></td>
                                        <td><strong>Status Kepemilikan Rumah</strong></td>
                                        <td style="text-align: center;" valign="middle" id="status"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tangal Lahir (Umur</strong>)</td>
                                        <td style="text-align: center;" valign="middle" id="tgl"></td>
                                        <td><strong>Pekerjaan</strong></td>
                                        <td style="text-align: center;" valign="middle" id="pekerjaan"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jenis Kelamin</strong></td>
                                        <td style="text-align: center;" valign="middle" id="jk"></td>
                                        <td><strong>Alamat</strong></td>
                                        <td style="text-align: center;" valign="middle" id="alamat"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Lokasi</strong></td>
                                        <td style="text-align: center;" valign="middle"><a target=”_blank” id="lokasi" href=""><u></u></a> </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    {{-- akhir modal view --}}

    {{-- modal edit --}}
        {{-- <div class="modal fade bs-example-modal-lg" id="edit-penerima" tabindex="-1"
            role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" > --}}
        {{-- <div class=" bs-example-modal-lg" id="edit-penerima"  >
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Edit Data Penerima Bantuan
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nama">Penyakit</label>
                                    <input type="text" class="form-control" name="penyakit">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nama">Nomor Induk Kependudukan</label>
                                    <input type="text" class="form-control" name="nik">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nama">Status Kepemilikan Rumah</label>
                                    <input type="Radio" class="form-control" name="status_rumah">Milik Sendiri
                                </div>
                            </div>
                        </div>



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
        </div> --}}
    {{-- akhir modal edit --}}
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
                $("#form-box").hide();
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

                            var dob = new Date(data.bd);

                            //calculate month difference from current date in time
                            var month_diff = Date.now() - dob.getTime();

                            //convert the calculated difference in date format
                            var age_dt = new Date(month_diff);

                            //extract year from date
                            var year = age_dt.getUTCFullYear();

                            //now calculate the age of the user
                            var umur = Math.abs(year - 1970);

                            $('.tableView #tgl').text(data.bd +' ('+ umur+' Tahun)');
                            $('.tableView #ktp').text(data.foto_ktp);
                            $('.tableView #pekerjaan').text(data.pekerjaan);
                            $('.tableView #ft_kk').text(data.foto_kk);
                            $('.tableView #jk').text(data.jenkel);
                            $('.tableView #ft_rmh').text(data.foto_rumah);
                            $('.tableView #alamat').text(data.alamat+" RT "+data.rts.nama_rt+", Kelurahan "+data.rts.kelurahans.nama_kel+", "+"Kecamatan "+data.rts.kelurahans.kecamatans.nama_kec+".");
                            $('.tableView #lokasi').attr("href", 'https://www.google.com/maps/search/?api=1&query='+data.lat+','+data.long );
                            $('.tableView #lokasi').children('u').text('Tautan Lokasi Google Map' );
                            var linkAsset = "{{asset('storage')}}";
                            $('#carouselPenerima #ft-penerima').attr("src", data.foto_penerima != null ? linkAsset+"/foto_penerima/"+ data.foto_penerima : '');
                            $('#carouselPenerima #gambar-ktp').attr("src", data.foto_ktp != null ? linkAsset+"/foto_penerima/"+ data.foto_ktp : '');
                            $('#carouselPenerima #gambar-kk').attr("src", data.foto_kk != null ? linkAsset+"/foto_penerima/"+ data.foto_kk : '');
                            $('#carouselPenerima #gambar-rumah').attr("src", data.foto_rumah != null ? linkAsset+"/foto_penerima/"+ data.foto_rumah : '');
                    })
                });
            });
            $("#tambah-button").click(function(){
                $(".text-blue,.judul-form").text('Input Data Penerima');
                $(".ket-form").text('Mengajukan penerima Rantang Kasih');
                $("#input-penerima").attr("action","{{route('receptions.store')}}");
                $("#form-box").show();
                $("#data-box").hide();
            });

        </script>
        @include('peta.index')
        @include('aplikasi.dropdown')
@endsection
