@extends('layout.app')

@section('title', 'Koperasi Dana Masyarakat Indonesia')

@section('content')

<style type="text/css">
	.user-sider li a {
	    padding: 10px 0 15px 18px;
	    display: block;
	    font-weight: bold;
	    color: #000;
	}

	.select2-selection{
		margin-left: 10px;
	}

	.user-sider li {
	    border-top: 1px solid #f5f5f5;
	    border-bottom: 1px solid #f5f5f5;
	}

	._menu_list li a:hover {
		color: #a71616;
	    text-decoration: none;
	    outline: 0;
	}

	.active-sidebar{
		background: #ffae2e;
		color: #fff;
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

	.presentation{
	    margin-top: 10px !important;
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

  	<div style="background: #F8F8F8; margin-top: -10px">
  		<div class="container" style="margin-top: 20px">
	  		<div class="row" style="min-height: 400px;" >

		  		<div class="col-lg-10" style="min-height: 100px;  border: 1px solid #e0e0e0; background: white; margin-left: 10px;     margin-bottom: 10px;">

		  			@if(Session::has('message-success'))
			  			<div class="alert alert-success alert_box" role="alert" style="margin-top: 10px">
							Rekomendasi Katalog Berhasil Ditambahkan
						</div>
					@endIf

		  			<h3 style="text-align: center; margin-top: 10px">Tambah Catalog</h3>

		  			<form style="margin-top: 10px" method="post" action="{{ url('recomendation/catalog/add') }}">

			  			@csrf

	  					<div class="form-group row">
						    <label class="control-label col-sm-2" for="min_order">Nama Catalog</label>
						    <div class="col-sm-6">
						    	<input style="margin-left: 10px" type="text" name="name" class="form-control">
						    </div>
						</div>	
					  						
						<div class="form-group row">
						    <label class="control-label col-sm-2" for="min_order">Gambar:</label>
						    <div class="col-sm-9">
						    	<div style="margin-left: 10px" id="dropzone" class="dropzone"></div>
						    </div>
						</div>

						<div class="form-group row">
						   <label class="control-label col-sm-2" for="min_order">Berat Barang</label>
						   <div class="col-sm-6">
								<input style="margin-left: 10px" type="number" min="0" name="weight" class="form-control">
						   </div>
						</div>

						<div class="form-group row">
						   <label class="control-label col-sm-2" for="min_order">Url Video</label>
						   <div class="col-sm-6">
								<input style="margin-left: 10px" type="text" min="0" name="url_video" class="form-control">
						   </div>
						</div>

						<div class="form-group row">
						    <label class="control-label col-sm-2" for="min_order">Deskripsi Catalog</label>
						    <div class="col-sm-10">
						    	 <textarea class="form-control" name="description" id="description"></textarea>
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
		$(function() {

			$("#dropzone").dropzone({ 
	            url: "{{ URL('upload/image') }}",
	            init: function () {
				        this.on('success', function (file) {				        		
    							$(".dz-preview:last-child").attr('id', "document-" +file.upload.uuid);
    							var value_image = $("#"+file.upload.uuid).val();
    							$("#document-"+file.upload.uuid).append("<input type='radio' name='primary_image' value='"+value_image+"' checked> Set Default");
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

	        CKEDITOR.replace( 'description' );

			var fade_out = function() {
			  $(".alert_box").fadeOut().empty();
			}

			setTimeout(fade_out, 2000);
		});
	</script>
@endsection