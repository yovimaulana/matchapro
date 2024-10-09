@extends('matchapro/layouts/contentLayoutMaster')

@section('content')
<div class="misc-wrapper">
  <div class="misc-inner p-2 p-sm-3">
    <div class="w-100 text-center">
      <h2 class="mb-1">Page Not Found 🕵🏻‍♀️</h2>
      <p class="mb-3">Oops! 😖 The requested URL was not found on this server.</p>      
      <img class="img-fluid" src="{{asset('images/pages/error.svg')}}" alt="Error Page" />
    </div>
  </div>
@endsection
