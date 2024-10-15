@extends('matchapro/layouts/contentLayoutMaster')

@section('title', 'Direktori Usaha')
@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="fw-bolder mb-75">{{ number_format($usaha_aktif, 0, ',', '.') }}</h3>
                        <span>Usaha Aktif</span>
                    </div>
                    <div class="avatar bg-light-success p-50">
                        <span class="avatar-content">
                            <i data-feather="user-check" class="font-medium-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="fw-bolder mb-75">{{ number_format($usaha_tidak_aktif, 0, ',', '.') }}</h3>
                        <span>Usaha Tidak Aktif</span>
                    </div>
                    <div class="avatar bg-light-danger p-50">
                        <span class="avatar-content">
                            <i data-feather="user-x" class="font-medium-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="fw-bolder mb-75">{{ number_format($usaha_undefined, 0, ',', '.') }}</h3>
                        <span>Usaha Undefined</span>
                    </div>
                    <div class="avatar bg-light-warning p-50">
                        <span class="avatar-content">
                            <i data-feather="user-plus" class="font-medium-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-1 row-gap-4">
        <div class="d-flex flex-column justify-content-center">

        </div>
        <div class="d-flex align-content-center flex-wrap gap-1">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="export-dropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i data-feather="upload" class="me-25"></i>
                Export
            </button>
            <div class="dropdown-menu" aria-labelledby="export-dropdown">
                <a class="dropdown-item" href="javascript:void(0);" id="export-excel"><i data-feather="file-text"
                        class="me-25"></i> Excel</a>
                <a class="dropdown-item" href="javascript:void(0);" id="export-csv"><i data-feather="file"
                        class="me-25"></i> Csv</a>
            </div>
            <a href="{{ route('form_create_usaha.index') }}">
                <button class="btn btn-primary waves-effect waves-light" id="submit-final"><i data-feather="plus"
                        class="me-25"></i>
                    <span>USAHA BARU</span></button>
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <section id="responsive-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-datatable">
                                <table id="table_direktori_usaha" class="dt-responsive table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>IDSBR</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Kode Wilayah</th>
                                            <th>Status Perusahaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Responsive Datatable -->
        </div>
    </div>

    <div class="modal fade" id="modal-view-usaha" tabindex="-1" aria-labelledby="ModalViewUsaha" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">VIEW USAHA/PERUSAHAAN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding-left:0px;">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="10%">IDSBR:</td>
                                <td><span class="h6 text-nowrap" id="idsbr">1234567890</span></td>
                            </tr>
                            <tr>
                                <td width="10%">Nama:</td>
                                <td><span class="h6 text-nowrap" id="nama_usaha">PT. ABC</span></td>
                            </tr>
                            <tr>
                                <td width="10%">Alamat:</td>
                                <td>
                                    <p class="h6" id="alamat_usaha">
                                        Jl. Raya No. 1
                                    </p>
                                    <small id="kode_wilayah">[3205010001]</small>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%">Status Perusahaan:</td>
                                <td>
                                    <span class="badge bg-light-success" id="status_perusahaan">Aktif</span>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%">Kegiatan Usaha:</td>
                                <td>
                                    <p class="h6" id="kegiatan_usaha">
                                        Membeli barang untuk dijual kembali
                                    </p>
                                    <small id="kbli_kategori">[KBLI: 1234567890 ~ Kategori: A]</small>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%">Produk:</td>
                                <td>
                                    <p class="h6" id="produk">
                                        Produk 1, Produk 2, Produk 3
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%">Email:</td>
                                <td>
                                    <p class="h6" id="email">
                                        email@example.com
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%">Telepon:</td>
                                <td>
                                    <p class="h6" id="telepon">
                                        +62 81234567890
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%">Website:</td>
                                <td>
                                    <p class="h6" id="website">
                                        www.example.com
                                    </p>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="" id="edit_link">
                        <button type="button" class="btn btn-sm btn-flat-warning"><i data-feather="edit"></i>
                            Edit</button>
                    </a>
                    <button type="button" class="btn btn-sm btn-flat-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--/ Kick start -->


    <!-- Download Modal -->
    <div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="downloadModalLabel">Export Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="downloadForm">
                        <!-- Wilayah Filters -->
                        <div class="mb-1">
                            <label for="provinsi" class="form-label">Provinsi <span class="text-danger">*</span></label>
                            <select class="form-select select2" id="provinsi" name="provinsi">
                                <option value="">Pilih Provinsi</option>
                                <option value="106">Aceh</option>
                                <!-- Add options dynamically -->
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="kabupaten" class="form-label">Kabupaten <span
                                    class="text-danger">*</span></label>
                            <select class="form-select select2" id="kabupaten" name="kabupaten">
                                <option value="">Pilih Kabupaten</option>
                                <!-- Add options dynamically -->
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select class="form-select select2" id="kecamatan" name="kecamatan">
                                <option value="">Pilih Kecamatan</option>
                                <!-- Add options dynamically -->
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="desa" class="form-label">Desa</label>
                            <select class="form-select select2" id="desa" name="desa">
                                <option value="">Pilih Desa</option>
                                <!-- Add options dynamically -->
                            </select>
                        </div>

                        <!-- Status Usaha Filter -->
                        <div class="mb-3">
                            <label for="status_usaha" class="form-label">Status Usaha <span
                                    class="text-danger">*</span></label>
                            <select class="form-select select2" id="status_usaha" name="status_usaha[]" multiple>
                                <option value="1">Aktif</option>
                                <option value="2">Tutup Sementara</option>
                                <option value="3">Belum Berproduksi</option>
                                <option value="4">Tutup</option>
                                <option value="5">Alih Usaha</option>
                                <option value="6">Tidak Ditemukan</option>
                                <option value="7">Aktif Pindah</option>
                                <option value="8">Aktif Non Response</option>
                                <option value="9">Duplikat</option>
                                <option value="">Undefined</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="downloadExcel">Download</button>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    {{-- Page js files --}}
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                dropdownParent: $('#downloadModal')
            });

            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            var table_direktori_usaha = $('#table_direktori_usaha').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('direktori_usaha.data') }}",
                    data: function(d) {
                        d.status_perusahaan = $('select[name="status_perusahaan"]').val();
                        d.idsbr = $('input[name="idsbr"]').val();
                        d.nama_usaha = $('input[name="nama_usaha"]').val();
                        d.alamat_usaha = $('input[name="alamat_usaha"]').val();
                    }
                },
                columns: [{
                        data: 'idsbr',
                        name: 'idsbr',
                        width: '5%'
                    },
                    {
                        data: 'nama_usaha',
                        name: 'nama_usaha'
                    },
                    {
                        data: 'alamat_usaha',
                        name: 'alamat_usaha'
                    },
                    {
                        data: 'kode_wilayah',
                        name: 'kode_wilayah',
                        width: '10%'
                    },
                    {
                        data: 'status_perusahaan',
                        name: 'status_perusahaan',
                        width: '5%',
                        render: function(data, type, full, meta) {
                            return `<span class="badge ${getBgClassForStatus(full.status_perusahaan)}">${full.status_perusahaan ?? 'UNDEFINED'}</span>`;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '5%',
                        render: function(data, type, full, meta) {
                            return renderButton(full);
                        }
                    }
                ],
                // "pageLength": 10,
                "lengthChange": false,
                searching: false,
                ordering: false
                // "responsive": true
            });

            function renderButton(data) {
                return `
                <div class="d-flex align-items-center col-actions">
                    <a href="${data.action}" class="btn btn-sm btn-flat-warning me-1">${feather.icons['edit'].toSvg({ class: 'font-small-4' })}</a> 
                    <a href="javascript:void(0);" data-perusahaan_id="${data.perusahaan_id}" class="btn btn-sm btn-flat-secondary view-usaha">${feather.icons['search'].toSvg({ class: 'font-small-4' })}</a>
                </div>
                `;
            }

            var perusahaan_id = null;
            $('#table_direktori_usaha tbody').on('click', '.view-usaha', function() {
                perusahaan_id = $(this).data('perusahaan_id');
                $("#modal-view-usaha").modal('show');
                blockProgress($('.modal-body'));
            });

            $('#modal-view-usaha').on('shown.bs.modal', function(e) {
                $.ajax({
                    url: "{{ route('direktori_usaha.data_by_id') }}",
                    type: 'POST',
                    data: {
                        perusahaan_id: perusahaan_id,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        $('#idsbr').text(data.idsbr);
                        $('#nama_usaha').text(data.nama_usaha ?? '-');
                        $('#alamat_usaha').text(data.alamat_usaha ?? '-');
                        $('#kode_wilayah').text(
                            `[${data.kode_provinsi ?? '-'}, ${data.kode_kabupaten_kota ?? '-'}, ${data.kode_kecamatan ?? '-'}, ${data.kode_kelurahan_desa ?? '-'}]`
                        );
                        $('#kegiatan_usaha').text(data.kegiatan_utama ?? '-');
                        $('#kbli_kategori').text(
                            `[KBLI: ${data.kbli ?? '-'}, Kategori: ${data.kategori ?? '-'}]`
                        );

                        // Update status_perusahaan with dynamic class
                        var statusElement = $('#status_perusahaan');
                        statusElement.text(data.status_perusahaan ?? 'UNDEFINED');

                        // Remove existing bg-light-* classes
                        statusElement.removeClass(function(index, className) {
                            return (className.match(/(^|\s)bg-light-\S+/g) || []).join(
                                ' ');
                        });

                        // Add appropriate bg-light-* class based on status
                        var bgClass = getBgClassForStatus(data.status_perusahaan);
                        statusElement.addClass(bgClass);

                        $('#email').text(data.email ?? '-');
                        $('#telepon').text(data.telepon ?? '-');
                        $('#website').text(data.website ?? '-');
                        $('#produk').text(data.produk ?? '-');
                        $('#edit_link').attr('href', data.edit_link);

                        unblockProgress($('.modal-body'));
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong. Try again later!',
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        });
                        unblockProgress($('.modal-body'));
                    }
                });
            });

            $("#modal-view-usaha").on('hidden.bs.modal', function(e) {
                perusahaan_id = null;
                $('#edit_link').attr('href', '');
                unblockProgress($('.modal-body'));
            })

            $('#table_direktori_usaha thead tr').clone(true).appendTo('#table_direktori_usaha thead');
            $('#table_direktori_usaha thead tr:eq(1) th').each(function(i) {
                if (i < 3) {
                    var title = $(this).text();
                    var name = i == 0 ? 'idsbr' : (i == 1 ? 'nama_usaha' : 'alamat_usaha');
                    $(this).html('<input name="' + name +
                        '" type="text" class="form-control form-control-sm" placeholder="Search ' +
                        title + '" />');
                } else {
                    if (i == 4) {
                        $(this).html(`<select name="status_perusahaan" class="form-control form-control-sm">
                            <option value="-">-- All--</option>
                            <option value="1">Aktif</option>
                            <option value="2">Tutup Sementara</option>
                            <option value="3">Belum berproduksi</option>
                            <option value="4">Tutup</option>
                            <option value="5">Alih Usaha</option>
                            <option value="6">Tidak Ditemukan</option>
                            <option value="7">Aktif Pindah</option>
                            <option value="8">Aktif Non Response</option>
                            <option value="9">Duplikat</option>
                            <option value="">Undefined</option>
                        </select>`);
                    } else if (i == 5) {
                        $(this).html(`
                        <div class="d-flex align-items-center col-actions">
                            <button id="filter-data" type="button" class="btn btn-sm btn-outline-secondary me-1"><i data-feather="filter"></i></button>
                            <button id="clear-filter" type="button" class="btn btn-sm btn-outline-secondary"><i data-feather="x"></i></button>
                        </div>
                        `);
                    } else {
                        $(this).html('');
                    }
                }

            });

            $('#table_direktori_usaha thead').on('click', '#filter-data', function() {
                table_direktori_usaha.ajax.reload();
            });

            $("#table_direktori_usaha thead").on('click', '#clear-filter', function() {
                $('select[name="status_perusahaan"]').val('-');
                $('input[name="idsbr"]').val('');
                $('input[name="nama_usaha"]').val('');
                $('input[name="alamat_usaha"]').val('');
                table_direktori_usaha.ajax.reload();
            });


            function blockProgress(area) {
                area.block({
                    message: '<div class="spinner-border text-primary" role="status"></div>',
                    css: {
                        backgroundColor: 'transparent',
                        border: '0'
                    },
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8
                    },
                    centerY: false,
                    centerX: false
                });

                var spinner = area.find('.blockUI.blockMsg');
                spinner.css({
                    'position': 'absolute',
                    'top': '50%',
                    'left': '50%',
                    'transform': 'translate(-50%, -50%)'
                });
            }

            function unblockProgress(area) {
                area.unblock();
            }

            // Helper function to determine the appropriate bg-light-* class
            function getBgClassForStatus(status) {
                switch (status) {
                    case 'Aktif':
                        return 'bg-light-success';
                    case 'Tutup Sementara':
                    case 'Belum Berproduksi':
                    case 'Alih Usaha':
                    case 'Aktif Non Response':
                        return 'bg-light-warning';
                    case 'Tutup':
                    case 'Tidak Ditemukan':
                    case 'Aktif Pindah':
                    case 'Duplikat':
                        return 'bg-light-danger';
                    default:
                        return 'bg-light-secondary';
                }
            }

            $('#export-excel').on('click', function() {
                $("#downloadModal").modal('show');
            });

            let provinsiCache = [];
            $("#downloadModal").on('shown.bs.modal', function(e) {
                if (!provinsiCache.length) {
                    getWilayahProvinsi();
                    return;
                }
                setOption($('#provinsi'), provinsiCache);
            });

            function getWilayahProvinsi() {
                blockProgress($(".modal-body"));
                $.ajax({
                    url: "{{ route('master-provinsi.data') }}",
                    type: 'GET',
                    success: function(data) {
                        let provUser = "{{ auth()->user()->provinsi_id }}";
                        let levelUser = "{{ auth()->user()->getRoleNames()[0] }}";
                        let wilProv = [{
                            id: '',
                            text: '-- Pilih Provinsi --'
                        }]
                        for (let i = 0; i < data.length; i++) {
                            if (levelUser.split('-')[0] == 'PUSAT' || data[i].id == provUser) {
                                wilProv.push({
                                    id: data[i].id,
                                    text: '[' + data[i].kode + '] ' + data[i].nama
                                });
                            }
                        }
                        provinsiCache = wilProv;
                        setOption($('#provinsi'), provinsiCache);
                        unblockProgress($(".modal-body"));
                    },
                    error: function(xhr) {
                        unblockProgress($(".modal-body"));
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong. Try again later!',
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        });
                    }
                });
            }

            let kabupatenCache = [];
            $('#provinsi').on('change', function() {
                let provinsi = $(this).val();
                if (!provinsi) {
                    setOption($('#kabupaten'), [{
                        id: '',
                        text: '-- Pilih Kabupaten/Kota --'
                    }]);
                    return;
                }

                let findCache = kabupatenCache.find(kc => kc.provinsi == provinsi);
                if (findCache) {
                    setOption($('#kabupaten'), findCache.kabupaten_kota);
                    unblockProgress($(".modal-body"));
                    return;
                }

                getWilayahKabupatenKota(provinsi);
            });

            function getWilayahKabupatenKota(provinsi) {
                blockProgress($(".modal-body"));
                $.ajax({
                    url: "{{ route('wil-kabupaten-kota') }}",
                    type: 'POST',
                    data: {
                        provinsi: provinsi,
                        _token: '{{ csrf_token() }}',
                        level: 'user'
                    },
                    success: function(response) {
                        let wilKab = [{
                            id: '',
                            text: '-- Pilih Kabupaten/Kota --'
                        }]
                        for (let i = 0; i < response.length; i++) {
                            wilKab.push({
                                id: response[i].id,
                                text: '[' + response[i].kode + ']' + ' ' + response[i]
                                    .nama
                            })
                        }
                        kabupatenCache.push({
                            provinsi: provinsi,
                            kabupaten_kota: wilKab
                        })
                        setOption($('#kabupaten'), wilKab);
                        setOption($('#kecamatan'), [{
                            id: '',
                            text: '-- Pilih Kecamatan --'
                        }]);
                        setOption($("#desa"), [{
                            id: '',
                            text: '-- Pilih Kelurahan/Desa --'
                        }]);
                        unblockProgress($(".modal-body"));
                    },
                    error: function(xhr) {
                        unblockProgress($(".modal-body"));
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong. Try again later!',
                            icon: 'error',
                        })
                    }
                })
            }

            let kecamatanCache = [];
            $("#kabupaten").on('change', function() {
                let kabupaten = $(this).val();
                if (!kabupaten) {
                    setOption($('#kecamatan'), [{
                        id: '',
                        text: '-- Pilih Kecamatan --'
                    }]);
                    return;
                }

                let findCache = kecamatanCache.find(kc => kc.kabupaten_kota == kabupaten);
                if (findCache) {
                    setOption($('#kecamatan'), findCache.kecamatan);
                    unblockProgress($(".modal-body"));
                    return;
                }

                getWilayahKecamatan(kabupaten);
            });

            function getWilayahKecamatan(kabupaten) {
                blockProgress($(".modal-body"));
                $.ajax({
                    url: "{{ route('wil-kecamatan') }}",
                    type: 'POST',
                    data: {
                        kabupaten_kota: kabupaten,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        let wilKec = [{
                            id: '',
                            text: '-- Pilih Kecamatan --'
                        }]
                        for (let i = 0; i < response.length; i++) {
                            wilKec.push({
                                id: response[i].id,
                                text: '[' + response[i].kode + ']' + ' ' + response[i]
                                    .nama
                            })
                        }
                        kecamatanCache.push({
                            kabupaten_kota: kabupaten,
                            kecamatan: wilKec
                        })
                        setOption($('#kecamatan'), wilKec);
                        unblockProgress($(".modal-body"));
                    },
                    error: function(xhr) {
                        unblockProgress($(".modal-body"));
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong. Try again later!',
                            icon: 'error',
                        })
                    }
                })
            }

            let desaCache = [];
            $("#kecamatan").on('change', function() {
                let kecamatan = $(this).val();
                if (!kecamatan) {
                    setOption($("#desa"), [{
                        id: '',
                        text: '-- Pilih Kelurahan/Desa --'
                    }]);
                    return;
                }

                let findCache = desaCache.find(dc => dc.kecamatan == kecamatan);
                if (findCache) {
                    setOption($("#desa"), findCache.desa);
                    unblockProgress($(".modal-body"));
                    return;
                }

                getWilayahDesa(kecamatan);
            });

            function getWilayahDesa(kecamatan) {
                blockProgress($(".modal-body"));
                $.ajax({
                    url: "{{ route('wil-desa') }}",
                    type: 'POST',
                    data: {
                        kecamatan: kecamatan,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        let wilDesa = [{
                            id: '',
                            text: '-- Pilih Kelurahan/Desa --'
                        }];

                        for (let i = 0; i < response.length; i++) {
                            wilDesa.push({
                                id: response[i].id,
                                text: '[' + response[i].kode + ']' + ' ' + response[i]
                                    .nama
                            });
                        }

                        desaCache.push({
                            kecamatan: kecamatan,
                            desa: wilDesa
                        });

                        setOption($("#desa"), wilDesa);
                        unblockProgress($(".modal-body"));
                    },
                    error: function(xhr) {
                        unblockProgress($(".modal-body"));
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong. Try again later!',
                            icon: 'error',
                        })
                    }
                })
            }

            function setOption(area, data) {
                // Clear existing options
                area.empty();
                // Append new options dynamically
                let temp = []
                $.each(data, function(index, option) {
                    var newOption = new Option(option.text, option.id, false, false);
                    temp.push(newOption);
                });
                area.append(temp).trigger('change');
            }

            $("#downloadExcel").on('click', function() {
                let isValid = validateDownloadRequest();
                if (!isValid) return;

                var url = "{{ route('export.excel') }}";
                var params = $('#downloadForm').serialize();
                window.location.href = url + '?' + params;
                $("#downloadModal").modal('hide');
            });

            function validateDownloadRequest() {
                let provinsi = $('#provinsi').val();
                let kabupaten = $('#kabupaten').val();
                let kecamatan = $('#kecamatan').val();
                let desa = $('#desa').val();
                let status_usaha = $('#status_usaha').val();
                if (!provinsi || !kabupaten || !status_usaha.length) {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Field provinsi, kabupaten/kota, and status usaha is required!',
                        icon: 'warning',
                    })
                    return false
                }
                return true;
            }

            $('#export-csv').on('click', function() {
                alert('Currently unavailable. Try export to excel instead.');
            });
        });
    </script>
@endsection
