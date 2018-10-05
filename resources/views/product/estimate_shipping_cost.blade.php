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
	<div class="mb-20 form-input">
		<span>Provinsi:</span><br/>
		<select id="province" name="province" class="input_field col-md-6">
				<option value="">-Silahkan Pilih-</option>
			@foreach($province as $key => $value)
				<option value="{{ $value->id }}">{{$value->name}}</option>
			@endForeach
		</select>
	</div>

	<div class="mb-20 form-input">
		<span>Kota/Kabubupaten:</span><br/>
		<select id="regency" name="regency" class="input_field col-md-6"></select>
	</div>

	<div class="mb-20 form-input">
		<span>Courir:</span><br/>
		<select id="courier" name="courier" class="input_field col-md-6"></select>
	</div>

	<div class="mb-20 form-input">
		<span>Biaya Kirim:</span><br/>
		<select id="shipping" name="shipping" class="input_field col-md-6"></select>
	</div>
	
</div>


	<script type="text/javascript">
			ready(function(){
			
			$("#province").select2();
      	$("#regency").select2();
      	$("#courier").select2();
      	$("#shipping").select2();

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