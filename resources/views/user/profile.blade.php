@extends('layout.app')

@section('title', 'Profile')

@section('content')

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
								    	<div class="col-sm-2 error-input-label" id="label-username-error" style="display: none;">
								    		<span class="fnt-15 cr" title="Username Sudah Pernah dipakai">X</span>
								    	</div>

								    	<div class="col-sm-2" style="display: none" id="preload-username">
								    		<img src="{{ asset('images/gif/tenor.gif') }}" width="40px" height="40px">
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

			$("#username").change(function(){				
				$("#label-username-error").hide();
				$("#preload-username").show();
				$('#username').removeClass('warning-input');
				$.ajax({
					url: "{{ url('check/username') }}",
					type: "POST",
					data: {"username" : $(this).val(),
						'_token' : "{{ csrf_token() }}"
					},
					dataType: "json",
					success: function(data){
						$("#preload-username").hide();
						if(data == false)
						{
							$("#label-username-error").show();
							$('#username').addClass('warning-input');
						}

					}
				});
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
							swal({title: "Good job", text: "Data Berhasil Disimpan", type:"success"}).then(function(){ 
							   	location.reload();
							   }
							);
						}
					}
			   })
			});
  		} );
	</script>
@endsection