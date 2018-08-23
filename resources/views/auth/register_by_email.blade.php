@extends('layout.app')

@section('title', 'Register User Rental bro')

@section('content')

	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

	<style type="text/css">
		.error_message {float: left; width: 100%; box-shadow: 5px 10px; box-shadow: 0 0 10px 0 #FF3C3C; margin-top: 10px; margin-bottom: 10px}
		
		.succes_message {float: left; width: 100%; box-shadow: 5px 10px; box-shadow: 0 0 10px 0 blue; margin-top: 10px; margin-bottom: 10px; color: green}	
	</style>

<div class="super_container">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/contact_styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/contact_responsive.css') }}">
	
	<header class="header" style="margin-top: 55px">
  		<div class="logo" style="text-align: center;"><a href="{{ url('/') }}"><img height="70px" src="{{ asset('images/5842a4f5a6515b1e0ad75af6.png') }}"></a></div>
  	</header>  	

	<!-- Contact Form -->
	<div class="contact_form">
		<div class="container">
			<div class="row">				
				<div class="col-lg-5 offset-lg-2" style=" margin: auto; padding: 10px;">

					<div class="contact_form_container" style="margin : 10px; border: 1px solid #e0e0e0; border-radius: 3px!important; box-shadow: 0 0 10px 0 rgba(0,0,0,.1)!important;">
						
						<div class="contact_form_title" style="text-align: center; margin-top: 10px">						
							<span>{{ trans('messages.register_by_email') }}  </span>
						</div>
						
						<div style="text-align: center; margin-top: 0px">
							{{ $email }} ? <a href='{{ url('register') }}'> {{ trans('messages.change') }}</a>
						</div>
						
						@if(isset($error_message))
							<div id="error_message" class="error_message" style="">
								<ul style="margin-left: 30px; color: red; text-align: left">
									@foreach($error_message as $key => $value)
										<li>{{ $value }}</li>
									@endForeach									
								</ul>	
							</div>
						@endIf

						@if(isset($succes_message))
							<div id="succes_message" class="succes_message" style="">
								<ul style="margin-left: 30px; color: green; text-align: left">
										<li>{{ $succes_message }}</li>
								</ul>	
							</div>
						@endIf
						
						<form action="{{ url('register/by_email') }}" method="POST" id="register_form_by_email" style="margin: 20px;">
							@csrf
							<div class="contact_form_inputs">
								<input name="email" type="hidden" id="email" class="input_field" value="{{$email}}" required="required">
							</div>

							<div class="contact_form_inputs">
								<input name="name" type="text" id="name" class="input_field" placeholder="Nama Lengkap" required="required">
							</div>

							<div class="contact_form_inputs">
								<input name="phone" type="text" id="phone" class="input_field" placeholder="Nomor Ponsel" required="required">
							</div>

							<div class="contact_form_inputs">
								<input name="password" type="password" id="password" class="input_field" placeholder="Kata Sandi" required="required">
							</div>

							<div class="contact_form_button" >
								<button type="submit" id="submit" class="button contact_submit_button">{{ trans('other.register') }}</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
		<div class="panel"></div>
	</div>

@endsection

@section('footer-script')
	<script type="text/javascript">
		
		$(function() {
		    var fade_out = function() {
			  $("#error_message").fadeOut().empty();
			  $("#succes_message").fadeOut().empty();
			}

				setTimeout(fade_out, 3000);
			
			$("#register_form_by_email").validate({				
				messages: {
					name : "{{ trans('messages.must_fill') }}",
					phone : "{{ trans('messages.must_fill') }}",
					password: {
						required: "{{ trans('messages.must_fill') }}",
						minlength: "Minimal 6 karakter"
					}
				}
			});			
			
		});
	</script>
@endsection