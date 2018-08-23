@extends('layout.app')

@section('title', 'Koperasi Dana Masyarakat Indonesia')

@section('content')

<div class="super_container">
	
  <header class="header">
    @include('layout.top_header')
    @include('layout.header')
  </header>
	
  @include('landing_page.banner')

  @include('landing_page.inspiration')

  @include('layout.footer')

@endsection