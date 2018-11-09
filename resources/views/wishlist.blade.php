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


		  		<div class="col-lg-10 mt-10 user-page__content">
					<div class="my-account-section" style="padding: 0 30px 20px;">
						
						<div class="my-account-section__header">
							<div class="my-account-section__header-left">
								<div class="my-account-section__header-title" style="float: left;">Wishlist Anda</div>
							</div>
						</div>
						
						<div class="row container_content mt-10">
							@if($wishlist != null)
								<table class="table">
									<tr>
										<th>No</th>
										<th>Nama Product</th>
										<th>Gambar</th>
										<th></th>
									</tr>
								
									@foreach($wishlist as $key => $value)
										<tr>
											<td>{{ $key+1 }}</td>
											<td>{{ $value->name }}</td>
											<td><img width="100px" height="50px" src="{{ $value->image->real }}"></td>
											<td>
												
													<a href="{{ url('product/'.$value->vendor->nickname.'/'.$value->alias) }}" class="btn btn-primary">Add to Cart</a>
												
											</td>
										</tr>
									@endForeach

								</table>
							@endIf							
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
	
@endsection