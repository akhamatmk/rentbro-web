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
         <div class="row" style="min-height: 200px;" >
            @include('user.menu_user')
            <div class="col-lg-10 mt-10">
               <div class="my-account-section">
                  <div class="my-account-section__header">
                     <div class="my-account-section__header-left">
                        <div class="my-account-section__header-title">
                           <img src="{{ $vendor->image->real }}" width="100px" height="50px" style="border-radius: 50%">
                           Vendor {{ $vendor->full_name }}
                        </div>                        
                     </div>
                  </div>
                  <div class="content-body-vendor">
                     <main>
                        <input id="tab1" type="radio" name="tabs" checked> <label for="tab1">Detail Vendor</label>
                        <input id="tab2" type="radio" name="tabs" > <label for="tab2">List Product</label>
                        
                        <section class="content" id="content1">
                           @include('vendor.profile')
                        </section>
                        <section id="content2">
                           @include('vendor.list_product')
                        </section>
                     </main>
                  </div>                  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@include('layout.copyright')
@endsection
@section('footer-script')
<script type="text/javascript"></script>
@endsection