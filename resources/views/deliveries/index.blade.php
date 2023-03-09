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
@section('title', 'Pengantaran')
@section('item')
    <a href="{{route('home2')}}">Home</a>
@endsection

@section('papan-kanan')
    <button id="tambah-button" type="button" class="btn btn-outline-primary pull-right">Tambah Pengantaran</button>
    <button id="kembali-button" type="button" class="btn btn-outline-secondary pull-right">Batal</button>
@endsection

@section('item-active', 'Pengantaran')

@section('content')
    <!-- Simple Datatable start -->
        <div class="card-box mb-30" id="data-box">
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">Pengantaran</th>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th>Alamat</th>
                            <th>Penyakit</th>
                            <th>Status</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($Dvs as $data)
                            <tr>
                            <td class="table-plus">
                                <img class="border-radius-100 shadow" style="max-height: 12vh; max-width:7vw" src="{{$data->foto_Pengantaran != null ? asset('storage/foto_Pengantaran/'.$data->foto_Pengantaran) : asset('admin/vendors/images/img404.gif')}}" alt="">
                            </td>
                            <td>{{$data->Pengantaran}}</td>
                            <td>{{$data->menu}} Tahun</td>
                            <td>{{$data->pengantar}}</td>
                            <td>{{$data->status}}</td>
                            <td>{{$data->pengaduan}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item view-data" id="{{$data->id}}" url="{{ url('recipients', $data->id) }}" href="#"  data-toggle="modal" data-target="#view-Pengantaran"><i class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item edit-data" id="edit-{{$data->id}}" url="{{ route('recipients.edit', $data->id) }}" aksi="{{ route('recipients.update', $data->id) }}" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                        <a class="dropdown-item delete-data" href="#" data-toggle="modal" url="{{ route('recipients.destroy', $data->id) }}" idx="{{$data->id}}" data-target="#confirm-hapus"><i class="dw dw-delete-3"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <center><h4>Tidak ada data Pengantaran.</h4></center>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    <!-- Simple Datatable End -->

    <!-- form input Pengantaran-->
    {{-- ubah form input ini menjadi form input dan edit, keterangan input atau edit diset lewat jquery.
        pemanggilan input lewat button tambah Pengantaran, menyiapkan form untuk input dengan ngeset action form ke insert, dan keterangan form input.
        trigger edit lewat menu edit di data row. Menyiapkan form untuk edit dengan mengeset action form ke update, populating old values, dan keterangan form edit.--}}
        <div class="pd-20 card-box mb-30" id="form-box">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4 judul-form"></h4>{{--set judul form--}}
                    <p class="mb-30 ket-form"></p>{{--set keterangan form, +edit data {{nama_Pengantaran}} --}}
                </div>

            </div>
            <form name="input-Pengantaran" id="input-Pengantaran" method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Penerima</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select" name="penerima" id="penerima">
                            <option selected="0">Pilih penerima...</option>
                            {{-- @forelse ($kecs as $dc) --}}
                            {{-- <option value="{{$dc->id}}">Kecamatan {{$dc->nama_kec}}</option> --}}
                            {{-- @empty --}}
                            <option value="">Data Penerima tidak ditemukan</option>
                            {{-- @endforelse --}}
                        </select>
                    </div>
                </div>
                <input class="form-control" type="hidden" id="menu" name="menu" value="10"/>
                <input class="form-control" type="hidden" id="pengantar" name="pengantar" value="4"/>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Status Pengantaran</label>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="Belum diantar" name="status"
                                    class="custom-control-input" value="Belum diantar" />
                                <label class="custom-control-label" for="Belum diantar">Belum Diantarkan.</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="Sudah diantar" name="status"
                                    class="custom-control-input" value="Sudah diantar" />
                                <label class="custom-control-label" for="Sudah diantar">Sudah Diantarkan.</label>
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
                        <input type="file" class="form-control-file form-control height-auto" name="dok" id="dok"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Total konsumsi karbohidrat</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="karbo_consmd" value="0.5" step="0.25" type="range" min="0" max="1" oninput="this.nextElementSibling.value = this.value">
                        <output></output>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Total konsumsi Protein Hewani</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="l_hwn_consmd" value="0.5" step="0.25" type="range" min="0" max="1" oninput="this.nextElementSibling.value = this.value">
                        <output></output>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Total konsumsi Protein Nabati</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="l_nbt_consmd" value="0.5" step="0.25" type="range" min="0" max="1" oninput="this.nextElementSibling.value = this.value">
                        <output></output>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Total konsumsi Sayur</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="sayur_consmd" value="0.5" step="0.25" type="range" min="0" max="1" oninput="this.nextElementSibling.value = this.value">
                        <output></output>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Total konsumsi Buah</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" name="buah_consmd" value="0.5" step="0.25" type="range" min="0" max="1" oninput="this.nextElementSibling.value = this.value">
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
    <!-- akhir form input Pengantaran -->

    {{-- modal view --}}
        <div class="modal fade bs-example-modal-lg" id="view-Pengantaran" tabindex="-1"
            role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Biodata Pengantaran Bantuan
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="carouselPengantaran" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselPengantaran" data-slide-to="0"></li>
                                        <li data-target="#carouselPengantaran" data-slide-to="1"></li>
                                        <li data-target="#carouselPengantaran" data-slide-to="2"></li>
                                        <li data-target="#carouselPengantaran" data-slide-to="3"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-50 h-50 ft-Pengantaran" id="ft-Pengantaran" src="" alt="Foto Pengantaran" >
                                            {{-- <img class="d-block w-50 h-50 gambar-Pengantaran" src="" alt="Foto Pengantaran" onerror="this.onerror=null;this.src='{{asset('admin/vendors/images/img404.gif')}}';"> --}}
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5 class="">Foto Pengantaran</h5>
                                                {{-- <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p> --}}
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-50 h-50 gambar-ktp" src="" alt="Foto KTP">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5 class="">Foto KTP</h5>
                                                {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> --}}
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-50 h-50 gambar-kk" src="" alt="Foto KK">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5 class="">Foto Kartu Keluarga</h5>
                                                {{-- <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p> --}}
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-50 h-50 gambar-rumah" src="" alt="Foto Rumah">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5 class="">Foto Rumah</h5>
                                                {{-- <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselPengantaran" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselPengantaran" role="button" data-slide="next">
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
                                        <td style="text-align: center;" valign="middle"><a target="_blank" id="lokasi" href=""><u></u></a> </td>
                                        <td><strong>Nomor HP</strong></td>
                                        <td style="text-align: center;" valign="middle" id="hp"></td>
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

    {{-- modal hapus --}}
        <div class="modal fade" id="confirm-hapus" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content bg-danger text-white">
                    <div class="modal-body text-center">
                        <h3 class="text-white mb-15">
                            <i class="fa fa-exclamation-triangle"></i> KONFIRMASI
                        </h3>
                        <p>
                            Anda akan menghapus data <strong></strong>.
                        </p>
                        <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto">
                            <div class="col-6">
                                <button type="button"
                                    class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i>
                                </button>

                            </div>
                            <div class="col-6">
                                <button type="button"
                                    class="btn btn-primary border-radius-100 btn-block confirmation-btn confirm-hapus"
                                    data-dismiss="modal" url="" idx="">
                                    <i class="fa fa-check"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- akhir modal hapus --}}
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
                $("#tambah-button").click;
                $("#kembali-button").hide();

                // $("#myWish").click(function showAlert() {
                //     $("#alert").fadeTo(10000, 10000).slideUp(10000, function() {
                //     $("#alert").slideUp(10000);
                //     });
                // });


            });
            $(".delete-data").click(function(){
                $(".confirm-hapus").attr("url", $(this).attr('url'));
                $(".confirm-hapus").attr("idx", $(this).attr('idx'));
            });
            $(".confirm-hapus").click(function(){
                var url_hapus = $(this).attr("url");
                var idx =  $(this).attr("idx");
                console.log(url_hapus);
                $.ajax({
                    type: "delete",
                    // headers: {
                    //     'X-CSRF-TOKEN': '{{csrf_token()}}'
                    // },
                    url: url_hapus,
                    dataType: "json",
                    data: {
                        // _method: 'delete',
                        idx: idx,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function(response) {

                    }
                });
            });

            $(".view-data").click(function(){
                    // $('body').on('click', '#view-data', function (){
                    var userURL = $(this).attr('url');
                    $.get(userURL, function (data) {
                        data = data.Pengantaran
                        // console.log(data);
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
                            $('.tableView #hp').text(data.no_hp);
                            $('.tableView #ft_kk').text(data.foto_kk);
                            $('.tableView #jk').text(data.jenkel);
                            $('.tableView #ft_rmh').text(data.foto_rumah);
                            $('.tableView #alamat').text(data.alamat+" RT "+data.rts.nama_rt+", Kelurahan "+data.rts.kelurahan.nama_kel+", "+"Kecamatan "+data.rts.kelurahan.kecamatan.nama_kec+".");
                            $('.tableView #lokasi').attr("href", 'https://www.google.com/maps/place/'+data.lat+','+data.long+'/@'+data.lat+','+data.long+'/data=!3m1!1e3');
                            // $('.tableView #lokasi').attr("href", 'https://www.google.com/maps/search/?api=1&query='+data.lat+','+data.long );
                            $('.tableView #lokasi').children('u').text('Tautan Lokasi Google Map' );
                            var linkAsset = "{{asset('storage')}}";
                            $('#carouselPengantaran #ft-Pengantaran').attr("src",  '');
                            $('#carouselPengantaran #ft-Pengantaran').attr("src", data.foto_Pengantaran != null ? linkAsset+"/foto_Pengantaran/"+ data.foto_Pengantaran : "{{asset('admin/vendors/images/img404.gif')}}");
                            $('#carouselPengantaran .gambar-ktp').attr("src",  '');
                            $('#carouselPengantaran .gambar-ktp').attr("src", data.foto_ktp != null ? linkAsset+"/foto_ktp/"+ data.foto_ktp : "{{asset('admin/vendors/images/img404.gif')}}");
                            $('#carouselPengantaran .gambar-kk').attr("src",  '');
                            $('#carouselPengantaran .gambar-kk').attr("src", data.foto_kk != null ? linkAsset+"/foto_kk/"+ data.foto_kk : "{{asset('admin/vendors/images/img404.gif')}}");
                            $('#carouselPengantaran .gambar-rumah').attr("src",  '');
                            $('#carouselPengantaran .gambar-rumah').attr("src", data.foto_rumah != null ? linkAsset+"/foto_rumah/"+ data.foto_rumah : "{{asset('admin/vendors/images/img404.gif')}}");
                    })
            });

            $("#tambah-button").click(function(){

                $(".text-blue,.judul-form").text('Input Data Pengantaran');
                $(".ket-form").text('Mendaftarkan Pengantaran Rantang Kasih');
                $("#input-Pengantaran").attr("action","{{route('deliveries.store')}}");
                var patcher = $(".patcher");
                if (jQuery.contains(document, patcher[0])) {
                    // $("#input-Pengantaran").remove($(".patcher"));
                    patcher.remove();
                }
                $.ajax({
                    url: "{{url('fetch-penerima')}}",
                    type: "GET",
                    // data: {
                    //     _token: '{{csrf_token()}}'
                    // },
                    dataType: 'json',
                    success: function (result) {
                        // console.log(result.includes("error"));
                        if (result.includes("error")) {
                            alert("Data penerima dalam kelurahan tidak ditemukan");
                        } else {
                            $('#penerima').html('<option value="">-- Pilih Penerima --</option>');
                            $.each(result, function (key, value) {
                                const PenerimaOption = '<option value="' + value.id + '" >'  + value.nama + '</option>';
                                $("#penerima").append(PenerimaOption);
                            });
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log('Error:', errorThrown);
                    }
                });
                $("#form-box").show();
                $("#data-box").hide();
                $("#tambah-button").hide();
                $("#kembali-button").show();
            });

            $(".edit-data").click(function(){
                // conditioning
                $(".text-blue,.judul-form").text('Edit Data Pengantaran');
                $(".ket-form").text('Mengubah Data Pengantaran Rantang Kasih');
                var url_edit = $(this).attr('aksi');
                $("#input-Pengantaran").attr("action", url_edit);
                $("#input-Pengantaran").append('<input class="patcher" type="hidden" name="_method" value="patch">');
                $("#form-box").show();
                $("#data-box").hide();
                $("#tambah-button").hide();
                $("#kembali-button").show();
                // EO conditioning

                // populating fields
                var userURL = $(this).attr('url');
                $.get(userURL, function (data) {
                    data = data.Pengantaran
                    // console.log(data);
                $("#nama").val(data.nama);
                $("#bd").val(data.bd);
                if (data.jenkel == 'Laki-laki') {
                    $("#jk1").attr("checked", true);
                }else{
                    $("#jk2").attr("checked", true);
                }
                $("#nik").val(data.nik);
                $("#alamat").val(data.alamat);
                $("#pekerjaan").val(data.pekerjaan);
                $("#penyakit").val(data.penyakit);
                $("#hp").val(data.no_hp);
                // $("#ft_p").val(data.foto_Pengantaran);
                // $("#ft_ktp").val(data.foto_ktp);
                // $("#ft_kk").val(data.foto_kk);
                // $("#ft_rumah").val(data.foto_rumah);
                switch (data.status_rumah) {
                    case 'Milik Sendiri':
                        $("#tmpt1").attr("checked", true);
                        break;
                    case 'Mengontrak/Menyewa':
                        $("#tmpt2").attr("checked", true);
                        break;
                    case 'Menumpang':
                        $("#tmpt3").attr("checked", true);
                        break;
                    default:
                        break;
                }
                // $("#tmpt2").attr("checked", true);
                // $("#tmpt3").attr("checked", true);
                $("#kec").val(data.rts.Kelurahan.kecamatan_id);
                $("#kec option[value='"+data.rts.Kelurahan.kecamatan_id+"']").attr("selected",true);
                popKel(data.rts.Kelurahan.kecamatan_id, data.rts.kelurahan_id);
                $("#kel").val(data.rts.kelurahan_id);
                $("#kel option[value='"+data.rts.kelurahan_id+"']").attr("selected",true);
                popRt(data.rts.kelurahan_id, data.rts.id);
                // console.log($("#kel").value);
                $("#rt").val(data.rts.id);
                $("#rt option[value='"+data.rts.id+"']").attr("selected",true);
                // console.log(data.long);
                $("#alasan").val(data.histories[0].alasan);
                $("#long").val(data.long);
                $("#lat").val(data.lat);
                markerPengantaran(data.lat, data.long)
                })
                // EO populating fields
            });

            $("#kembali-button").click(function(){
                $("#form-box").hide();
                $("#data-box").show();
                $("#tambah-button").show();
                $("#kembali-button").hide();
                $('input').each(function() {
                    $(this).val("");
                    console.log($(this));
                });
            });

        </script>
        {{-- @include('peta.index')
        @include('aplikasi.dropdown') --}}
@endsection
