@extends('layout.app')

@section('title', 'Create Shop')

@section('content')

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
				<div class="col-lg-6 offset-lg-1" align="center" style=" margin: auto; width: 50%; padding: 10px;">

					<div class="contact_form_container" style="margin : 10px; border: 1px solid #e0e0e0; border-radius: 3px!important; box-shadow: 0 0 10px 0 rgba(0,0,0,.1)!important;">
						<div class="contact_form_title" style="text-align: center; margin-top: 10px">Daftar Sebagai Vendor </div>
						
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
												
						<form action="{{ url('myshop') }}" method="post" id="contact_form" style="margin: 20px;">
							@csrf
							
							<div class="contact_form_inputs">
								<input name="name_shop" type="text" id="name_shop" class="contact_form_phone input_field" placeholder="Nama Toko">
							</div>

							<div class="contact_form_inputs">
								<input name="url_shop" type="text" id="contact_form_email" class="contact_form_email input_field" placeholder="Url Shop" required="required" data-error="Email is required.">
							</div>							

							<div class="contact_form_button" style="text-align: center;">
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
		    $(function() {
			    var fade_out = function() {
				  $("#error_message").fadeOut().empty();
				}

				setTimeout(fade_out, 3000);
			});
		});
	</script>
@endsection