@extends('layout.app')

@section('title', 'Profile')

@section('content')

<style type="text/css">
	.user-content{
		background: #F8F8F8; min-height: 520px; margin-top: -10px
	}

	.user-page__content{
		min-height: 100px;  border: 1px solid #e0e0e0; background: white; 
	}

	.my-account-section__header {
		-webkit-box-align: center;
		-webkit-align-items: center;
		-moz-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		border-bottom: 1px solid #efefef;
		padding: 10px 0;
		height: 80px;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}

	.my-account-section__header-title {
		font-size: 1.8rem;
		font-weight: 500;
		line-height: 2.4rem;
		color: #333;
		text-transform: capitalize;
	}

	.my-account-section__header-subtitle {
		color: #555;
		margin-top: 3px;
	}

	.form-radio
	{
	     -webkit-appearance: none;
	     -moz-appearance: none;
	     appearance: none;
	     display: inline-block;
	     position: relative;
	     background-color: #f1f1f1;
	     color: #666;
	     top: 10px;
	     height: 30px;
	     width: 30px;
	     border: 0;
	     border-radius: 50px;
	     cursor: pointer;     
	     margin-right: 7px;
	     outline: none;
	}
	.form-radio:checked::before
	{
	     position: absolute;
	     font: 13px/1 'Open Sans', sans-serif;
	     left: 11px;
	     top: 7px;
	     content: '\02143';
	     transform: rotate(40deg);
	}
	.form-radio:hover
	{
	     background-color: #f7f7f7;
	}
	.form-radio:checked
	{
	     background-color: #f1f1f1;
	}

	label
	{
	     font: 300 16px/1.7 'Open Sans', sans-serif;
	     color: #666;
	     cursor: pointer;
	}

	.ml-10{
		margin-left: 10px;
	}

	.btn-light:active, .btn-light:hover {
	    background: rgba(0,0,0,.02);
	}
	.btn-light {
	    background: #fff;
	    color: #555;
	    border: 1px solid rgba(0,0,0,.09);
	    box-shadow: 0 1px 1px 0 rgba(0,0,0,.03);
	}

	.avatar-uploader__text-container {
		margin-top: 12px;
		display: block;
	}

	.avatar-uploader__text {
		color: #999;
	}

	select:invalid { color: gray; }

	.col-form-label{
		text-align: right;
	}

	.text_profile{
		font: 300 16px/1.7 'Open Sans', sans-serif; color: #666; margin-top: 5px;
	}

</style>

<div class="super_container">
	
  	<header class="header">
    	@include('layout.top_header')
    	@include('layout.header', ['noCategory' => "yes"])
  	</header>

  	<div class="user-content">
  		<div class="container">
	  		<div class="row" style="min-height: 200px;" >

		  		@include('user.menu_user')

		  		<div class="col-lg-10 mt-10 user-page__content">
					<div class="my-account-section" style="padding: 0 30px 20px;">
						
						<div class="my-account-section__header">
							<div class="my-account-section__header-left">
								<div class="my-account-section__header-title" style="float: left;">Ubah Password</div>
							</div>
						</div>
						
					</div>
		  		</div>
		  	</div>	
	  	</div>	
  	</div>
</div>

@include('layout.copyright')

@endsection
@section('footer-script')
	<script type="text/javascript">
		
	</script>
@endsection