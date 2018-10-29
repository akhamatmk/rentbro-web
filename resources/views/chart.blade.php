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
                        <div class="my-account-section__header-title">Keranjang Belanja</div>
                     </div>
                  </div>
					@if(count($data) > 0)
						@foreach($data as $key => $value)
							<div class="row" id="chart_{{ $key }}">
								<div class="col-md-2">
									<img height="100px" src="{{ $value->product->image->real }}">
								</div>

								<div class="row col-md-10 mt-10">
									<div class="col-md-10"><strong style="font-size: 18px">{{ $value->product->name }}</strong></div>
									<img  style="cursor: pointer;" alt="delete this data" data-chart="{{ $value->id }}" data-id="{{ $key }}" class="col-md-2 trash" height="50px" src="{{ asset('images/trash.png')}}">
									<div class="col-md-6 mt-20">
                                 		<span>Lama Peminjaman :</span>
                                 		<select class="form-control price_type" data-id="{{ $key }}" id="price_type_{{ $key }}" name="price[]">
		                                @foreach($value->product->price as $k => $v)
		                                    <option data-type="{{ $v->type }}" data-amount="{{ $v->amount }}" data-price="{{ $v->price }}" value="{{ $v->price }}"> Rp. {{ number_format($v->price) }} / {{ $v->amount }}
		                                       @switch($v->type)
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

									<div class="col-md-6 mt-20">
                                 		<span>Deposit</span>
                                 		<input type="text" class="form-control deposit" data-id="{{ $key }}" name="deposit[]" readonly="readonly" id="deposit_{{ $key }}" value="{{ number_format($value->product->minimum_deposit) }}"> 
                              		</div>

                              		<div class="col-md-12 mt-20"></div>

                              		<div class="col-md-6">
                                 		<span>Start Date</span>
                                 		<input type="text" class="form-control start_date" data-id="{{ $key }}" name="start_date[]" id="start_date_{{ $key }}" value="{{ date('Y-m-d') }}"> 
                              		</div>
                              	
                              		<div class="col-md-6">
                                 		<span>End Date</span>
                                 		<input type="text" readonly="readonly" data-id="{{ $key }}" class="form-control end_date_" name="end_date[]" id="end_date_{{ $key }}"">
                              		</div>

                              		<div class="form-input col-md-6 mt-20">
										<span>Pilih Alamat Anda:</span><br/>
										<select id="place" class="input_field form-control place_id" data-id="{{ $key }}" name="place_id[]" id="place_id_{{ $key }}">
											@foreach($user_address as $k => $v)
												@if($k == 0)
													@php
														$full_address = $v->full_address;
														$postal_code = $v->postal_code;
														$district_name = $v->district_name;
														$regency_name = $v->regency_name;
														$provincy_name = $v->provincy_name;
													@endphp
												@endIf
												<option 
													data-full_address="{{ $v->full_address }}" 
													data-id="{{ $key }}" 
													data-postal_code="{{ $v->postal_code }}" 
													data-district_name="{{ $v->district_name }}" 
													data-regency_name="{{ $v->regency_name }}" 
													data-provincy_name="{{ $v->provincy_name }}" 
													data-longitude="{{ $v->long }}" 
													data-latitude="{{ $v->lat }}"
													data-city_rajaongkir_id="{{ $v->city_rajaongkir_id }}"
													value="{{ $v->id }}"> 
														{{ $v->name }} 
													</option>
											@endForeach
										</select>
									</div>
									<div class="col-md-12"></div>

									<div class="mt-20 form-input col-md-6">
										<span>Courir:</span><br/>
										<select class="input_field form-control courier" name="courier[]" id="courier_{{ $key }}">
											@foreach($courier as $value)
												<option value="{{ $value['code'] }}"> {{ $value['name'] }} </option>
												@endForeach
										</select>
									</div>

									<div class="mt-20 form-input col-md-6">
										<span>Biaya Kirim:</span><br/>
										<select id="shipping_{{ $key }}" name="shipping[]" class="input_field  form-control shipping">
											@foreach($cost as $k => $v)
												<option value='{{ $v["cost"]->value }}'> {{ $v["service"] }} ({{ number_format($v["cost"]->value) }}) Estimated {{ $v["cost"]->etd }}</option>
											@endForeach
										</select>
									</div>

									<div class="mt-20 form-input col-md-6">
										<span>Yang Harus dibayar:</span><br/>
										<input type="text" readonly="readonly" class="form-control price" id="price_{{ $key }}" name="price[]">
									</div>

									<div class="mt-20 form-input col-md-12">
										<span><b>Detail Alamat </b></span>
										<p id="detail_address_{{$key}}">
											{{ $full_address }} {{ $postal_code }} {{ $district_name }}, {{ $regency_name }} {{ $provincy_name }}
										</p>
										<input type="hidden" data-id="{{ $key }}" name="full_address[]" id="full_address_{{ $key }}" value="{{ $full_address }} {{ $postal_code }} {{ $district_name }}, {{ $regency_name }} {{ $provincy_name }}">
									</div>									
                           		</div>								
							</div>
							<hr/>
						@endforeach
					@endIf
               </div>
            </div>

            <div class="col-lg-3 mt-10 ">
	            <div class="my-account-section" style="padding: 0 10px 20px;">
	            	
	            	<div class="row" style="background: white; min-height: 100px; padding: 0 0 0 10px">
	            		<div class="mt-20 form-input">
	            			<span>Total Biaya Kirim:</span><br/>
								<input type="text" readonly="" class="form-control" id="total_pembayaran_shipping" name="summary_shipping" value="50,000">
	            		</div>

	            		<div class="mt-20 form-input">
	            			<span>Total Biaya Barang:</span><br/>
								<input type="text" readonly="" class="form-control" id="total_pembayaran_barang" name="summary_price" value="150,000">
	            		</div>

	            		<div class="mt-20 form-input">
	            			<span>Total Biaya Deposit:</span><br/>
								<input type="text" readonly="" class="form-control" id="total_pembayaran_deposit" name="summary_deposit" value="150,000">
	            		</div>

	            		<div class="mt-20 form-input">
	            			<span>Total Semua:</span><br/>
								<input type="text" readonly="" class="form-control" id="total_semua" name="summary_all" value="150,000">
	            		</div>

	            		<div class="mt-20 form-input" style="margin-bottom: 10px">
	            			<button class="btn btn-primary">Checkout</button>
	            		</div>
	            	</div>
				
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
	$(function() {
		end_date();
		hitung_semua();

		@if(count($data) > 0)
			@foreach($data as $key => $value)
				$('#start_date_{{ $key }}').Zebra_DatePicker({
				    direction: ['{{date("Y-m-d")}}', false],
				     onSelect: function (date) {
				        end_date();
				    }
				});
			@endForeach
		@endIf

		 $(".price_type").change(function(){
            end_date();
            hitung_semua();   
         });

		function end_date()
        {
        	@if(count($data) > 0)
				@foreach($data as $key => $value)
		            var start_date = $("#start_date_{{ $key }}").val();
		            var temp = start_date.split("-");
		            if(temp.length > 2)
		            {
		               var variable = $('#price_type_{{ $key }}').find(":selected");
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

		               $("#end_date_{{ $key }}").val(result);
		            }
		        @endForeach
			@endIf            
        }

        $(".trash").click(function(){
        		let chart_id = $(this).data('chart_id');
        		let id = $(this).data('id');
        		
        });

        $(".place_id").change(function(){
      		let selected = $(this).find(':selected');
      		let id  = selected.data('id');
      		let full_address  = selected.data('full_address');
				let postal_code   = selected.data('postal_code');
				let district_name = selected.data('district_name');
				let regency_name  = selected.data('regency_name');
				let provincy_name = selected.data('provincy_name');
				let addres = full_address+" "+ postal_code+" "+district_name+" , "+regency_name+" "+provincy_name;
				$("#detail_address_"+id).html(addres);
				$("#full_address_"+id).val(addres);
      	});

        	function hitung_semua()
        	{
        		let total_price = 0;
        		let total_shipping = 0;
        		let total_deposit = 0;
        		let total_semua = 0;
        		$( ".price_type" ).each(function( index ) {
	  				let id = $(this).data('id');
	  				let price = parseInt($("#price_type_"+id).val());
	  				let shipping = parseInt($("#shipping_"+id).val());
	  				let deposit = parseInt($("#deposit_"+id).val().replace(/,/g, ''));
	  				let dibayar = price + shipping + deposit;

	  				total_price +=  price ;
	  				total_shipping += shipping;
	  				total_deposit += deposit;

	  				$("#price_"+id).val(format2(dibayar, '').slice(0, -3));
				});

				$("#total_pembayaran_shipping").val(format2(total_shipping, '').slice(0, -3));
				$("#total_pembayaran_barang").val(format2(total_price, '').slice(0, -3));
				$("#total_pembayaran_deposit").val(format2(total_deposit, '').slice(0, -3));
				total_semua = total_price + total_shipping + total_deposit;
				$("#total_semua").val(format2(total_semua, '').slice(0, -3));
        	}
        	

			function format2(n, currency) {
            return currency + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
         }
	});

</script>
@endsection