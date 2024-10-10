@extends('matchapro/layouts/contentLayoutMaster')

@section('title', 'Form Create Usaha')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">

    <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endsection

@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">

@endsection

@section('content')
    <!-- Horizontal Wizard -->
    <section class="horizontal-wizard">
        <div class="bs-stepper horizontal-wizard-create">
            <div class="bs-stepper-header" role="tablist">
                <div class="step" data-target="#identitas-usaha" role="tab" id="identitas-usaha-trigger">
                    <button type="button" class="step-trigger">
                        {{-- <span class="bs-stepper-box">1</span> --}}
                        <span class="bs-stepper-box">
                            <i data-feather="file-text" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Identitas Usaha/Perusahaan</span>
                            <span class="bs-stepper-subtitle">Isi Identitas Usaha/Perusahaan</span>
                        </span>
                    </button>
                </div>
                <div class="line">
                    <i data-feather="chevron-right" class="font-medium-2"></i>
                </div>
                <div class="step" data-target="#cek-usaha" role="tab" id="cek-usaha-trigger">
                    <button type="button" class="step-trigger">
                        {{-- <span class="bs-stepper-box">2</span> --}}
                        <span class="bs-stepper-box">
                            <i data-feather="database" class="font-medium-3"></i>
                        </span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Cek Duplikasi Usaha/Perusahaan</span>
                            <span class="bs-stepper-subtitle">Periksa Duplikasi Usaha/Perusahaan</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <div id="identitas-usaha" class="content" role="tabpanel" aria-labelledby="identitas-usaha-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Identitas Usaha/Perusahaan</h5>
                        <small class="text-muted">Isi Identitas Usaha/Perusahaan</small> <br><br>
                        <button class="btn btn-relief-danger btn-clear-form" id="btnClearForm">
                            <i data-feather="trash-2" class="align-middle me-sm-25 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Clear Form</span>
                        </button>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="mb-2 col-md-12">
                                    <label class="form-label" for="nama_usaha">Nama Usaha</label>
                                    <input type="text" name="nama_usaha" id="nama_usaha" class="form-control"
                                        placeholder="Eltisweiss, PT" value="{{ old('nama_usaha') }}" />
                                    <div id="nama_usaha-error" class="error-message"></div>

                                </div>
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <textarea id="alamat" class="form-control" rows="7" placeholder="Alamat"></textarea>
                                    <div id="alamat-error" class="error-message"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="col-md-12 mb-1">
                                    <label class="form-label" for="select2-provinsi">Provinsi</label>
                                    <select class="select2 form-select" id="select2-provinsi" disabled>
                                        <option value="{{ $provinsi->id }}" selected>
                                            {{ $provinsi->kode . '-' . $provinsi->nama }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label class="form-label" for="select2-kabupaten_kota">Kabupaten/Kota</label>
                                    <select class="select2 form-select" {{ $createNewUsahaProvinsi ? '' : 'disabled' }}
                                        id="select2-kabupaten_kota">
                                        @if ($createNewUsahaProvinsi)
                                            <option value="">Pilih Kabupaten/Kota</option>
                                            @foreach ($kabupaten_kota as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->kode . '-' . $item->nama }}

                                                </option>
                                            @endforeach
                                        @else
                                            <option value="{{ $kabupaten_kota->id }}" selected>
                                                {{ $kabupaten_kota->kode }}
                                                - {{ $kabupaten_kota->nama }}
                                            </option>
                                        @endif
                                    </select>
                                    <div id="select2-kabupaten_kota-error" class="error-message"></div>
                                </div>

                                <div class="col-md-12 mb-1">
                                    <label class="form-label" for="select2-kecamatan">Kecamatan</label>
                                    <select class="select2 form-select" id="select2-kecamatan">
                                        <option value="">Pilih Kecamatan</option>
                                        @foreach ($kecamatan as $item)
                                            <option value="{{ $item->id }}"
                                                data-kabupaten_kota-id="{{ $item->kabupaten_kota_id }}">
                                                {{ $item->kode . '-' . $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label class="form-label" for="select2-kelurahan_desa">Kelurahan/Desa</label>
                                    <select class="select2 form-select" id="select2-kelurahan_desa">
                                        <option value="">Pilih Kelurahan/Desa</option>
                                        @foreach ($kelurahan_desa as $item)
                                            <option value="{{ $item->id }}"
                                                data-kecamatan-id="{{ $item->kecamatan_id }}">
                                                {{ $item->kode . '-' . $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 mb-1">
                                    <label class="form-label">Status Keberadaan Usaha</label>
                                    <div class="form-check form-check-success">
                                        <input type="radio" id="customColorRadio3" name="customColorRadio3"
                                            class="form-check-input" checked />
                                        <label class="form-check-label" for="customColorRadio3">Aktif</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                    <div class="d-flex flex-row-reverse">
                        <button class="btn btn-relief-primary btn-next btn-step1 mt-4">
                            <span class="align-middle d-sm-inline-block d-none">Next</span>
                            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                        </button>
                    </div>
                </div>

                <div id="cek-usaha" class="content" role="tabpanel" aria-labelledby="cek-usaha-trigger">
                    <div class="content-header">
                        <h5 class="mb-0">Pemeriksaan Usaha/Perusahaan</h5>
                        <small>Periksa Identitas Usaha/Perusahaan</small>
                    </div>
                    <form>
                        <div class="row">
                            <div class="mb-1 col-lg-12 col-md-12">

                                <div class="card-body">
                                    <h4 class="mb-75">Identitas Usaha/Perusahaan yang Ingin Ditambahkan</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mt-2">
                                                <h5 class="mb-75">Nama:</h5>
                                                <p class="card-text nama-step1-cek-usaha"></p>
                                            </div>
                                            <div class="mt-2">
                                                <h5 class="mb-75">Alamat:</h5>
                                                <p class="card-text alamat-step1-cek-usaha"></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mt-2">
                                                <h5 class="mb-50">Provinsi:</h5>
                                                <p class="card-text mb-0 provinsi-step1-cek-usaha"></p>
                                            </div>
                                            <div class="mt-2">
                                                <h5 class="mb-50">Kabupaten/Kota:</h5>
                                                <p class="card-text mb-0 kabupaten_kota-step1-cek-usaha"></p>
                                            </div>
                                            <div class="mt-2">
                                                <h5 class="mb-50">Kecamatan:</h5>
                                                <p class="card-text mb-0 kecamatan-step1-cek-usaha"></p>
                                            </div>
                                            <div class="mt-2">
                                                <h5 class="mb-50">Kelurahan/Desa:</h5>
                                                <p class="card-text mb-0 kelurahan_desa-step1-cek-usaha"></p>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="alert alert-warning mt-4">

                                            <h4 class="alert-heading"><i data-feather="alert-triangle"
                                                    class="me-50"></i>Apakah Anda
                                                yakin bahwa usaha yang ingin Anda tambahkan
                                                tidak ada dalam
                                                daftar berikut?</h4>
                                            <div class="alert-body fw-normal">
                                                Pastikan Anda sudah benar-benar yakin sebelum melanjutkan
                                            </div>
                                        </div>

                                        <form id="konfirmasiCheckBoxForm" class="validate-form" onsubmit="return false">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="konfrimasiCheckBox"
                                                    id="konfrimasiCheckBox"
                                                    data-msg="Silakan konfirmasi bahwa usaha yang ingin Anda tambahkan tidak ada dalam daftar berikut" />
                                                <label class="form-check-label font-small-3" for="konfrimasiCheckBox">
                                                    Saya yakin bahwa usaha yang ingin saya tambahkan tidak terdapat di
                                                    daftar
                                                    berikut.
                                                </label>
                                            </div>
                                            <div>

                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <div class="mb-1 col-lg-12 col-md-12">
                                    <div class="card-datatable ">
                                        <table id="cek_data_table"
                                            class="dt-responsive table section-block-cek_data_table" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Nama</th>
                                                    <th>Alamat</th>
                                                    <th>Provinsi</th>
                                                    <th>Kabupaten/Kota</th>
                                                    <th>Kecamatan</th>
                                                    <th>Kelurahan/Desa</th>
                                                    <th>Skor</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Nama</th>
                                                    <th>Alamat</th>
                                                    <th>Provinsi</th>
                                                    <th>Kabupaten/Kota</th>
                                                    <th>Kecamatan</th>
                                                    <th>Kelurahan/Desa</th>
                                                    <th>Skor</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                {{-- Load Data Here --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                    </form>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-relief-primary btn-prev">
                            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>

                        <button class="btn btn-relief-success btn-submit" id="step2Button">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Horizontal Wizard -->

@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>

    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>

    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection
@section('page-script')
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-sweet-alerts.js')) }}"></script>
    <script>
        const getDataFulltextUrl = "{{ route('getDataFulltext') }}";
        const createPostURL = "{{ route('form_create_usaha.store') }}";
        let buttonState = false
    </script>
    <!-- Page js files -->
    {{-- <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script> --}}
    {{-- <script src="{{ asset(mix('js/scripts/extensions/matchapro-blockui-create.js')) }}"></script> --}}
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/matchapro-form-wizard-create.js')) }}"></script>


    {{-- Select Wilayah --}}
    <script>
        $(document).ready(function() {

            var createNewUsahaProvinsi = @json($createNewUsahaProvinsi);
            // Initialize Select2
            $('.select2').select2();

            // Store the original list of Kelurahan/Desa options
            var allKelurahanDesaOptions = $('#select2-kelurahan_desa').html();
            var allKecamatanOptions = $('#select2-kecamatan').html();

            //When Kabupaten is selected
            $('#select2-kabupaten_kota').on('change', function() {


                var selectedKabupatenKotaId = $(this).val()
                var allKecamatanOptionsTemp = allKecamatanOptions;
                // Reset the Kecamatan dropdown
                $('#select2-kecamatan').html('<option value="">Pilih Kecamatan</option>');

                if (selectedKabupatenKotaId) {
                    // Loop through all options and append only the matching ones
                    $(allKecamatanOptionsTemp).filter('option').each(function() {
                        var kecamatanKabupatenId = $(this).data('kabupaten_kota-id');

                        if (kecamatanKabupatenId == selectedKabupatenKotaId) {
                            $('#select2-kecamatan').append($(this).clone());
                        }
                    });
                }

                // Refresh the Select2 to apply the changes
                $('#select2-kecamatan').trigger('change');

            })

            // When Kecamatan is selected
            $('#select2-kecamatan').on('change', function() {
                var selectedKecamatanId = $(this).val();
                // Reset the Kelurahan/Desa dropdown
                $('#select2-kelurahan_desa').html('<option value="">Pilih Kelurahan/Desa</option>');

                //Cek Permission
                if (createNewUsahaProvinsi == true) {
                    //User Provinsi
                    if (selectedKecamatanId) {
                        // Make AJAX request to get Kelurahan/Desa based on Kecamatan ID
                        $.ajax({
                            url: '{{ route('getDataKelurahanDesa') }}', // Define your route
                            type: 'GET',
                            data: {
                                kecamatan_id: selectedKecamatanId
                            },
                            success: function(data) {
                                // Populate the Kelurahan/Desa dropdown
                                $.each(data, function(index, kelurahan) {
                                    $('#select2-kelurahan_desa').append(
                                        '<option value="' + kelurahan.id + '">' +
                                        kelurahan.kode + '-' + kelurahan.nama +
                                        //   kelurahan.kecamatan_id +
                                        '</option>');
                                });
                            },
                            error: function() {
                                alert('Unable to load Kelurahan/Desa data.');
                            }
                        });
                    }
                }

                if (createNewUsahaProvinsi == false) {
                    //User Kab
                    if (selectedKecamatanId) {
                        // Loop through all options and append only the matching ones
                        $(allKelurahanDesaOptions).filter('option').each(function() {
                            var kelurahanKecamatanId = $(this).data('kecamatan-id');

                            if (kelurahanKecamatanId == selectedKecamatanId) {
                                $('#select2-kelurahan_desa').append($(this).clone());
                            }
                        });
                    }

                    // Refresh the Select2 to apply the changes
                    $('#select2-kelurahan_desa').trigger('change');
                }

            });

            //Step 2
            const checkbox = document.getElementById('konfrimasiCheckBox');
            const button = document.getElementById('step2Button');


            function updateButtonState() {
                // console.log('Checkbox checked:', checkbox.checked); // Log checkbox state
                if (checkbox.checked) {
                    // button.removeAttribute('disabled'); // Enable the button
                    buttonState = true
                } else {
                    // button.setAttribute('disabled', 'disabled'); // Disable the button
                    buttonState = false
                }
            }
            checkbox.addEventListener('change', updateButtonState);

            // Initialize button state on page load
            updateButtonState();
        });
    </script>

    {{-- Local Storage --}}
    <script>
        var createNewUsahaProvinsi = @json($createNewUsahaProvinsi);
        //clear Form
        const buttonClearForm = document.getElementById('btnClearForm');
        buttonClearForm.addEventListener('click', clearFormData);
        buttonClearForm.addEventListener('click', clearFormDataPage);

        function clearFormDataPage() {
            console.log('cek clearForm', createNewUsahaProvinsi)
            document.getElementById('nama_usaha').value = ''
            document.getElementById('alamat').value = ''

            // Clear Kecamatan dropdown
            const kecamatanSelect = $('#select2-kecamatan');
            kecamatanSelect.val('').trigger('change'); // Reset and update Select2


            // Clear Kelurahan/Desa dropdown
            const kelurahanDesaSelect = $('#select2-kelurahan_desa');
            kelurahanDesaSelect.val('').trigger('change'); // Reset and update Select2


            // If createNewUsahaProvinsi is true, clear Kabupaten/Kota dropdown
            if (createNewUsahaProvinsi) {
                const kabupatenKotaSelect = $('#select2-kabupaten_kota');
                kabupatenKotaSelect.val('').trigger('change'); // Reset and update Select2
                // Optionally, reset the options if necessary
                // while (kabupatenKotaSelect.options.length > 1) {
                //     kabupatenKotaSelect.remove(1); // Remove all options except the first (Pilih Kabupaten/Kota)
                // }
            }
        }

        // Function to save form data to localStorage
        function saveFormData() {
            localStorage.setItem('nama_usaha', document.getElementById('nama_usaha').value);
            localStorage.setItem('alamat', document.getElementById('alamat').value);
            localStorage.setItem('select2-kabupaten_kota', $('#select2-kabupaten_kota').val()); // Use jQuery for Select2
            localStorage.setItem('select2-kecamatan', $('#select2-kecamatan').val());
            localStorage.setItem('select2-kelurahan_desa', $('#select2-kelurahan_desa').val());
            // Repeat for other fields as needed
        }

        // Function to load form data from localStorage
        function loadFormData() {
            if (localStorage.getItem('nama_usaha')) {
                document.getElementById('nama_usaha').value = localStorage.getItem('nama_usaha');
            }
            if (localStorage.getItem('alamat')) {
                document.getElementById('alamat').value = localStorage.getItem('alamat');
            }
            if (localStorage.getItem('select2-kabupaten_kota')) {
                $('#select2-kabupaten_kota').val(localStorage.getItem('select2-kabupaten_kota')).trigger(
                    'change'); // Use .val() and trigger 'change'
            }
            if (localStorage.getItem('select2-kecamatan')) {
                $('#select2-kecamatan').val(localStorage.getItem('select2-kecamatan')).trigger(
                    'change'); // Use .val() and trigger 'change'
            }
            if (localStorage.getItem('select2-kelurahan_desa')) {
                $('#select2-kelurahan_desa').val(localStorage.getItem('select2-kelurahan_desa')).trigger(
                    'change'); // Use .val() and trigger 'change'
            }
        }

        // Clear localStorage on form submission
        function clearFormData() {
            localStorage.removeItem('nama_usaha');
            localStorage.removeItem('alamat');
            localStorage.removeItem('select2-kabupaten_kota');
            localStorage.removeItem('select2-kecamatan');
            localStorage.removeItem('select2-kelurahan_desa');
            // localStorage.removeItem('select2-kelurahan_desa');
            // Repeat for other fields as needed
        }

        // Load data when the page is loaded
        window.onload = loadFormData;

        // Save data when the user types or selects something
        document.getElementById('nama_usaha').addEventListener('input', saveFormData);
        document.getElementById('alamat').addEventListener('input', saveFormData);
        $('#select2-kabupaten_kota').on('change', saveFormData);
        $('#select2-kecamatan').on('change', saveFormData);
        $('#select2-kelurahan_desa').on('change', saveFormData);
        // Repeat for other fields as needed

        // Optionally, clear the data when the form is submitted
        document.querySelector('form').addEventListener('submit', clearFormData);
    </script>
@endsection

<style>
    .blockUI.blockMsg.blockElement {
        width: 100%;
        top: 50%;
    }


    /* .block-message {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
    } */
</style>
