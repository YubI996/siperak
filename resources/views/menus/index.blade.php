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
@section('title', 'Menu')
@section('item')
    <a href="{{route('home2')}}">Home</a>
@endsection

@section('papan-kanan')
    <button id="tambah-button" type="button" class="btn btn-outline-primary pull-right">Tambah Menu</button>
    <button id="kembali-button" type="button" class="btn btn-outline-secondary pull-right">Batal</button>
@endsection

@section('item-active', 'Menu')

@section('content')
    <!-- Simple Datatable start -->
        <div class="card-box mb-30" id="data-box">
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th>Pokmas</th>
                            <th>Waktu</th>
                            <th>Tanggal</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menu as $data)
                            <tr>
                            <td>{{$data->Pokmas->nama}}</td>
                            <td>{{"Makan ".$data->waktu}}</td>
                            <td>{{__(date_format($data->created_at,"l, d F Y H:i:s"))}}</td>
                            {{-- <td>{{$data->Histories[0]->status_trima ?? 'Data tidak ada.'}}</td> --}}
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item view-data" id="{{$data->id}}" url="{{ url('menus', $data->id) }}" href="#"  data-toggle="modal" data-target="#view-menu"><i class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item edit-data" id="edit-{{$data->id}}" url="{{ route('menus.edit', $data->id) }}" aksi="{{ route('menus.update', $data->id) }}" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                        <a class="dropdown-item delete-data" href="#" data-toggle="modal" url="{{ route('menus.destroy', $data->id) }}" idx="{{$data->id}}" data-target="#confirm-hapus"><i class="dw dw-delete-3"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <center><h4>Tidak ada data menu.</h4></center>
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
            <form name="input-menu" id="input-menu" method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Pokmas</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select" name="pokmas" id="pokmas">
                            <option value="0">-=Pilih Pokmas...</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Unsur Karbohidrat</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" type="text" placeholder="Unsur Karbohidrat" id="karbo" name="karbo"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Unsur Protein Hewani</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" type="text" placeholder="Unsur Protein Hewani" id="l_hewani" name="l_hewani"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Unsur Protein Nabati</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" type="text" placeholder="Unsur Protein Nabati" id="l_nabati" name="l_nabati"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Unsur Sayur</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" type="text" placeholder="Unsur Sayur" id="sayur" name="sayur"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Unsur Buah</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" type="text" placeholder="Unsur Buah" id="buah" name="buah"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Waktu</label>
                    <div class="col-sm-12 col-md-10">
                        <select class="custom-select" name="waktu" id="waktu">
                            <option value="Siang">Makan Siang</option>
                            <option value="Malam">Makan Malam</option>
                            {{-- @forelse ($kecs as $dc) --}}
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Foto</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="file" accept="image/*" capture="environment" name="foto" required/>
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

    {{-- modal view --}}
        <div class="modal fade bs-example-modal-lg" id="view-menu" tabindex="-1"
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
                            <div style="display: flex;justify-content: center;" class="col-lg-12 col-md-12 col-sm-12">
                                <img class="d-block w-50 h-50 ft-menu" id="ft-menu" src="" alt="Foto Menu" >
                            </div>
                        </div>

                        <div class="row" style="display: flex;justify-content: center;">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <table class="table table-striped table-bordered tableView">
                                    <tbody>
                                    <tr>
                                        <td><strong>Pokmas</strong></td>
                                        <td style="text-align: center;" valign="middle" id="Pokmas"></td>
                                        <td><strong>Waktu</strong></td>
                                        <td style="text-align: center;" valign="middle" id="waktu"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Unsur Karbohidrat</strong></td>
                                        <td style="text-align: center;" valign="middle" id="karbo"></td>
                                        <td><strong>Sayur</strong></td>
                                        <td style="text-align: center;" valign="middle" id="sayur"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Unsur Protein Hewani</td>
                                        <td style="text-align: center;" valign="middle" id="l_hewani"></td>
                                        <td><strong>Unsur Protein Nabati</strong></td>
                                        <td style="text-align: center;" valign="middle" id="l_nabati"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Buah</strong></td>
                                        <td style="text-align: center;" valign="middle" id="buah"></td>
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
                    var menuURL = $(this).attr('url');
                    $.get(menuURL, function (data) {
                        // console.log();
                            // $('#userShowModal').modal('show');
                            $('.tableView #karbo').text(data.karbo);
                            $('.tableView #l_hewani').text(data.l_hewani);
                            $('.tableView #l_nabati').text(data.l_nabati);
                            $('.tableView #sayur').text(data.sayur);
                            $('.tableView #buah').text(data.buah);
                            $('.tableView #Pokmas').text(data.pokmas.nama);
                            $('.tableView #waktu').text('Makan '+data.waktu);
                            var linkAsset = "{{asset('storage/menu')}}";
                            $('#ft-menu').attr("src",  '');
                            $('#ft-menu').attr("src", data.foto != null ? linkAsset+"/"+ data.foto : "{{asset('admin/vendors/images/img404.gif')}}");
                            console.log(linkAsset+"/menu/"+ data.foto);
                    })
                });
            $("#tambah-button").click(function(){

                $(".text-blue,.judul-form").text('Input Data Menu');
                $(".ket-form").text('Mengajukan Menu Rantang Kasih');
                $("#input-menu").attr("action","{{route('menus.store')}}");
                var patcher = $(".patcher");
                if (jQuery.contains(document, patcher[0])) {
                    // $("#input-penerima").remove($(".patcher"));
                    patcher.remove();
                }
                $("#form-box").show();
                $("#data-box").hide();
                $("#tambah-button").hide();
                $("#kembali-button").show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                    $.ajax({
                        url: '{{route("api.pokmas")}}',
                        success: function(response) {
                            $('#pokmas').empty();
                            console.log(response);
                            $.each(response, function(id, name) {
                                $('#pokmas').append(new Option(name, id))
                            })
                        }
                    })
            });
            $(".edit-data").click(function(){
                // conditioning
                $(".text-blue,.judul-form").text('Edit Data Menu');
                $(".ket-form").text('Mengubah Data Menu Rantang Kasih');
                var url_edit = $(this).attr('aksi');
                $("#input-menu").attr("action", url_edit);
                $("#input-menu").append('<input class="patcher" type="hidden" name="_method" value="patch">');
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
