@extends('layout.app')

@section('title', 'Create Shop')

@section('content')

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
</style>

<div class="super_container">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/contact_styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/contact_responsive.css') }}">

  <header class="header">
    @include('layout.top_header')
    @include('layout.header', ['noCategory' => "yes"])
  </header>

 	<div class="contact_form">
		<div class="container">
			<div class="row">				
				<div class="col-xs-12 col-sm-6 col-lg-6" align="center" style=" margin: auto; padding: 10px;">

					<div class="contact_form_container" style="margin : 10px; border: 1px solid #e0e0e0; border-radius: 3px!important; box-shadow: 0 0 10px 0 rgba(0,0,0,.1)!important;">
						<div class="contact_form_title" style="text-align: center; margin-top: 10px">Daftarkan Vendor Anda</div>
						
						@if(Session::has('error_message'))
							<div id="error_message" class="error_message" style="">
								<ul style="margin-left: 30px; color: red; text-align: left">
									@foreach(Session::get('error_message') as $key => $value)
										<li>{{ $value }}</li>
									@endForeach									
								</ul>	
							</div>
						@endIf

						<div id="error_message_2" class="error_message" style="margin-bottom: 20px; display: none;">
							<ul class="error_content"></ul>
						</div>
												
						<form action="{{ url('vendor') }}" method="post" id="vendor_form" style="margin: 20px;">
							@csrf
							
							<div class="mb-30 form-input">
								<label>Nick name:</label>
								<input name="nick_name" type="text" id="nick_name" class="input_field alphaNumeric" placeholder="Nickname Vendor" required="required">
								<small id="nickname_check" style="color: red; display: none;">Nickname Sudah Ada</small>
							</div>

							<div class="mb-30 form-input">
								<label>Full name:</label>
								<input name="full_name" type="text" id="full_name" class="input_field" placeholder="Full Name Vendor" required="required">
							</div>

							<div class="mb-30 form-input">
								<label>Provinsi Warehouse:</label>
								<select id="province" name="province" class="input_field">
										<option value="">-Silahkan Pilih-</option>
									@foreach($province as $key => $value)
										<option value="{{ $value->id }}">{{$value->name}}</option>
									@endForeach
								</select>
							</div>

							<div class="mb-30 form-input">
								<label>Kota/Kabubupaten Warehouse:</label>
								<select id="regency" name="regency" class="input_field"></select>
							</div>

							<div class="mb-30 form-input">
								<label>Kecamatan Warehouse:</label>
								<select id="district" name="district" class="input_field"></select>
							</div>

							<div class="mb-30 form-input">
								<label>Kode Pos:</label>
								<input name="zip_code" type="text" id="zip_code" class="input_field" placeholder="Kode Pos">
							</div>

							<div class="mb-30 form-input">
								<label>Detail Lokasi Warehouse:</label>
								<textarea name="detail_location" id="detail_location" class="input_field input_textarea" cols="10"></textarea>
							</div>

							<div class="mb-30 form-input">
								<label>Motto:</label>
								<input name="motto" type="text" id="motto" class="input_field" placeholder="Motto">
							</div>

							<div class="mb-30 form-input">
								<label>Description:</label>
								<textarea name="description" id="description" class="input_field input_textarea" cols="10"></textarea>
							</div>
						
							<div class="mb-30 form-input">
		                        <label>Logo:</label>		                        
		                        <div style="margin-left: 10px" id="dropzone-primary" class="dropzone tx-center"></div>                        
		                     </div>

							<div id="image">
							
						   	</div>

						   	<div class="mb-30" style="text-align: center;">
								<button type="submit"  class="button contact_submit_button">Daftar</button>
							</div>

						</form>

					</div>
				</div>
			</div>
		</div>
		<div class="panel"></div>
	</div>

@include('layout.footer')

@endsection

@section('footer-script')
	<script type="text/javascript">		
		$(function() {
			$('.alphaNumeric').keypress(function (e) {
			    var regex = new RegExp("^[a-zA-Z0-9]+$");
			    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
			    if (regex.test(str) || e.charCode == 95|| e.charCode == 45) {
			        return true;
			    }

			    e.preventDefault();
			    return false;
			});

		   var fade_out = function() {
				$("#error_message").fadeOut().empty();
			}

			$("#vendor_form").validate({
				messages: {
					nick_name: {
						required: "{{trans('messages.must_fill')}}",
					},
					full_name: {
						required: "{{trans('messages.must_fill')}}",
					}
				}
			});

			$(document).on('keydown', '#nick_name', function(e) {
			    if (e.keyCode == 32) return false;
			});

			setTimeout(fade_out, 3000);
		});

		$("#dropzone-primary").dropzone({ 
           url: "{{ URL('upload/image') }}", 
           maxFiles: 1,
           paramName: "image", 
           addRemoveLinks: true,
           sending: function(file, xhr, formData) {
            formData.append("_token", "{{ csrf_token() }}");
         },
         removedfile: function(file) {
             $("#"+file.upload.uuid).remove();
             file.previewElement.remove();
          },
         success: function (file, response) {
            $("#image").append($("<input id='"+file.upload.uuid+"' value='"+response+"' type='hidden' name='logo' >"));
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
					$("#district").html("");
					$.each( data.data, function( key, value ) {
						if(value.type == 1)
							var kind = "Kabupaten";
						else
							var kind = "Kota";

						$("#regency").append("<option value='"+value.id+"'> "+kind+" "+value.name+"</option>");
					});
				}
			});
		});

		$("#regency").change(function(){
			$.ajax({
				type: "GET",
				url: '{{ URL::to("place/district") }}',
				data : {
					"regency_id": $(this).val(),
				},
				dataType: 'json',
				success: function(data){
					$("#district").html("");
					$.each( data.data, function( key, value ) {

						$("#district").append("<option value='"+value.id+"'>"+value.name+"</option>");
					});
				}
			});
		});

		$("#nick_name").change(function(){
			$.ajax({
				type: "GET",
				url: '{{ URL::to("vendor/nick_name/check") }}',
				data : {
					"nick_name": $(this).val(),
				},
				dataType: 'json',
				success: function(data){
					if(data.code != 200){
						$("#nickname_check").show();
						$('.contact_submit_button').prop('disabled', true);
					}
					else{
						$("#nickname_check").hide();
						$('.contact_submit_button').prop('disabled', false);
					}
				}
			});
		});

      $("#province").select2();
      $("#regency").select2();
      $("#district").select2();
	</script>
@endsection