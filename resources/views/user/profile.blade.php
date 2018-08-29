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
								<div class="my-account-section__header-title">profilku</div>
								<div class="my-account-section__header-subtitle">
									Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun
								</div>
							</div>
						</div>
						
						<div class="row container_content mt-10">
							<div class="col-md-8" style="border-right: 1px solid #efefef">
								<form id="profile">
									@csrf
									<div class="form-group row">
								   		<label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
								    	<div class="col-sm-9">
								      	{{ $user->email }}
								    	</div>
								  	</div>

								  	<div class="form-group row">
								   	<label for="name" class="col-sm-3 col-form-label">Name</label>
								    	<div class="col-sm-6">
								    		<input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control">
								    	</div>								    	
								  	</div>
								  	
								  	<div class="form-group row">
								   	<label for="username" class="col-sm-3 col-form-label">Username</label>
								    	<div class="col-sm-6">
								    		<input type="text" id="username" name="username" value="{{ $user->username }}" class="form-control">
								    	</div>								    	
								  	</div>

								  	<div class="form-group row">
								   	<label for="birth_date" class="col-sm-3 col-form-label">Tanggal Lahir</label>
								    	<div class="col-sm-6">
								    		<input type="text" id="birth_date" name="birth_date" value="{{ date('d-m-Y', strtotime($user->birth_day)) }}" class="form-control">
								    	</div>								    	
								  	</div>

								  	<div class="form-group row">
								   	<label for="birth_date" class="col-sm-3 col-form-label">Jenis Kelamin</label>
								    	<div class="col-sm-6">
								    		<input type="radio" name="gender" value="1" id="radio-one" class="form-radio" @if($user->gender == 1) checked @endIf>
								    		<label for="radio-one">Laki - Laki</label>

								    		<input type="radio" name="gender" value="2" id="radio-one" class="form-radio ml-10" @if($user->gender == 2) checked @endIf>
								    		<label for="radio-one">Perempuan</label>
								    	</div>								    	
								  	</div>
								  	<div class="form-group row">
								  		<div class="col-sm-6 col-sm-offset-3">
								  			<button class="btn btn-primary" type="button" id="submit">Simpan</button>
								  		</div>
								  	</div>
								</form>
							</div>

							<div class="col-md-4">
								<div class="input-image" style="text-align: center;">
									<img src="{{ $user->image->real }}" style="border-radius: 50px;" width="120px" id="image_profile" >
									<br/>
									<img src="{{ asset('images/preload.gif') }}" id="preload" style="display: none;" width="120px" >
									<br/>
									<input class="avatar-uploader__file-input" type="file" id="file" accept=".jpg,.jpeg,.png" style="display: none">
									<button id="choice_picture" class="btn btn-light btn--m btn--inline" style="margin-top: 10px; cursor: pointer;">Pilih gambar</button>
									<div class="avatar-uploader__text-container">
										<div class="avatar-uploader__text">Ukuran gambar: maks. 1 MB</div>
										<div class="avatar-uploader__text">Format gambar: .JPEG, .PNG</div>
									</div>
								</div>
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
		$( function() {
    		$( "#birth_date" ).datepicker({ dateFormat: 'dd-mm-yy' });

    		$("#choice_picture").click(function(){
    			$("#file").trigger( "click" );
    		});

			$("#submit").click(function(){
				$.ajax({
					url: "{{ url('profile/edit') }}",
					type: "POST",
					data: $('#profile').serialize(),
					dataType: "json",
					success: function(data){
						if(data == 200)
						{
							swal({title: "Good job", text: "Data Berhasil Disimpan", type:"success"}).then(function(){ 
							   	location.reload();
							   }
							);
						}
					}
			    })
			});

			$("#file").change(function(){
				$("#preload").show();
				$("#image_profile").hide();
				
				var data = new FormData();
    			data.append('file', $('#file')[0].files[0]);
    			data.append('_token', "{{ csrf_token() }}");
				$.ajax({
					url: "{{ url('profile/image/change') }}",
					type: "POST",
					data: data,
					dataType: "json",
					enctype: 'multipart/form-data',
	      			processData: false,
	      			contentType: false,
					success: function(data){
						$("#preload").hide();
						if(data == 200)
						{
							// swal({title: "Good job", text: "Data Berhasil Disimpan", type:"success"}).then(function(){ 
							//    	location.reload();
							//    }
							// );
						}
					}
			    })
			});
  		} );
	</script>
@endsection