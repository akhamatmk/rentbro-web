@extends('layout.app')

@section('title', 'Koperasi Dana Masyarakat Indonesia')

@section('content')

<div class="super_container">
	
  <header class="header">
    @include('layout.top_header')
    @include('layout.header', ['noCategory' => "yes"])
  </header>

<!-- Hot New Arrivals -->

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-left">
							<ul class="clearfix">
								<li class="active">Hasil Pencarian Product dengan kata kunci '{{ $_GET['q'] }}'</li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>
						<div class="row">
							<div class="col-lg-12" style="z-index:1;">

								<!-- Product Panel -->
								<div class="product_panel panel active">
									<div class="arrivals_slider slider">

										@foreach($product as $value)
										<!-- Slider Item -->
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center">
													<img height="115px" width="115px" src="{{ $value->image->real }}" alt="">
												</div>
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
													<div class="product_name"><div><a href="product.html">{{ $value->name }}</a></div></div>
													<div class="product_extras">													
														<a href="{{ url('product/'.$value->vendor->nickname.'/'.$value->alias) }}">
															<button class="product_cart_button">Add to Cart</button>
														</a>
													</div>
												</div>
												<div class="product_fav" data-product="{{ $value->alias }}" data-vendor="{{ $value->vendor->nickname }}"><i class="wishlist fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount"></li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>
										@endForeach

									</div>

									<div class="arrivals_slider_dots_cover"></div>
								</div>
								

							</div>							
						</div>
								
					</div>
				</div>
			</div>
		</div>		
	</div>

  @include('layout.footer')

@endsection


@section('footer-script')
	<script type="text/javascript">
		$(function() {
			$(".product_fav").click(function(){
				let product = $(this).data('product');
				let vendor = $(this).data('vendor');
				$.ajax({
					type: "GET",
					url: '{{ URL::to("wishlist/add") }}',
					data : {
						"product": product,
						"vendor": vendor,
					},
					dataType: 'json',
					success: function(data){
						if(data.error == true)
							swal("", data.message, "warning");
						else
							swal("Good job!", data.message, "success");
					}
				});
			});
		});
	</script>
@endsection