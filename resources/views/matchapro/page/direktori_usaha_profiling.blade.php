@extends('matchapro/layouts/contentLayoutMaster')

@section('title', 'Direktori Usaha Profiling')
@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('content')
    <!-- Kick start -->
    <div class="card">
        <div class="card-header">

            <h4 class="card-title">Matcha Pro 🚀</h4>

        </div>
        <div class="card-body">
            <!-- Responsive Datatable -->
            <section id="responsive-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Responsive Datatable</h4>
                                {{-- <div>
                                    <button class="me-1">add</button>
                                    <button type="button" class="btn btn-primary">
                                        <i data-feather="plus" class="align-middle me-25"></i>
                                        <span class="text-truncate">ADD</span>
                                    </button>
                                </div> --}}
                            </div>

                            <div class="card-datatable">
                                <table id="example" class="dt-responsive table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Nama Komersial</th>
                                            <th>Alamat</th>
                                            <th>Provinsi</th>
                                            <th>Kabupaten/Kota</th>
                                            <th>Kecamatan</th>
                                            <th>Kelurahan/Desa</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Nama Komersial</th>
                                            <th>Alamat</th>
                                            <th>Provinsi</th>
                                            <th>Kabupaten/Kota</th>
                                            <th>Kecamatan</th>
                                            <th>Kelurahan/Desa</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($businesses as $business)
                                            <tr>
                                                <td>{{ $business->business_id }}</td>
                                                <td>{{ $business->business_kode }}</td>
                                                <td>{{ $business->business_nama }}</td>
                                                <td>{{ $business->business_nama_komersial }}</td>
                                                <td>{{ $business->business_alamat }}</td>
                                                <td>{{ $business->provinsi_nama }}</td>
                                                <td>{{ $business->kabupaten_nama }}</td>
                                                <td>{{ $business->kecamatan_nama }}</td>
                                                <td>{{ $business->kelurahan_nama }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Include pagination links here if you want server-side pagination -->
                                {{ $businesses->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Responsive Datatable -->


        </div>
    </div>
    <!--/ Kick start -->



@endsection
@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
    <script>
        $(document).ready(function() {
            if (!$.fn.dataTable.isDataTable('#example')) {
                $('#example').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('direktori_usaha_profiling.index') }}",
                    columns: [{
                            data: 'business_id',
                            name: 'business_id'
                        },
                        {
                            data: 'business_kode',
                            name: 'business_kode'
                        },
                        {
                            data: 'business_nama',
                            name: 'business_nama'
                        },
                        {
                            data: 'business_nama_komersial',
                            name: 'business_nama_komersial'
                        },
                        {
                            data: 'business_alamat',
                            name: 'business_alamat'
                        },
                        {
                            data: 'provinsi_nama',
                            name: 'provinsi_nama'
                        },
                        {
                            data: 'kabupaten_nama',
                            name: 'kabupaten_nama'
                        },
                        {
                            data: 'kecamatan_nama',
                            name: 'kecamatan_nama'
                        },
                        {
                            data: 'kelurahan_nama',
                            name: 'kelurahan_nama'
                        }
                    ],
                    "pageLength": 10,
                    "lengthChange": false,
                    "responsive": true
                });
            }
        });
    </script>
@endsection
