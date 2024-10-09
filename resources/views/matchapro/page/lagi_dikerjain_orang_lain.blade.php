@extends('matchapro/layouts/contentLayoutMaster')

@section('content')
<div class="misc-wrapper">
  <div class="misc-inner p-2 p-sm-3">
    <div class="w-100 text-center">
      <h2 class="mb-1">Profiling Info 🔐</h2>
      <p class="mb-3">Mohon maaf anda tidak bisa melakukan edit pada usaha/perusahaan ini, karena saat ini usaha/perusahaan tersebut sedang diedit oleh user lain</p>      
      <img class="img-fluid" src="{{asset('images/pages/not-authorized-dark.svg')}}" alt="Usaha/Perusahaan Lagi Dikerjain Orang Lain" />
    </div>
  </div>
@endsection
