@extends('layout.app')

@section('title', 'Koperasi Dana Masyarakat Indonesia')

@section('content')

<div class="super_container">
	
  <header class="header">
    @include('layout.top_header')
    @include('layout.header')
  </header>
	
  @include('landing_page.banner')

	<div class="container">
		<div class="row">
			@foreach($product as $value)
				<a href="{{ URL('product/'.$value->vendor->nickname.'/'.$value->alias) }}">
					<div class="col-md-3">
						<div class="card" style="border: none;">
						  <div style="border: solid 1px #f2f2f2; margin-top: 3px; border-radius: 10px" class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
								<div class="product_image d-flex flex-column align-items-center justify-content-center">
									<img style="width: 200px; height: 150px" src="{{ $value->image->real }}" alt=""></div>
								<div class="product_content">
									<div class="product_price">
										@if(isset($value->price[0]))
											Rp. {{ number_format($value->price[0]->price) }} / {{ $value->price[0]->amount }}
											@switch($value->price[0]->type)
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
											      
											@endswitch
										@endIf
									</div>
									<div class="product_name"><div><a>{{ $value->name }}</a></div></div>
									<div class="product_extras">
										<div class="product_color">
											<input type="radio" checked name="product_color" style="background:#b19c83">
											<input type="radio" name="product_color" style="background:#000000">
											<input type="radio" name="product_color" style="background:#999999">
										</div>
										<button class="product_cart_button">Add to Cart</button>
									</div>
								</div>
								<div class="product_fav"><i class="fas fa-heart"></i></div>
								<ul class="product_marks">
									<li class="product_mark product_discount"></li>
									<li class="product_mark product_new">new</li>
								</ul>
							</div>
						</div>
					</div>
				</a>
			@endForeach
		</div>
	</div>

  @include('landing_page.inspiration')

  @include('layout.footer')

@endsection