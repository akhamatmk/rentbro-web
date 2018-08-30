@extends('layout.app')

@section('title', 'Profile')

@section('content')

<style type="text/css">			
	select:invalid { color: gray; }
	.col-form-label{
		text-align: right;
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
								<div class="my-account-section__header-title" style="float: left;">Alamatku</div>
								<button class="btn btn-primary" id="add" style="float: right; cursor: pointer;">+ TAMBAH ALAMAT</button>
							</div>
						</div>
						
						<div class="row container_content mt-10">							
							@foreach($address as $key => $value)
								<div class="col-md-9">
									<div class="row">
								   	<label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
								    	<div class="col-sm-10 text_profile">
								      	<strong>{{ $value->name }}</strong>
								    	</div>
								  	</div>

								  	<div class="row">
								   	<label for="staticEmail" class="col-sm-2 col-form-label">Telepon</label>
								    	<div class="col-sm-10 text_profile">
								      	{{ $value->phone }}
								    	</div>
								  	</div>

								  	<div class="row">
								   	<label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
								    	<div class="col-sm-6 text_profile">
								      	{{ $value->full_address }}, {{ $value->district_name }} {{ $value->postal_code }} <br/>
											{{ $value->regency_name }} - {{ $value->district_name }} <br/>
											{{ $value->provincy_name }} <br/>
											ID {{ $value->postal_code }}
								    	</div>
								  	</div>								  	
								</div>
								<div class="col-md-3">
									<div class="row" style="float: right;">
										<button data-id="{{ $value->id }}" class="btn btn-primary change_address link">Ubah</button>
										<button data-id="{{ $value->id }}" class="btn btn-danger ml-15 delete_address link">Hapus</button>
									</div>

									<div class="row" style="float: right; margin-top: 10px">
										<button class="btn btn-light link" >Atur Sebagai Utama</button>
									</div>
								</div>
								<hr style="width: 100%">
							@endForeach
						</div>
					</div>
		  		</div>
		  	</div>	
	  	</div>	
  	</div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: none">
        <h3 class="modal-title" id="exampleModalLabel">Tambah Alamat Baru</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="add_address">
      	@csrf
      	<div class="modal-body">			
				<div class="form-group">
					<input type="text" class="form-control" id="name" name="name" placeholder="Nama">
				</div>
				
				<div class="form-group">
					<input type="text" class="form-control" id="phone" name="phone" placeholder="No Handphone" required="required">
				</div>

				<div class="form-group">
					<input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Kode Pos" required="required">
				</div>

				<div class="form-group">
					<select class="form-control" name="province" id="province" placeholder="Provinsi" style="margin-left: 0px;" required="required">
						<option value="" disabled selected>Province</option>
						@foreach($province as $key => $value)
							<option value="{{ $value->id }}">{{ $value->name }}</option>
						@endForeach
					</select>
				</div>

				<div class="form-group">
					<select class="form-control" id="regency" name="regency" placeholder="Provinsi" style="margin-left: 0px;" required="required">
						<option value="" disabled selected>Kota / Kabupaten</option>
					</select>
				</div>

				<div class="form-group">
					<select class="form-control" id="district" name="district" placeholder="Provinsi" style="margin-left: 0px;" required="required">
						<option value="" disabled selected>Kecamatan</option>
					</select>
				</div>

				<div class="form-group">
					<input type="full_address" class="form-control" id="full_address" name="full_address" required="required" placeholder="Nama Lengkap jalan , no rumah , no jalan" >
				</div>

				<div class="form-group">
					<label class="stardust-checkbox">
						<input class="stardust-checkbox__input" value="1" type="checkbox" name="primary">
						Jadikan sebagai alamat pribadi
					</label>
				</div>			
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" id="save" class="btn btn-primary">Simpan</button>
	      </div>
      </form>
    </div>
  </div>
</div>

@include('layout.copyright')

@endsection
@section('footer-script')
	<script type="text/javascript">
		$( function() {
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

			$("#save").click(function(){
				$.ajax({
					url: "{{ url('profile/address/add') }}",
					type: "POST",
					data: $('#add_address').serialize(),
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
			})

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

			$("#add").click(function(){
				$("#exampleModal").modal("show");
			});
		});
	</script>
@endsection