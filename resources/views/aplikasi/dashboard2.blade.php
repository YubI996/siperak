@extends('admin::layouts.app')

@section('custom-css')
    <link rel="stylesheet" type="text/css" href="{{asset("admin/src/plugins/datatables/css/dataTables.bootstrap4.min.css")}}" />
	<link rel="stylesheet" type="text/css" href="{{asset("admin/src/plugins/datatables/css/responsive.bootstrap4.min.css")}}" />
@endsection

@section('content')
        <div class="title pb-20">
            <h2 class="h3 mb-0">SIPeRaK Overview</h2>
        </div>

        <div class="row pb-10">
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="font-14 text-secondary weight-500">
                                Jumlah Penerima
                            </div>
                            <div class="weight-700 font-24 text-dark">{{count_active_recipient()}} Orang</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#ff5b5b">
                                <span class="icon-copy ti-heart"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="font-14 text-secondary weight-500">
                                Rata-rata Umur Penerima
                            </div>
                            <div class="weight-700 font-24 text-dark">{{avg_age()}} Tahun</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#f7e02d">
                                <span class="icon-copy ti-calendar"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="font-14 text-secondary weight-500">
                                Jumlah Pokmas
                            </div>
                            <div class="weight-700 font-24 text-dark">{{get_pokmas()}}</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#09cc06">
                                <i class="icon-copy fa fa-group" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="font-14 text-secondary weight-500">Sebaran Kelurahan</div>
                            <div class="weight-700 font-24 text-dark">{{count_kel()}} Kelurahan</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#2634f0">
                                <i class="icon-copy fa fa-bandcamp" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-20">
                <div class="card-box height-100-p pd-20 min-height-200px">
                    <div class="d-flex justify-content-between pb-10">
                        <div class="h5 mb-0">Kepemilikan Tempat Tinggal</div>
                    </div>
                    <div class="bagan">
                        <div id="rumah"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-20">
                <div class="card-box height-100-p pd-20 min-height-200px">
                    <div class="d-flex justify-content-between">
                        <div class="h5 mb-0">Jenis Kelamin</div>
                    </div>

                    <div id="jenkel"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mb-20">
                <div class="card-box height-100-p pd-20 min-height-200px">
                    <div class="d-flex justify-content-between">
                        <div class="h5 mb-0">Data Penyakit</div>
                    </div>
                    @php
                        $penyakit_count = get_penyakit_count();
                    @endphp
                    <div>
                        <div id="penyakit"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pb-10">
            <div class="col-md-12 mb-20">
                <div class="card-box height-100-p pd-20">
                    <div class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
                        <div class="h5 mb-md-0">Aktivitas Penerimaan</div>
                        <div class="form-group mb-md-0">
                            <select class="form-control form-control-sm selectpicker">
                                <option value="">Last Week</option>
                                <option value="">Last Month</option>
                                <option value="">Last 6 Month</option>
                                <option value="">Last 1 year</option>
                            </select>
                        </div>
                    </div>
                    <div id="aktivitas"></div>
                </div>
            </div>
            {{-- <div class="col-md-4 mb-20">
                <div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="#455a64">
                    <div class="d-flex justify-content-between pb-20 text-white">
                        <div class="icon h1 text-white">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <!-- <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i> -->
                        </div>
                        <div class="font-14 text-right">
                            <div><i class="icon-copy ion-arrow-up-c"></i> 2.69%</div>
                            <div class="font-12">Since last month</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="text-white">
                            <div class="font-14">Appointment</div>
                            <div class="font-24 weight-500">1865</div>
                        </div>
                        <div class="max-width-150">
                            <div id="appointment-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="card-box min-height-200px pd-20" data-bgcolor="#265ed7">
                    <div class="d-flex justify-content-between pb-20 text-white">
                        <div class="icon h1 text-white">
                            <i class="fa fa-stethoscope" aria-hidden="true"></i>
                        </div>
                        <div class="font-14 text-right">
                            <div><i class="icon-copy ion-arrow-down-c"></i> 3.69%</div>
                            <div class="font-12">Since last month</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="text-white">
                            <div class="font-14">Surgery</div>
                            <div class="font-24 weight-500">250</div>
                        </div>
                        <div class="max-width-150">
                            <div id="surgery-chart"></div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>


        <div class="table-responsive">
            <table class="data-table table nowrap">
                <thead>
                <tr>
                    <th class="table-plus">Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Umur</th>
                    <th>Penyakit</th>
                    <th>Admit Date</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="table-plus">
                    <div class="name-avatar d-flex align-items-center">
                        <div class="avatar mr-2 flex-shrink-0">
                        <img src="{{asset("admin/vendors/images/photo4.jpg")}}" class="border-radius-100 shadow" width="40" height="40" alt="" />
                        </div>
                        <div class="txt">
                        <div class="weight-600">Jennifer O. Oster</div>
                        </div>
                    </div>
                    </td>
                    <td>Female</td>
                    <td>45 kg</td>
                    <td>Dr. Callie Reed</td>
                    <td>19 Oct 2020</td>
                </tr>
                </tbody>
            </table>
        </div>


        {{-- <div class="title pb-20 pt-20">
            <h2 class="h3 mb-0">Quick Start</h2>
        </div>

        <div class="row">
            <div class="col-md-4 mb-20">
                <a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
                    <div class="img pb-30">
                        <img src="{{asset("admin/vendors/images/medicine-bro")}}.svg" alt="" />
                    </div>
                    <div class="content">
                        <h3 class="h4">Services</h3>
                        <p class="max-width-200">
                            We provide superior health care in a compassionate maner
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-20">
                <a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
                    <div class="img pb-30">
                        <img src="{{asset("admin/vendors/images/remedy-amico")}}.svg" alt="" />
                    </div>
                    <div class="content">
                        <h3 class="h4">Medications</h3>
                        <p class="max-width-200">
                            Look for prescription and over-the-counter drug information.
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-20">
                <a href="#" class="card-box d-block mx-auto pd-20 text-secondary">
                    <div class="img pb-30">
                        <img src="{{asset("admin/vendors/images/paper-map")}}-cuate.svg" alt="" />
                    </div>
                    <div class="content">
                        <h3 class="h4">Locations</h3>
                        <p class="max-width-200">
                            Convenient locations when and where you need them.
                        </p>
                    </div>
                </a>
            </div>
        </div> --}}
@endsection

@section('custom-scripts')
    {{-- <script src="{{asset("admin/src/plugins/apexcharts/apexcharts.min.js")}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="{{asset("admin/src/plugins/datatables/js/jquery.dataTables.min.js")}}"></script>
	<script src="{{asset("admin/src/plugins/datatables/js/dataTables.bootstrap4.min.js")}}"></script>
	<script src="{{asset("admin/src/plugins/datatables/js/dataTables.responsive.min.js")}}"></script>
	<script src="{{asset("admin/src/plugins/datatables/js/responsive.bootstrap4.min.js")}}"></script>
	{{-- <script src="{{asset("admin/vendors/scripts/dashboard3.js")}}"></script> --}}
    <script src="{{asset("admin/src/plugins/highcharts-6.0.7/code/highcharts.js")}}"></script>
	{{-- <script src="https://code.highcharts.com/highcharts-3d.js"></script> --}}
	<script src="{{asset("admin/src/plugins/highcharts-6.0.7/code/highcharts-more.js")}}"></script>
	{{-- <script src="{{asset("admin/vendors/scripts/highchart-setting.js")}}"></script> --}}
    <script>
        // chart jenkel
        let laki = {!! count_laki() !!};
        let bini = {!! count_bini() !!};
        var j_options = {
        chart: {
            type: 'pie',
        },
        series: [laki, bini],
        labels: ['Laki-laki', 'Perempuan'],
        };

        var jenkel = new ApexCharts(document.querySelector('#jenkel'), j_options);

        jenkel.render();
        // chart penyakit
        var p_options = {
        chart: {
            type: 'pie',

        },
        series: Object.values({!! json_encode($penyakit_count) !!}),
        labels: Object.keys({!! json_encode($penyakit_count) !!}),
        colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0']
        }

        var penyakit = new ApexCharts(document.querySelector("#penyakit"), p_options);
        penyakit.render();

        // chart penerimaan
        // Call the getMonthlyCounts() function to retrieve the monthly counts data
        const monthlyCounts = {!! json_encode(getMonthlyCounts('Menerima')) !!};
        const monthlyAjuanCounts = {!! json_encode(getMonthlyCounts('Diajukan')) !!};

        // Convert the data to the format expected by ApexCharts
        const chartData1 = Object.keys(monthlyCounts).map(key => ({ x: key, y: monthlyCounts[key] }));
        const chartData2 = Object.keys(monthlyAjuanCounts).map(key => ({ x: key, y: monthlyAjuanCounts[key] }));

        // Define the chart options
        const r_Options = {
        chart: {
            type: 'line'
        },
        series: [
            {
                name: 'Jumlah Penerima Bulanan',
                data: chartData1
            },
            {
                name: 'Jumlah Ajuan Bulanan',
                data: chartData2
            }
        ],
        xaxis: {
            type: 'category',
            categories: Object.keys(monthlyCounts)
        },
        yaxis: {
            min:0,
            title: {
            text: 'Jumlah'
            }
        },
         stroke: {
            curve: 'smooth'
        }
        };

        // Create an ApexCharts instance with the chart options and data
        const aktiv = new ApexCharts(document.querySelector('#aktivitas'), r_Options);

        // Render the chart
        aktiv.render();

        // Call the getStatusRumahCounts() function to retrieve the counts data
        const statusRumahCounts = {!! json_encode(getStatusRumahCounts()) !!};

        // Convert the data to the format expected by ApexCharts
        const chartData = Object.keys(statusRumahCounts).map(key => ({ x: key, y: statusRumahCounts[key] }));

        // Define the chart options
        const ru_Options = {
        // chart: {
        //     type: 'donut'
        // },
        // series: chartData,
        // labels: Object.keys(statusRumahCounts),
        // dataLabels: {
        //     enabled: true
        // },
        // plotOptions: {
        //     pie: {
        //     donut: {
        //         size: '70%'
        //     }
        //     }
        // },
        // legend: {
        //     position: 'bottom'
        // }
        chart: {
            type: 'pie',
        },
        series: Object.values({!! json_encode(getStatusRumahCounts()) !!}),
        labels: Object.keys({!! json_encode(getStatusRumahCounts()) !!}),
        colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0']

        }

        // Create an ApexCharts instance with the chart options and data
        const rumah = new ApexCharts(document.querySelector('#rumah'), ru_Options);

        // Render the chart
        rumah.render();
    </script>
@endsection
