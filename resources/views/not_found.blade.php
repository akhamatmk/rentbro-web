@extends('layout.app')
@section('title', 'Profile')
@section('content')


<link rel="stylesheet" type="text/css" href="{{ asset('styles/vendor_profile.css') }} ">
<div class="super_container">
   <header class="header">
      @include('layout.top_header')
      @include('layout.header', ['noCategory' => "yes"])
   </header>

   <div class="user-content">
      <div class="container">
         <div class="row">
            <div class="col-12 col-md-12" >
               <h1  style="vertical-align: middle; margin-top: 30px">Yang ada cari tidak ada</h1>             
            </div>            
         </div>
      </div>
   </div>
</div>

@include('layout.copyright')
@endsection