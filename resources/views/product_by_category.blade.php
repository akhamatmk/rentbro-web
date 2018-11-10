@extends('layout.app')
@section('title', 'Profile')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('styles/product_grid.css') }}">

<div class="super_container">
   <header class="header">
      @include('layout.top_header')
      @include('layout.header', ['noCategory' => "yes"])
   </header>
   
   <div id="wrap">
      <header>
         <span class="list-style-buttons" style="display: none">
            <a href="#" id="gridview" class="switcher"><img src="{{asset('images/grid-view.png')}}" alt="Grid"></a>
            <a href="#" id="listview" class="switcher"><img src="{{asset('images/list-view-active.png')}}" alt="List"></a>
         </span>
         <h1>Product dari category {{ $category }}</h1>

      </header>
      
      <ul id="products" class="grid clearfix">
         
         @foreach($product as $value)
         <!-- row 1 -->
         <li class="clearfix">
            <section class="left">
               <img height="130px" width="130px" src="{{ $value->image->real}}" alt="default thumb" class="thumb">
               <h3>{{ $value->name }}</h3>
            </section>
            
            <section class="right">
               <span class="price">$45.00</span>
               <span class="darkview">
               <!-- <a href="javascript:void(0);" class="firstbtn"><img src="{{ asset('images/read-more-btn.png') }}" alt="Read More..."></a> --><br/><br/><br/>
               <a href="{{ url('product/'.$value->vendor->nickname.'/'.$value->alias) }}"><img src="{{ asset('images/add-to-cart-btn.png')}}" alt="Add to Cart"></a>
               </span>
            </section>
         </li>
         @endForeach

      </ul>

   </div>


</div>
@include('layout.copyright')
@endsection
@section('footer-script')

<script type="text/javascript">
   $(function() {});   
</script>

<script type="text/javascript">
   $(document).ready(function(){

   $("a.switcher").bind("click", function(e){
      e.preventDefault();
      
      var theid = $(this).attr("id");
      var theproducts = $("ul#products");
      var classNames = $(this).attr('class').split(' ');
      
      var gridthumb = "{{asset('images/products/grid-default-thumb.png')}}";
      var listthumb = "{{asset('images/products/list-default-thumb.png')}}";
      
      if($(this).hasClass("active")) {
         // if currently clicked button has the active class
         // then we do nothing!
         return false;
      } else {
         // otherwise we are clicking on the inactive button
         // and in the process of switching views!

         if(theid == "gridview") {
            $(this).addClass("active");
            $("#listview").removeClass("active");
         
            $("#listview").children("img").attr("src","{{ asset('images/list-view.png')}}");
         
            var theimg = $(this).children("img");
            theimg.attr("src","{{asset('images/grid-view-active.png')}}");
         
            // remove the list class and change to grid
            theproducts.removeClass("list");
            theproducts.addClass("grid");
         
            // update all thumbnails to larger size
            $("img.thumb").attr("src",gridthumb);
         }
         
         else if(theid == "listview") {
            $(this).addClass("active");
            $("#gridview").removeClass("active");
               
            $("#gridview").children("img").attr("src","{{asset('images/grid-view.png')}}");
               
            var theimg = $(this).children("img");
            theimg.attr("src","{{asset('images/list-view-active.png')}}");
               
            // remove the grid view and change to list
            theproducts.removeClass("grid")
            theproducts.addClass("list");
            // update all thumbnails to smaller size
            $("img.thumb").attr("src",listthumb);
         } 
      }

   });
});
</script>

@endsection