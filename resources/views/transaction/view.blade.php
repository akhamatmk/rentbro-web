@extends('layout.app')
@section('title', 'Profile')
@section('content')
<div class="super_container">
   <header class="header">
      @include('layout.top_header')
      @include('layout.header', ['noCategory' => "yes"])
   </header>
   <form action="" method="POST" >
      @csrf
      <div class="user-content">
         <div class="container">
            <div class="row" style="min-height: 200px;" >
               <div class="col-lg-9 mt-10 user-page__content">
                  <div class="my-account-section" style="padding: 0 30px 20px;">
                     <div class="my-account-section__header">
                        <div class="my-account-section__header-left">
                           <div class="my-account-section__header-title">Hasil Transaksi</div>
                        </div>
                     </div>
                     <p>Selamat Hasil Transaksi anda sukses Silahkan Transfer Sejumlah {{ number_format($data->summary_all) }}</p>
                  </div>
               </div>
               
            </div>
         </div>
      </div>
</div>
</form>
@include('layout.copyright')
@endsection
@section('footer-script')
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/moment-with-locales.js') }}"></script>
<script type="text/javascript">
   
</script>
@endsection