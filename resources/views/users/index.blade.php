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
    <button id="kembali-button" type="button" class="btn btn-outline-secondary pull-right">Batal</button>
@endsection

@section('item-active', 'Penerima')

@section('content')
    <!-- Simple Datatable start -->
        <div class="card-box mb-30" id="data-box">
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>E-mail</th>
                            <th>RT</th>
                            <th>Role</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $penerima="";
                        @endphp
                        @forelse ($users as $data)
                            <tr>
                            <td>{{$data->name??"-"}}</td>
                            <td>{{$data->email??"-"}}</td>
                            <td>RT {{$data->Rts->nama_rt??"-"}}, Kelurahan {{$data->Rts->kelurahan->nama_kel??"-"}}, Kecamatan {{$data->Rts->kelurahan->kecamatan->nama_kec??"-"}}</td>
                            <td>{{$data->Role->nama}}</td>
                            {{-- <td>{{$data->Histories[0]->status_trima ?? 'Data tidak ada.'}}</td> --}}
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item view-data" id="{{$data->id}}" url="{{ url('users', $data->id) }}" href="#"  data-toggle="modal" data-target="#view-penerima"><i class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item edit-data" id="edit-{{$data->id}}" url="{{ route('users.edit', $data->id) }}" aksi="{{ route('users.update', $data->id) }}" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                        <a class="dropdown-item delete-data" href="#" data-toggle="modal" url="{{ route('users.destroy', $data->id) }}" idx="{{$data->id}}" data-target="#confirm-hapus"><i class="dw dw-delete-3"></i>
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
                    <label class="col-sm-12 col-md-2 col-form-label">E-mail</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control " placeholder="Pilih tanggal lahir" type="date" name="bd" id="bd"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Role</label>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="jk1" name="role"
                                    class="custom-control-input" value="Laki-laki" />
                                <label class="custom-control-label" for="jk1">Walikota</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="jk2" name="role"
                                    class="custom-control-input" value="Perempuan" />
                                <label class="custom-control-label" for="jk2">Admin Satu</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="jk2" name="role"
                                    class="custom-control-input" value="Perempuan" />
                                <label class="custom-control-label" for="jk2">Admin Dua</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="jk2" name="role"
                                    class="custom-control-input" value="Perempuan" />
                                <label class="custom-control-label" for="jk2">Admin Kecamatan</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="jk2" name="role"
                                    class="custom-control-input" value="Perempuan" />
                                <label class="custom-control-label" for="jk2">Admin Kelurahan</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="jk2" name="role"
                                    class="custom-control-input" value="Perempuan" />
                                <label class="custom-control-label" for="jk2">Admin Pokmas</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="jk2" name="role"
                                    class="custom-control-input" value="Perempuan" />
                                <label class="custom-control-label" for="jk2">Admin Juru Antar</label>
                            </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Kecamatan</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select" name="kec" id="kec" onchange="popKel(this.options[this.selectedIndex].value)">
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
                        <select class="custom-select col-12" name="kel" id="kel" onchange="popRt(this.options[this.selectedIndex].value)">

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Rukun Tetangga (RT)</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select col-12" name="rt" id="rt">

                        </select>
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
                        data = data.penerima
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
                            $('.tableView #jk').text(data.role);
                            $('.tableView #ft_rmh').text(data.foto_rumah);
                            $('.tableView #alamat').text(data.alamat+" RT "+data.rts.nama_rt+", Kelurahan "+data.rts.kelurahan.nama_kel+", "+"Kecamatan "+data.rts.kelurahan.kecamatan.nama_kec+".");
                            $('.tableView #lokasi').attr("href", 'https://www.google.com/maps/place/'+data.lat+','+data.long+'/@'+data.lat+','+data.long+'/data=!3m1!1e3');
                            // $('.tableView #lokasi').attr("href", 'https://www.google.com/maps/search/?api=1&query='+data.lat+','+data.long );
                            $('.tableView #lokasi').children('u').text('Tautan Lokasi Google Map' );
                            var linkAsset = "{{asset('storage')}}";
                            $('#carouselPenerima #ft-penerima').attr("src",  '');
                            $('#carouselPenerima #ft-penerima').attr("src", data.foto_penerima != null ? linkAsset+"/foto_penerima/"+ data.foto_penerima : "{{asset('admin/vendors/images/img404.gif')}}");
                            $('#carouselPenerima .gambar-ktp').attr("src",  '');
                            $('#carouselPenerima .gambar-ktp').attr("src", data.foto_ktp != null ? linkAsset+"/foto_ktp/"+ data.foto_ktp : "{{asset('admin/vendors/images/img404.gif')}}");
                            $('#carouselPenerima .gambar-kk').attr("src",  '');
                            $('#carouselPenerima .gambar-kk').attr("src", data.foto_kk != null ? linkAsset+"/foto_kk/"+ data.foto_kk : "{{asset('admin/vendors/images/img404.gif')}}");
                            $('#carouselPenerima .gambar-rumah').attr("src",  '');
                            $('#carouselPenerima .gambar-rumah').attr("src", data.foto_rumah != null ? linkAsset+"/foto_rumah/"+ data.foto_rumah : "{{asset('admin/vendors/images/img404.gif')}}");
                    })
                });
            $("#tambah-button").click(function(){

                $(".text-blue,.judul-form").text('Input Data Penerima');
                $(".ket-form").text('Mengajukan penerima Rantang Kasih');
                $("#input-penerima").attr("action","{{route('users.store')}}");
                var patcher = $(".patcher");
                if (jQuery.contains(document, patcher[0])) {
                    // $("#input-penerima").remove($(".patcher"));
                    patcher.remove();
                }
                $("#form-box").show();
                $("#data-box").hide();
                $("#tambah-button").hide();
                $("#kembali-button").show();
            });
            $(".edit-data").click(function(){
                // conditioning
                $(".text-blue,.judul-form").text('Edit Data Penerima');
                $(".ket-form").text('Mengubah Data penerima Rantang Kasih');
                var url_edit = $(this).attr('aksi');
                $("#input-penerima").attr("action", url_edit);
                $("#input-penerima").append('<input class="patcher" type="hidden" name="_method" value="patch">');
                $("#form-box").show();
                $("#data-box").hide();
                $("#tambah-button").hide();
                $("#kembali-button").show();
                // EO conditioning

                // populating fields
                var userURL = $(this).attr('url');
                $.get(userURL, function (data) {
                    data = data.penerima
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
                // $("#ft_p").val(data.foto_penerima);
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
                markerPenerima(data.lat, data.long)
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
        @include('peta.index')
        @include('aplikasi.dropdown')
@endsection
