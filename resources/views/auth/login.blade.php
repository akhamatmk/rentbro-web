@extends('layout.app')

@section('title', 'Register User Rental bro')

@section('content')
<script src="{{ asset('js/jquery.js') }}"></script>

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
				<div class="col-md-6 col-xs-6"  style=" margin: auto; padding: 10px;">
					

					<div class="contact_form_container" style="margin : 10px; border: 1px solid #e0e0e0; border-radius: 3px!important; box-shadow: 0 0 10px 0 rgba(0,0,0,.1)!important;">
						<div class="contact_form_title" style="text-align: center; margin-top: 10px">Login </div>
						
						@if(isset($error_message))
							<div id="error_message" class="error_message" style="">
								<ul style="margin-left: 30px; color: red; text-align: left">
									@foreach($error_message as $key => $value)
										<li>{{ $value }}</li>
									@endForeach									
								</ul>	
							</div>
						@endIf
						

						<div class="clearfix"></div>

						<form action="{{ url('login') }}" method="post" id="contact_form" style="margin: 20px;">
							@csrf							
							<div class="contact_form_inputs">
								<input name="email" type="email" id="contact_form_email" class="contact_form_email input_field" placeholder="Your email" required="required" data-error="Email is required.">
							</div>

							<div class="contact_form_inputs">
								<input name="password" type="password" id="contact_form_password" class="contact_form_email input_field" placeholder="Enter Your Password" required="required" data-error="Email is required.">
							</div>
					
							<div class="contact_form_button" style="text-align: center;">
								<div style="float: left; margin-top: -20px"><input checked="checked" style="margin-left: 18px" type="checkbox" name="">Ingat Saya</div>
								<button style="margin-top: 10px" type="submit" class="button contact_submit_button">Login</button>
							</div>

							<div class="user-accounts-alt">
		                       <div class="user-accounts-alt__separator">
		                           <span class="user-accounts-hline"></span>
		                           <span class="user-accounts-alt__separator-text">Atau Login Dengan</span>
		                           <span class="user-accounts-hline"></span>
		                       </div>
		                       <ul class="user-accounts-alt__list">
		                           <li class="user-accounts-alt__list-item">
		                               <a href="{{ url('auth/google?authFor=login') }}" id="" class="btn user-accounts-alt__button user-accounts-alt__button--fluid">
		                                   <i class="user-accounts-alt__icon user-icon-google"></i>
		                                   <span class="user-accounts-alt__button-text">Google</span>
		                               </a>
		                           </li>
		                       </ul>
		                  </div>
						</form>

						<script src="{{ asset('js/jquery.js') }}"></script>
						<script src="{{ asset('js/jquery.validate.js') }}"></script>

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
			}

			$("#contact_form").validate();

			setTimeout(fade_out, 3000);
		});
	</script>
@endsection