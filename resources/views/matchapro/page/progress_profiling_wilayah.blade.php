@extends('matchapro/layouts/contentLayoutMaster')

@section('title', 'Progress Profiling - Wilayah')

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('content')

<div class="row match-height">
    <div class="col-lg-8 col-md-8 col-12">
        <div class="card card-statistics">
            <div class="card-header">
                <h4 class="card-title">Statistics Profiling</h4>
                <div class="d-flex align-items-center">
                    <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
                </div>
            </div>
            <div class="card-body statistics-body">
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                        <div class="d-flex flex-row">
                            <div class="avatar bg-light-primary me-2">
                                <div class="avatar-content">
                                    <i data-feather="trending-up" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0">230k</h4>
                                <p class="card-text font-small-3 mb-0">Open</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                        <div class="d-flex flex-row">
                            <div class="avatar bg-light-info me-2">
                                <div class="avatar-content">
                                    <i data-feather="user" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0">8.549k</h4>
                                <p class="card-text font-small-3 mb-0">Draft</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                        <div class="d-flex flex-row">
                            <div class="avatar bg-light-danger me-2">
                                <div class="avatar-content">
                                    <i data-feather="box" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0">1.423k</h4>
                                <p class="card-text font-small-3 mb-0">Submitted</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="d-flex flex-row">
                            <div class="avatar bg-light-success me-2">
                                <div class="avatar-content">
                                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0">$9745</h4>
                                <p class="card-text font-small-3 mb-0">Approved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-4">
        <div class="card mb-6">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    FILTER DATA
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-6">
                    <label class="form-label" for="provinsi">Provinsi <span class="text-danger">*</span></label>
                    <select id="provinsi" class="select2 form-select">
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach($masterProvinsi as $option)
                        <option value="{{ $option->id }}">{{ $option->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6" id="container-kabupaten-kota">
                    <label class="form-label" for="kabupaten_kota">Kabupaten/Kota <span
                            class="text-danger">*</span></label>
                    <select id="kabupaten_kota" class="select2 form-select">
                        <option value="">-- Pilih Kabupaten/Kota --</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label class="form-label" for="tahun_referensi">Tahun Profiling <span
                            class="text-danger">*</span></label>
                    <select id="tahun_referensi" class="select2 form-select">
                        <option value="">-- Pilih Tahun --</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row match-height">
    <div class="col-lg-4 col-md-6 col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Profiling Overview</h4>
                <i data-feather="help-circle" class="font-medium-3 text-muted cursor-pointer"></i>
            </div>
            <div class="card-body p-0">
                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                <div class="row border-top text-center mx-0">
                    <div class="col-6 border-end py-1">
                        <p class="card-text text-muted mb-0">Completed</p>
                        <h3 class="fw-bolder mb-0">786,617</h3>
                    </div>
                    <div class="col-6 py-1">
                        <p class="card-text text-muted mb-0">In Progress</p>
                        <h3 class="fw-bolder mb-0">13,561</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-6 col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Profiling Progress</h4>
                <i data-feather="help-circle" class="font-medium-3 text-muted cursor-pointer"></i>
            </div>
            <div class="card-body p-0">
                <div style="margin: 10px !important;">
                    <ul class="list-unstyled">
                        <li>Kalau User Level Pusat, yang ditampikan barchart provinsi</li>
                        <li>Kalau User Level Provinsi, yang ditampikan barchart kabupaten/kota</li>
                        <li>Kalau User Level Kabupaten/Kota, yang ditampikan barchart per user</li>
                    </ul>
                </div>
                <div id="progress-profiling-chart" class="my-2"></div>            
            </div>
        </div>
    </div>
</div>

@endsection

@section('vendor-script')
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
@endsection

@section('page-script')
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script>
    $(document).ready(function () {
        $(".select2").select2();
        var $goalStrokeColor2 = '#51e5a8';
        var $strokeColor = '#ebe9f1';
        var $textHeadingColor = '#5e5873';
        var $goalOverviewChart = document.querySelector('#goal-overview-radial-bar-chart');
        var goalOverviewChartOptions = {
            chart: {
                height: 245,
                type: 'radialBar',
                sparkline: {
                    enabled: true
                },
                dropShadow: {
                    enabled: true,
                    blur: 3,
                    left: 1,
                    top: 1,
                    opacity: 0.1
                }
            },
            colors: [$goalStrokeColor2],
            plotOptions: {
                radialBar: {
                    offsetY: -10,
                    startAngle: -150,
                    endAngle: 150,
                    hollow: {
                        size: '77%'
                    },
                    track: {
                        background: $strokeColor,
                        strokeWidth: '50%'
                    },
                    dataLabels: {
                        name: {
                            show: false
                        },
                        value: {
                            color: $textHeadingColor,
                            fontSize: '2.86rem',
                            fontWeight: '600'
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'horizontal',
                    shadeIntensity: 0.5,
                    gradientToColors: [window.colors.solid.success],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100]
                }
            },
            series: [83],
            stroke: {
                lineCap: 'round'
            },
            grid: {
                padding: {
                    bottom: 30
                }
            }
        };
        goalOverviewChart = new ApexCharts($goalOverviewChart, goalOverviewChartOptions);
        goalOverviewChart.render();


        // Create Stacked Bar Chart for Progress Profiling
        var progressProfilingChartOptions = {
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                },
            },
            series: [{
                name: 'OPEN',
                data: [44, 55, 41, 67, 22, 43]
            }, {
                name: 'DRAFT',
                data: [13, 23, 20, 8, 13, 27]
            }, {
                name: 'SUBMITTED',
                data: [11, 17, 15, 15, 21, 14]
            }],
            xaxis: {
                categories: ['Kab 1', 'Kab 2', 'Kab 3', 'Kab 4', 'Kab 5', 'Kab 6'],
            },
            legend: {
                position: 'top',
                horizontalAlign: 'left'
            },
            fill: {
                opacity: 1
            },
            colors: [window.colors.solid.primary, window.colors.solid.info, window.colors.solid.warning]
        };

        var progressProfilingChart = new ApexCharts(document.querySelector("#progress-profiling-chart"), progressProfilingChartOptions);
        progressProfilingChart.render();
        
    });

</script>
@endsection
