@extends('layout.app')

@section('title', 'Profile')

@section('content')

<style type="text/css">			
	select:invalid { color: gray; }
	.col-form-label{
		text-align: right;
	}

	.modal-prive{
  display:none;
  position: fixed;
  z-index:1;
  left: 0;
  top:0;
  height: 100%;
  width:100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.5);
}

.modal-prive-content{
  background-color:#f4f4f4;
  margin: 20% auto;
  width:50%;
  box-shadow: 0 5px 8px 0 rgba(0,0,0,0.2),0 7px 20px 0 rgba(0,0,0,0.17);
  animation-name:modalopen;
  animation-duration:1s;
}

.modal-prive-header h2, .modal-prive-footer h3{
  margin:0;
}

.modal-prive-header{
  background:#ffae2e;
  padding:15px;
  color:#fff;
}

.modal-prive-body{
  padding:10px 20px;
}

.modal-prive-footer{
  background:#ffae2e;
  padding:10px;
  color:#fff;
  text-align: right;
}

.closeBtn{
  color:#ccc;
  float: right;
  font-size:30px;
  color:#fff;
}

.closeBtn:hover,.closeBtn:focus{
  color:#000;
  text-decoration: none;
  cursor:pointer;
}

@keyframes modalopen{
  from{ opacity: 0}
  to {opacity: 1}
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
	        <input type="hidden" name="address_id_form" id="address_id_form" value="0">
	        <button type="button" id="save" class="btn btn-primary">Simpan</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<div id="simpleModalDelete" class="modal-prive">
	<form action="{{ url('delete/address')}}" action="post" id="delete-address-form">
		@csrf
	    <div class="modal-prive-content">
	      <div class="modal-prive-header">
	         <span class="closeBtn">&times;</span>
	         <h2>Hapus data</h2>
	      </div>
	      <div class="modal-prive-body">
				<p>Apakah Anda Yakin Menhapus Alamat Ini ? </p>        
	      </div>
	      
	      <div class="modal-prive-footer">
	        	<button type="button" style="cursor: pointer;" id="send_delete_data" class="btn btn-danger">Hapus</button>
	        	<input type="hidden" name="address_id" id="address_id" value="0">
	        	<button type="button" id="close_modal" style="cursor: pointer;" class="btn btn-primary">Keluar</button>
	      </div>
	   </div>
	</form>    
</div>

@include('layout.copyright')

@endsection
@section('footer-script')
	<script type="text/javascript">
		
		// Get modal element
		var modal = document.getElementById('simpleModalDelete');		
		// Get close button
		var closeBtn = document.getElementsByClassName('closeBtn')[0];
		
		// Listen for close click
		closeBtn.addEventListener('click', closeModal);
		// Listen for outside click
		window.addEventListener('click', outsideClick);

		// Function to open modal
		function openModal(){
		  modal.style.display = 'block';
		}

		// Function to close modal
		function closeModal(){
		  modal.style.display = 'none';
		}

		// Function to close modal if outside click
		function outsideClick(e){
		  if(e.target == modal){
		    modal.style.display = 'none';
		  }
		}

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

			$(".delete_address").click(function(){
				$('#address_id').val($(this).data("id"));
				$("#simpleModalDelete").show();
			});

			$("#close_modal").click(function(){
				$("#simpleModalDelete").hide();
			});

			$("#save").click(function(){
				const id =  $("#address_id_form").val();
				let url = "";
				let method = "";
				if(id == 0){
					url = "{{ url('profile/address/add') }}";
					method = "POST";
				}
				else{
					url = "{{ url('account/address/') }}/"+id;
					method = "PUT";
				}

				$.ajax({
					url: url,
					type: method,
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

			$(".change_address").click(function(){
				var id = $(this).data("id");
				$.ajax({
					url: "{{ url('account/address/') }}/"+id,
					type: "GET",
					dataType: "json",
					success: function(data){
						$.each( data.data.district, function( key, value ) {
							$("#district").append("<option value='"+value.id+"'>"+value.name+"</option>");
						});

						$.each( data.data.regency, function( key, value ) {
							if(value.type == 1)
								var kind = "Kabupaten";
							else
								var kind = "Kota";

							$("#regency").append("<option value='"+value.id+"'> "+kind+" "+value.name+"</option>");
						});

						$("#address_id_form").val(data.data.address.id);
						$("#name").val(data.data.address.name);
						$("#phone").val(data.data.address.phone);
						$("#postal_code").val(data.data.address.postal_code);
						$("#province").val(data.data.address.province_id);
						$("#regency").val(data.data.address.regency_id);
						$("#district").val(data.data.address.district_id);
						$("#full_address").val(data.data.address.full_address);
						$("#exampleModal").modal("show");
					}
			   })
				
			});

			$("#send_delete_data").click(function(){
				$.ajax({
					url: "{{ url('account/address/') }}/"+$("#address_id").val(),
					type: "DELETE",
					data: {
						"_token" : "{{ csrf_token() }}",
					},
					dataType: "json",
					success: function(data){
						if(data == true)
						{
							$("#simpleModalDelete").hide();
							swal({title: "Good job", text: "Data Berhasil Dihapus", type:"success"}).then(function(){ 
							   	location.reload();
							   }
							);
						}
					}
			    })
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

			$("#add").click(function(){
				$("#regency").html("");
				$("#district").html("");

				$("#address_id_form").val(0);
				$("#name").val("");
				$("#phone").val("");
				$("#postal_code").val("");
				$("#province").val("");
				$("#full_address").val("");
				$("#exampleModal").modal("show");
			});
		});
	</script>
@endsection