		<div style="margin-top: 20px" class="sp-loading"><img src="{{ asset('images/sp-loading.gif') }}" alt=""><br>LOADING IMAGES</div>
		<div class="sp-wrap">
			<a href="{{ $product->image->real }}"><img src="{{ $product->image->real }}" alt=""></a>
			@foreach($product->other_image as $key => $value)
				<a  href="{{ $value->image->real }}"><img src="{{ $value->image->real }}" alt=""></a>
			@endForeach			
		</div>