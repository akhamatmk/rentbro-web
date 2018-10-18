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

<div class="form-group">
	<div class="mb-20 form-input col-md-6">
		<span>Jenis Courir:</span><br/>
		<select id="type_courir" name="type_courir" class="input_field form-control">
			<option value="1">Cod</option>
			<option value="2">Courir Lain</option>
		</select>
	</div>


	<div class="mb-20 form-input col-md-6 cod">
		<span>Harga Per KM jika jarak melewati {{ $product->max_cod_free }} KM :</span><br/>
		<input type="text" class="form-control" readonly="readonly" value="{{ number_format($product->price_cod) }}">
	</div>

	<div class="mb-20 form-input col-md-6 cod">
		<span>Pilih Alamat yang sudah didaftarkan :</span><br/>
		<select class="form-control" id="addres">
			@foreach($user_address as $key => $value)
				<option value="" data-long="{{ $value->long }}" data-lat="{{ $value->lat }}" >{{ $value->name }} ({{ $value->full_address }})</option>
			@endForeach
		</select>
	</div>

	<div class="mb-20 form-input col-md-6 cod">
		<span>Jarak :</span><br/>
		<input type="text" class="form-control" readonly="readonly" id="jarak" value="{{ $distance }} KM">
	</div>

	<div class="mb-20 form-input col-md-6 cod">
		<span>Biaya shipping :</span><br/>
		<input type="text" class="form-control" readonly="readonly" id="cod" value="{{ number_format($price_cod) }}">
	</div>

	<div class="mb-20 form-input col-md-6 no-cod">
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
	</div>

	<div class="mb-20 form-input col-md-6 no-cod">
		<span>Biaya Kirim:</span><br/>
		<select id="shipping" name="shipping" class="input_field col-md-6"></select>
	</div>
	
</div>


	<script type="text/javascript">
	ready(function(){
		$(".no-cod").hide();
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
				$.ajax({
					type: "GET",
					url: '{{ URL::to("courier") }}',
					data : {
						"destination": $("#regency").val(),
						"weight": "{{$product->weight}}",
						"origin": "{{ isset($product->vendor->addres->regency->city_rajaongkir_id) ? $product->vendor->addres->regency->city_rajaongkir_id : 17}}",
					},
					dataType: 'json',
					success: function(data){
						$("#courier").html();
						$("#shipping").html();
						$.each( data, function( key, value ) {							
							$("#courier").append("<option value='"+value.code+"'> "+value.code+"</option>");
						});

						price_shipping();
					}
				});
			}

			function price_shipping()
			{
				$.ajax({
					type: "GET",
					url: '{{ URL::to("shipping/price") }}',
					data : {
						"destination": $("#regency").val(),
						"weight": "{{$product->weight}}",
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