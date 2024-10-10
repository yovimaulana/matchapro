@extends('matchapro/layouts/contentLayoutMaster')

@section('title', 'Home')

@section('content')
    <!-- Kick start -->
    <div class="card">
        <div class="card-header">
            <h2>Selamat datang di
                <span class="brand-text fw-bolder" style="color: #78b34d">MatchaPro</span>
            </h2>
        </div>
        <div class="card-body">
            <div class="card-text">

                <ul>
                    <li>
                        MatchaPro, atau Matching Assessment Profiling, adalah aplikasi yang dirancang untuk melakukan
                        profiling data SBR
                    </li>
                    <li>
                        Kegiatan profiling dilakukan sebagai tahapan untuk mendapatkan gambaran secara utuh unit statistik
                        dan jaringan/struktur hubungan antar unit dalam group di Indonesia agar sejalan dengan konsep System
                        of National Account 2008 (SNA 2008).
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--/ Kick start -->

    <div class="card">
        <div class="card-header">
            <h2>
                Tujuan
            </h2>
        </div>
        <div class="card-body">
            <div class="card-text">

                <ul>
                    <li>
                        Memperoleh profil perusahaan
                    </li>
                    <li>
                        Mendapatkan dan melengkapi informasi perusahaan data direktori perusahaan sesuai kondisi terkini
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Page layout -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">What is page layout?</h4>
        </div>
        <div class="card-body">
            <div class="card-text">
                <p>
                    Starter kit includes pages with different layouts, useful for your next project to start development
                    process
                    from scratch with no time.
                </p>
                <ul>
                    <li>Each layout includes required only assets only.</li>
                    <li>
                        Select your choice of layout from starter kit, customize it with optional changes like colors and
                        branding,
                        add required dependency only.
                    </li>
                </ul>
                <div class="alert alert-primary" role="alert">
                    <div class="alert-body">
                        <strong>Info:</strong> Please check the &nbsp;<a class="text-primary"
                            href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-layouts.html#layout-collapsed-menu"
                            target="_blank">Layout documentation</a>&nbsp; for more layout options i.e collapsed menu,
                        without menu, empty & blank.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Page layout -->
@endsection
