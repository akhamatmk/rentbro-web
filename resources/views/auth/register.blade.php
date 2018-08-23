@extends('layout.app')

@section('title', 'Register User Rental bro')

@section('content')

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
						<div class="contact_form_title" style="text-align: center; margin-top: 10px">{{ trans('header.form_register') }} </div>
						<div style="text-align: center; margin-top: 0px">{{ trans('messages.have_account') }} ? <a href='{{ url('login') }}'> {{ trans('messages.sigh_in') }}</a></div>
						
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
						
						<form action="{{ url('register') }}" method="POST" id="register_form" style="margin: 20px;">
							@csrf
							<div class="contact_form_inputs">
								<input name="email" type="email" id="email" class="input_field" placeholder="{{ trans('messages.fill_your_email') }}" required="required" data-error="Email is required.">
								<div id="other_error" style="display: none;"><small style="color: red;font-size: 15px;" id="error_message_other">email already exist</small></div>
							</div>

							<div class="contact_form_button" >
								<button type="submit" id="submit" class="button contact_submit_button">{{ trans('other.register') }}</button>
							</div>

							<div class="user-accounts-alt">
	                       <div class="user-accounts-alt__separator">
	                           <span class="user-accounts-hline"></span>
	                           <span class="user-accounts-alt__separator-text">atau daftar dengan</span>
	                           <span class="user-accounts-hline"></span>
	                       </div>
	                       <ul class="user-accounts-alt__list">
	                           <li class="user-accounts-alt__list-item">
	                               <a href="{{ url('auth/google') }}" id="" class="btn user-accounts-alt__button user-accounts-alt__button--fluid">
	                                   <i class="user-accounts-alt__icon user-icon-google"></i>
	                                   <span class="user-accounts-alt__button-text">Google</span>
	                               </a>
	                           </li>
	                       </ul>
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
		    $(function() {
			    var fade_out = function() {
				  $("#error_message").fadeOut().empty();
				  $("#succes_message").fadeOut().empty();
				}

				setTimeout(fade_out, 3000);

				$("#register_form").validate({
					messages: {
						email: {
							required: "{{trans('messages.must_fill')}}",
							email: "{{trans('messages.email_not_valid')}}"
						}
					}
				})
			});

		    $("#email").keyup(function(){
		    	var check_email = $("#register_form").validate().form();


		    	if(check_email)
		    	{
		    		$.ajax({
						url: "{{ url('check/email') }}",
						type: "POST",
						data: {email : $(this).val(), _token: "{{ csrf_token() }}"},
						dataType: "json",
						success: function(data){
							if(data)
							{
								$("#other_error").show();
								$("#error_message_other").html("{{ trans('messages.email_already_exist') }}");
								$("#submit").prop('disabled', true);
							} else{
								$("#submit").prop('disabled', false);
								$("#other_error").hide();
							}

						}
				    })
		    	}else{
		    		$("#other_error").hide();
		    	}
		    });
			
		});
	</script>
@endsection