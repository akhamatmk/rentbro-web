@extends('layout.app')
@section('title', 'Profile')
@section('content')
<style type="text/css">
   img {
   max-width: 100%; }
   .preview {
   display: -webkit-box;
   display: -webkit-flex;
   display: -ms-flexbox;
   display: flex;
   -webkit-box-orient: vertical;
   -webkit-box-direction: normal;
   -webkit-flex-direction: column;
   -ms-flex-direction: column;
   flex-direction: column; }
   @media screen and (max-width: 996px) {
   .preview {
   margin-bottom: 20px; } }
   .preview-pic {
   -webkit-box-flex: 1;
   -webkit-flex-grow: 1;
   -ms-flex-positive: 1;
   flex-grow: 1; }
   .preview-thumbnail.nav-tabs {
   border: none;
   margin-top: 15px; }
   .preview-thumbnail.nav-tabs li {
   width: 18%;
   margin-right: 2.5%; }
   .preview-thumbnail.nav-tabs li img {
   max-width: 100%;
   display: block; }
   .preview-thumbnail.nav-tabs li a {
   padding: 0;
   margin: 0; }
   .preview-thumbnail.nav-tabs li:last-of-type {
   margin-right: 0; }
   .tab-content {
   overflow: hidden; }
   .tab-content img {
   width: 100%;
   -webkit-animation-name: opacity;
   animation-name: opacity;
   -webkit-animation-duration: .3s;
   animation-duration: .3s; }
   .card {
   margin-top: 20px;
   background: white;
   padding: 1em;
   line-height: 1.5em; }
   @media screen and (min-width: 997px) {
   .wrapper {
   display: -webkit-box;
   display: -webkit-flex;
   display: -ms-flexbox;
   display: flex; } }
   .details {
   display: -webkit-box;
   display: -webkit-flex;
   display: -ms-flexbox;
   display: flex;
   -webkit-box-orient: vertical;
   -webkit-box-direction: normal;
   -webkit-flex-direction: column;
   -ms-flex-direction: column;
   flex-direction: column; }
   .colors {
   -webkit-box-flex: 1;
   -webkit-flex-grow: 1;
   -ms-flex-positive: 1;
   flex-grow: 1; }
   .product-title, .price, .sizes, .colors {
   text-transform: UPPERCASE;
   font-weight: bold; }
   .checked, .price span {
   color: #ff9f1a; }
   .product-title, .rating, .product-description, .price, .vote, .sizes {
   margin-bottom: 15px; }
   .product-title {
   margin-top: 0; }
   .size {
   margin-right: 10px; }
   .size:first-of-type {
   margin-left: 40px; }
   .color {
   display: inline-block;
   vertical-align: middle;
   margin-right: 10px;
   height: 2em;
   width: 2em;
   border-radius: 2px; }
   .color:first-of-type {
   margin-left: 20px; }
   .add-to-cart, .like {
   background: #ff9f1a;
   padding: 0.5em 1em;
   border: none;
   text-transform: UPPERCASE;
   font-weight: bold;
   color: #fff;
   -webkit-transition: background .3s ease;
   transition: background .3s ease; }
   .add-to-cart:hover, .like:hover {
   background: #b36800;
   color: #fff; }
   .not-available {
   text-align: center;
   line-height: 2em; }
   .not-available:before {
   font-family: fontawesome;
   content: "\f00d";
   color: #fff; }
   .orange {
   background: #ff9f1a; }
   .green {
   background: #85ad00; }
   .blue {
   background: #0076ad; }
   .tooltip-inner {
   padding: 1.3em; }
   @-webkit-keyframes opacity {
   0% {
   opacity: 0;
   -webkit-transform: scale(3);
   transform: scale(3); }
   100% {
   opacity: 1;
   -webkit-transform: scale(1);
   transform: scale(1); } }
   @keyframes opacity {
   0% {
   opacity: 0;
   -webkit-transform: scale(3);
   transform: scale(3); }
   100% {
   opacity: 1;
   -webkit-transform: scale(1);
   transform: scale(1); } }
   /*# sourceMappingURL=style.css.map */
</style>

<link rel="stylesheet" type="text/css" href="{{ asset('styles/vendor_profile.css') }} ">
<div class="super_container">
   <header class="header">
      @include('layout.top_header')
      @include('layout.header', ['noCategory' => "yes"])
   </header>
   <form action="" method="POST" >
   <div class="user-content">
      <div class="container">
         <div class="row">
            <div class="col-12 col-md-9">
               <div class="card">
                  <div class="container-fliud">
                     <div class="wrapper row">
                        <div class="preview col-md-5" >
                                                      
                           @include('product.image_slider')
                           
                        </div>
                        <div class="details col-md-7" >
                           <h4 class="product-title">{{ $product->name }}</h4>
                           <!-- <div class="rating">
                              <div class="stars">
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                                 <span class="fa fa-star checked"></span>
                              </div>
                              <span class="review-no">0 reviews</span>
                           </div> -->
                           <div>
                              <span>Lama Peminjaman :</span>
                              <select class="form-control" id="price_type" name="price_type">
                                 @foreach($product->price as $key => $value)
                                    <option data-type="{{ $value->type }}" data-amount="{{ $value->amount }}" value="{{ $value->id }}"> Rp. {{ number_format($value->price) }} / {{ $value->amount }}
                                       @switch($value->type)
                                          @case(1)
                                             Hari    
                                             @break

                                          @case(2)
                                             Minggu
                                             @break

                                          @case(3)
                                             Bulan
                                             @break

                                          @default
                                             Hari
                                       @endswitch
                                    </option>
                                 @endForeach
                              </select>
                           </div>
                           <small class="deposit-price">
                              <strong>Deposit : {{ number_format($product->minimum_deposit) }}</strong>
                           </small>
                           
                           <div class="row mt-10">
                              <div class="col-md-6">
                                 <span>Start Date</span>
                                 <input type="text" class="form-control" name="start_date" id="start_date"> 
                              </div>
                              <div class="col-md-6">
                                 <span>End Date</span>
                                 <input type="text" disabled="disabled" class="form-control" name="end_date" id="end_date">
                              </div>
                           </div>

                              @if(! (isset($product->option->data) AND count($product->option->data) == 0))
                                 @foreach($product->option as $key => $value)
                                 
                                 <div class="row mt-10" style="margin-left: 5px">
                                    <h5>
                                       {{ $value->option_name }}:
                                       @foreach($value->value as $valueChild)
                                          @if($value->option_id == 1)
                                          <span class="size fa fa-square" style="color: {{ $valueChild->option_value_name  }}; font-size: 22px"></span>
                                          @else
                                          <span class="size">{{$valueChild->option_value_name}}</span>
                                          @endIf
                                       @endForeach
                                    </h5>
                                 </div>
                                 @endForeach
                              @endIf
                                                                                                   
                           <div class="row mt-10" style="margin-left: 5px">
                              <button class="add-to-cart btn btn-default" style="margin-right: 10px" type="submit">add to cart</button>
                              <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               
               <main style="margin-top: 10px; margin-bottom: 10px">
                  <input id="tab1" type="radio" name="tabs" > <label for="tab1">Detail Produk</label>
                  <input id="tab2" type="radio" name="tabs" > <label for="tab2">Katalog Produk</label>
                  <input id="tab3" type="radio" name="tabs" checked> <label for="tab3">Estimasi Biaya Kirim</label>
                  
                  <section class="content" id="content1">
                     <h4>Deskripsi</h4>
                     {!! $product->description !!}
                  </section>
                  <section id="content2">
                     <h4>Deskripsi</h4>
                     @if(isset($product->catalog->description))
                        {!! $product->catalog->description !!}
                     @endIf
                  </section>
                  <section id="content3">
                     @include('product.estimate_shipping_cost')
                  </section>
               </main>

            </div>
            <div class="col-12 col-md-3" style="margin-top: 10px; margin-bottom: 10px">                  
               @include('product.right_side')
            </div>
         </div>
      </div>
   </div>
   </form>
</div>

@include('layout.copyright')
@endsection
   
@section('footer-script')
   <script src="{{ asset('js/moment.js') }}"></script>
   <script src="{{ asset('js/moment-with-locales.js') }}"></script>
   <script type="text/javascript">
      
      $(function() {         
         $('#start_date').Zebra_DatePicker({
             direction: ['{{date("Y-m-d")}}', false],
             onSelect: function (date) {
                end_date();
            }
         });         

         $("#price_type").change(function(){
            end_date();            
         });

         function end_date()
         {
            var start_date = $("#start_date").val();
            var temp = start_date.split("-");

            if(temp.length > 2)
            {
               var variable = $('#price_type').find(":selected");
               var type = parseInt(variable.data('type'));
               var amount = parseInt(variable.data('amount'));
               var day = parseInt(temp[2]);
               var month = parseInt(temp[1]) - 1;
               var year = parseInt(temp[0]);            
               var jsDate = new Date( year, month, day );

               if(type == 1)
               {
                  var result = moment(jsDate).add(amount, 'd').format('YYYY-MM-DD');
               } else if(type == 2)
                  {
                     var plus = amount * 7;
                     var result = moment(jsDate).add(plus, 'd').format('YYYY-MM-DD');
                  } else if(type == 3)
                     {
                        var result = moment().add(amount, 'M').format('YYYY-MM-DD');
                     }

               $("#end_date").val(result);
            }            
         } 
         
      });

      var $=jQuery.noConflict();

      $(document).ready(function(){
         $('.sp-wrap').smoothproducts();
      });
   </script>
@endsection