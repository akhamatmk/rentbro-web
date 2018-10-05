@extends('layout.app')
@section('title', 'Profile')
@section('content')
<div class="super_container">
   <header class="header">
      @include('layout.top_header')
      @include('layout.header', ['noCategory' => "yes"])
   </header>
   <div class="user-content">
      <div class="container">
         <div class="row" style="min-height: 200px;" >
            @include('user.menu_user')
            <div class="col-lg-10 mt-10 user-page__content">
               <div class="my-account-section" style="padding: 0 30px 20px;">
                  <div class="my-account-section__header">
                     <div class="my-account-section__header-left">
                        <div class="my-account-section__header-title">Password</div>
                        <div class="my-account-section__header-subtitle">
                           Karena anda mendaftar menggunakan Layanan Third party maka anda diharuskan membuat password baru, untuk itu click <a href="{{ url('user/make/newPassword') }}">disini</a> kemudian anda akan dikirimi code verikasi di email untuk membuat password anda sendiri
                        </div>
                     </div>
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
<script type="text/javascript">
   
</script>
@endsection