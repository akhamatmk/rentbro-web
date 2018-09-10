@extends('layout.app')

@section('title', 'Koperasi Dana Masyarakat Indonesia')

@section('content')

<style type="text/css">
	
	.select2-selection{
		margin-left: 10px;
	}
	
	
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

	@media only screen and (max-width: 768px) {
	    .child_category {
	    	margin-top: 10px;
	    }
	}
</style>

<div class="super_container">	
  	<header class="header">
    	@include('layout.top_header')
    	@include('layout.header', ['noCategory' => "yes"])
  	</header>

  	<div class="container-content-add">
  		<div class="container" class="mt-20">
	  		<div class="row" style="min-height: 400px;" >
		  		<div class="col-lg-10 body-add-product">

		  			@if(Session::has('message-success'))
			  			<div class="alert alert-success alert_box" role="alert" style="margin-top: 10px">
							Product Berhasil Ditambahkan
						</div>
					@endIf

		  			<h3 class="header-container-add-product">Tambah Barang</h3>

		  			<form class="mt-10" method="post" action="{{ url($vendor->id.'/product-add') }}">

			  			@csrf
			  			<input type="hidden" name="nickname" value="{{ $vendor->nickname }}">
	  					<div class="form-group row">
						    <label class="control-label col-sm-2" for="min_order">Nama Barang</label>
						    <div class="col-sm-6">
						    	<input type="text" name="name" class="form-control ml-10">
						    </div>
						</div>

						<div class="form-group row">
						    <label for="catalogue" class="col-sm-2 col-form-label">Cataloge</label>
						    <div class="col-sm-3">					      
						      	<select class="form-control" id="catalogue" name="catalogue">
						      		<option data-weight="0" value="0">-- Silahkan Pilih --</option>
						      		@foreach($catalogue as $key => $value)
						      			<option data-weight="{{ $value->weight }}" value="{{ $value->id }}">{{ $value->name }}</option>
						      		@endForeach
						      	</select>						      	
						    </div>

						    <div class="col-sm-9 offset-sm-2">					      
								<small class="ml-20">
									Catalog anda tidak ada coba <a href="{{ url('recomendation/catalog/add') }}">klik</a> disini untuk membantu kami membuat catalog semakin bevariasi dan dan dapatkan point
								</small>
						    </div>						    
						</div>

					  	<div class="form-group row" id="self_category">
						    <label for="colFormLabel" class="col-sm-2 col-form-label">Category</label>
						    <div class="col-sm-3">
						      <select class="form-control" id="category" name="category"></select>
						    </div>

						    <div class="col-sm-3 child_category">					      
						      <select class="form-control" id="category2" name="category2"></select>
						    </div>						    
						</div>

						<div class="form-group row" id="catalog_category">
														
						</div>
						
						<div class="form-group row">
						    <label class="control-label col-sm-2" for="min_order">Gambar Lainya :</label>
						    <div class="col-sm-9">
						    	<div id="dropzone" class="dropzone ml-10"></div>
						    </div>
						</div>

						<div class="form-group row">
						   <label class="control-label col-sm-2" for="quantity">Jumlah Barang</label>
						   <div class="col-sm-6">
								<input type="text" name="quantity" id="quantity" class="form-control ml-10">
						   </div>
						</div>

						<div class="form-group row">
						   <label class="control-label col-sm-2" for="min_order">Berat Barang</label>
						   <div class="col-sm-6">
								<input type="number" min="0" name="weight" id="weight" class="form-control ml-10">
						   </div>
						</div>					

						<div class="form-group row">
						    <label class="control-label col-sm-2">Harga Barang</label>
						    <div class="col-sm-10">
						    	<table class="table">
						    		<thead>
						    			<tr>
						    				<th>Jenis Sewa</th>
						    				<th>Jumlah (Hari / Minggu / Bulan)</th>
						    				<th>Harga</th>
						    				<th>
						    					<img id="add_price" style="cursor: pointer;" width="20px" src="{{ asset('images/plus.png') }}">
						    				</th>
						    			</tr>
						    		</thead>
						    		<tbody id="body_price">
						    			<tr>
						    				<td>
						    					<select class="form-control" name="price_type[]">
						    						@foreach($price_type as $key => $value)
						    							<option value="{{ $key }}">{{ $value }}</option>
						    						@endForeach
										    	</select>
						    				</td>
						    				<td><input type="number" name="amount[]" class="form-control"></td>
						    				<td><input type="number" name="price[]" class="form-control"></td>
						    			</tr>
						    		</tbody>
						    	</table>
						    </div>
						</div>

						<div class="form-group row">
						    <label class="control-label col-sm-2" for="min_order">Deskripsi Barang</label>
						    <div class="col-sm-10">
						    	 <textarea class="form-control" name="description" id="description"></textarea>
						    </div>
						</div>

						<div class="form-group row">
						    <label class="control-label col-sm-2" for="min_order">Dokumen yang harus dilengkapi</label>
						    <div class="col-sm-10">
						    	<div class="checkbox">
								  <label><input type="checkbox" value="">KTP</label>
								</div>
								<div class="checkbox">
								  <label><input type="checkbox" value="">NPWP</label>
								</div>
								<div class="checkbox disabled">
								  <label><input type="checkbox" value="">Kartu Keluarga (KK)</label>
								</div>
						    </div>
						</div>

						<div id="product-image">
							
						</div>
						<div class="col-auto" style="float: right;">
					      <button type="submit" class="btn btn-primary mb-2">Add</button>
					    </div>
					</form>

		  		</div>
		  	</div>	
	  	</div>	
  	</div>
  	
  	@include('layout.copyright')

@endsection
@section('footer-script')
	<script type="text/javascript">
		let category ;
		let price_type_input = '@foreach($price_type as $key => $value) <option value="{{ $key }}">{{ $value }}</option> @endForeach';
		let count = 1;
		let attr;

		function delete_price (id) {		   		
			$("#body_price_"+id).remove();
	   	}

		$(function() {
			$("#category").select2();
			$("#category2").select2();
			$("#catalogue").select2();

			$("#catalogue").change(function(){
				const id = $(this).val();
				if (id != 0) {
					$("#self_category").hide();
					$.ajax({
						type: "POST",
						url: "{{ url('catalog') }}/"+$(this).val(),
						data : { "_token": "{{ csrf_token() }}" },
						dataType: 'json',
						success: function(data){
							let container_catalog_category = '<label for="catalogue" class="col-sm-2 col-form-label">Cataloge Category</label>';

							container_catalog_category+= '<div class="col-sm-8 mt-10 ml-10">';
							$.each( data.catalogueCategory, function( key, value ) {
								if(key != 0)
									attr = ", ";
								else
									attr = " ";

								container_catalog_category+= attr+' '+value.category;
							});

							container_catalog_category+= '</div>';

							$("#catalog_category").html(container_catalog_category);
						}
					});	
				}else{
					$("#self_category").show();
					$("#catalog_category").html("");
				}
				
			});
		   	
		   	$.ajax({
				type: "GET",
				url: "{{ url('category/ajax') }}",
				dataType: 'json',
				success: function(data){
					category = data;
					$("#category").html("<option value=''>-silahkan pilih-</option>");
					$.each( data.parent_0, function( key, value ) {
						var option = "<option value='"+value.id+"'>"+value.name+"</option>";
						$("#category").append(option);
					});

					$("#category3").hide();
				}
			});

			$("#category").change(function(){
				var id = $(this).val();
				$("#category3").hide();
				category.anObjectName = 'parent_'+id;
				if (category[category.anObjectName] !== undefined) {
					$("#category2").html("<option value=''>-silahkan pilih-</option>");					
					$.each( category[category.anObjectName], function( key, value ) {
						var option = "<option value='"+value.id+"'>"+value.name+"</option>";
						$("#category2").append(option);
					});

					$("#category2").show();
					$(".child_category").show();
				}else {
					$("#category2").hide();
					$(".child_category").hide();
				}
			});
			
		   $("#dropzone").dropzone({ 
	            url: "{{ URL('upload/image') }}",
	            init: function () {
					this.on('success', function (file) {				        		
							$(".dz-preview:last-child").attr('id', "document-" +file.upload.uuid);
							var value_image = $("#"+file.upload.uuid).val();
							$("#document-"+file.upload.uuid).append("<input type='radio' name='product_image_primary' value='"+value_image+"' checked> Set Default");
					})
				},
	            maxFiles: 5,
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
					$("#product-image").append($("<input id='"+file.upload.uuid+"' value='"+response+"' type='hidden' name='product_images[]' >"));
	            }
	        });

		   	$("#catalogue").change(function(){
		   		$("#weight").val($(this).find(':selected').data('weight'));
		   	});
		   	
		   	$("#add_price").click(function(){
		   		var new_tr = '<tr id="body_price_'+count+'"><td><select class="form-control" name="price_type['+count+']">'+price_type_input+'</select></td><td><input type="number" name="amount[]" class="form-control"></td><td><input type="number" name="price[]" class="form-control"></td><td><img onclick="delete_price('+count+')" class="delete_price" style="cursor : pointer" src="{{ asset('images/minus.png') }}" width= "40px" > </td></tr>';
		   		$("#body_price").append(new_tr);
		   		count++;

		   	});		  	        

	        $('#price').maskMoney({thousands:'.', decimal:',', allowZero: true, precision: 0});

	        CKEDITOR.replace( 'description' );

        	var fade_out = function() {
			  $(".alert_box").fadeOut().empty();
			}

			setTimeout(fade_out, 2000);
		});
	</script>
@endsection