<style type="text/css">
	.select2-selection{
	    height: 50px;
	    padding-left: 25px;
	    border: solid 1px #e5e5e5;
	    border-radius: 5px;
	    outline: none;
	    color: #000;
	}

	.select2-container--default .select2-selection--single .select2-selection__rendered {
	    margin-top: 10px;
	}

	.select2-container--default .select2-selection--single .select2-selection__arrow{
	    margin-top: 10px;
	}

	.select2-container--default .select2-selection--single{
	    height: 50px;
	}

	.presentation{
	    margin-top: 10px !important;
	}

	.mb-20{
		margin-bottom: 20px;
	}
</style>

	<input type="hidden" id="vendor-long" value="{{ $vendor_addres->longitude }}">
	<input type="hidden" id="vendor-lat" value="{{ $vendor_addres->latitude }}">
	<input type="hidden" id="price-cod" value="{{ $product->price_cod }}">

<div class="form-group">
	<div class="mb-20 form-input col-md-6">
		<span>Jenis Courir:</span><br/>
		

		<select id="type_courir" name="type_courir" class="input_field form-control">
			<!-- <option value="1">Cod</option> -->
			<option value="2">Courir Lain</option>
		</select>
	</div>

	

	@if(count($user_address) > 0)
		<div class="mb-20 form-input col-md-6">
			<span>Pilih Alamat Anda:</span><br/>
			<select id="place" class="input_field form-control" name="place_id">
				@foreach($user_address as $key => $value)
					@if($key == 0)
						@php
							$full_address = $value->full_address;
							$postal_code = $value->postal_code;
							$district_name = $value->district_name;
							$regency_name = $value->regency_name;
							$provincy_name = $value->provincy_name;
						@endphp
					@endIf
					<option 
						data-full_address="{{ $value->full_address }}" 
						data-postal_code="{{ $value->postal_code }}" 
						data-district_name="{{ $value->district_name }}" 
						data-regency_name="{{ $value->regency_name }}" 
						data-provincy_name="{{ $value->provincy_name }}" 
						data-longitude="{{ $value->long }}" 
						data-latitude="{{ $value->lat }}"
						data-city_rajaongkir_id="{{ $value->city_rajaongkir_id }}"
						value="{{ $value->id }}"> 
							{{ $value->name }} 
						</option>
				@endForeach
			</select>
		</div>

		<div class="mb-20 form-input col-md-6">
			<span><b>Detail Alamat </b></span>
			<p id="detail_address">
				{{ $full_address }} {{ $postal_code }} {{ $district_name }}, {{ $regency_name }} {{ $provincy_name }}
			</p>		
		</div>

		<div class="mb-20 form-input col-md-6 no-cod">
			<span>Courir:</span><br/>
			<select class="input_field form-control" id="courier">
				@foreach($courier as $value)
					<option value="{{ $value['code'] }}"> {{ $value['name'] }} </option>
					@endForeach
			</select>
		</div>

	@endIf


	<div class="mb-20 form-input col-md-6 cod">
		<span>Harga Per KM jika jarak melewati {{ $product->max_cod_free }} KM :</span><br/>
		<input type="text" class="form-control" readonly="readonly" value="{{ number_format($product->price_cod) }}">
	</div>	

	<div class="mb-20 form-input col-md-6 cod">
		<span>Jarak :</span><br/>
		<input type="text" class="form-control" readonly="readonly" id="jarak" value="{{ $distance }} KM">
	</div>

	<div class="mb-20 form-input col-md-6 cod">
		<span>Biaya shipping :</span><br/>
		<input type="text" class="form-control" readonly="readonly" id="cod" name="shipping_cod" value="{{ number_format($price_cod) }}">
	</div>

	<!-- <div class="mb-20 form-input col-md-6 no-cod">
		<span>Provinsi:</span><br/>
		<select id="province" name="province" class="input_field ">
				<option value="">-Silahkan Pilih-</option>
			@foreach($province as $key => $value)
				<option value="{{ $value->id }}">{{$value->name}}</option>
			@endForeach
		</select>
	</div>

	<div class="mb-20 form-input col-md-6 no-cod">
		<span>Kota/Kabubupaten:</span><br/>
		<select id="regency" name="regency" class="input_field col-md-6"></select>
	</div>

	<div class="mb-20 form-input col-md-6 no-cod">
		<span>Courir:</span><br/>
		<select id="courier" name="courier" class="input_field col-md-6"></select>
	</div> -->
	<div class="mb-20 form-input col-md-6 no-cod">
		<span>Biaya Kirim:</span><br/>
		<select id="shipping" name="shipping" class="input_field col-md-6">
			@foreach($cost as $key => $value)
				<option value='{{ $value["cost"]->value }}'> {{ $value["service"] }} ({{ number_format($value["cost"]->value) }}) Estimated {{ $value["cost"]->etd }}</option>
			@endForeach
		</select>
	</div>
	
</div>


	<script type="text/javascript">
	ready(function(){
		// $(".no-cod").hide();
		$(".cod").hide();
		$("#province").select2();
      	$("#regency").select2();
      	$("#courier").select2();
      	$("#shipping").select2();

      	$("#type_courir").change(function(){
      		let val = $(this).val();

      		if(val == 1)
      		{
      			$(".cod").show();
      			$(".no-cod").hide();
      		}else{
      			$(".cod").hide();
      			$(".no-cod").show();
      		}
      	});

      	$("#place").change(function(){
      		let selected = $(this).find(':selected');
      		let full_address  = selected.data('full_address');
			let postal_code   = selected.data('postal_code');
			let district_name = selected.data('district_name');
			let regency_name  = selected.data('regency_name');
			let provincy_name = selected.data('provincy_name');
			let addres = full_address+" "+ postal_code+" "+district_name+" , "+regency_name+" "+provincy_name;
			$("#detail_address").html(addres);

			let type_courir = $("#type_courir").val();

			if(type_courir == 1)
				courir_cod();
			else
				getCourier();
      	});

      	function courir_cod()
      	{
      		let options = "";
			let locale = 'en-IN';
			let formatter = new Intl.NumberFormat(locale, options);
      		let selected = $("#place").find(':selected');
      		let long_user = parseFloat(selected.data('longitude'));
      		let lat_user = parseFloat(selected.data('latitude'));
      		let long_vendor = parseFloat($("#vendor-long").val());
      		let lat_vendor = parseFloat($("#vendor-lat").val());
      		let dis = Math.ceil(parseFloat(distance(lat_user, long_user, lat_vendor, long_vendor, 'K')));
 			let price_cod = parseInt($("#price-cod").val());
 			if(isNaN(price_cod))
 				price_cod = 0;

 			let price = price_cod * dis;
      		$("#cod").val(formatter.format(price));
      		$("#jarak").val(dis+" KM");
      	}

      	function formatMoney(n, c, d, t) {
		  var c = isNaN(c = Math.abs(c)) ? 2 : c,
		    d = d == undefined ? "." : d,
		    t = t == undefined ? "," : t,
		    s = n < 0 ? "-" : "",
		    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
		    j = (j = i.length) > 3 ? j % 3 : 0;

		  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
		};

      	function distance(lat1, lon1, lat2, lon2, unit) {
			var radlat1 = Math.PI * lat1/180
			var radlat2 = Math.PI * lat2/180
			var theta = lon1-lon2
			var radtheta = Math.PI * theta/180
			var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
			if (dist > 1) {
				dist = 1;
			}
			dist = Math.acos(dist)
			dist = dist * 180/Math.PI
			dist = dist * 60 * 1.1515
			if (unit=="K") { dist = dist * 1.609344 }
			if (unit=="N") { dist = dist * 0.8684 }
			return dist;
		}

      	$("#province").change(function(){
				$.ajax({
					type: "GET",
					url: '{{ URL::to("place/regency") }}',
					data : {
						"province_id": $(this).val(),
					},
					dataType: 'json',
					success: function(data){
						$("#regency").html("");
						$.each( data.data, function( key, value ) {
							if(value.type == 1)
								var kind = "Kabupaten";
							else
								var kind = "Kota";

							$("#regency").append("<option value='"+value.city_rajaongkir_id+"'> "+kind+" "+value.name+"</option>");
						});

						getCourier();
					}					
				});
			});

			$("#regency").change(function(){
				getCourier();
			});

			function getCourier()
			{
				let selected = $("#place").find(':selected');
				let destination = selected.data('city_rajaongkir_id');

				$.ajax({
					type: "GET",
					url: '{{ URL::to("courier") }}',
					data : {
						"destination": destination,
						"weight": "{{$product->weight}}",
						"origin": "{{ isset($product->vendor->addres->regency->city_rajaongkir_id) ? $product->vendor->addres->regency->city_rajaongkir_id : 17}}",
					},
					dataType: 'json',
					success: function(data){
						$("#courier").html("");
						$("#shipping").html("");
						$.each( data, function( key, value ) {							
							$("#courier").append("<option value='"+value.code+"'> "+value.name+"</option>");
						});

						price_shipping();
					}
				});
			}

			function price_shipping()
			{
				let selected = $("#place").find(':selected');
				let destination = selected.data('city_rajaongkir_id');
				
				$.ajax({
					type: "GET",
					url: '{{ URL::to("shipping/price") }}',
					data : {
						"destination": destination,
						"weight": "{{ $product->weight}}",
						"courier": $("#courier").val(),
						"origin": "{{ isset($product->vendor->addres->regency->city_rajaongkir_id) ? $product->vendor->addres->regency->city_rajaongkir_id : 17}}",
					},
					dataType: 'json',
					success: function(data){
						$("#shipping").html("");
						$.each( data.costs, function( key, value ) {							
							$("#shipping").append("<option value='"+value.cost.value+"'> "+value.service+" ("+value.cost.value+") Estimated "+value.cost.etd+"</option>");
						});
					}
				});
			}
		});
		
	</script>