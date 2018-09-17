@extends('layout.app')
@section('title', 'Koperasi Dana Masyarakat Indonesia')
@section('content')
<style type="text/css">
   .select2-selection{
   min-height: 50px;
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
<form class="mt-10" method="post" action="{{ url($vendor->nickname.'/product-add') }}">
   <div class="container-add-product">
      <div class="container mt-20">
         <div class="row" style="min-height: 400px;" >
            <div class="col-lg-12 container-body-add-proudct">
               @if(Session::has('message-success'))
               <div class="alert alert-success alert_box" role="alert" style="margin-top: 10px">
                  Product Berhasil Ditambahkan
               </div>
               @endIf
               <h3 class="header-container-add-product">Tambah Barang</h3>
               @csrf
               <input type="hidden" name="nickname" value="{{ $vendor->nickname }}">
               <div class="form-group row">
                  <label class="control-label col-sm-2" for="min_order">Nama Barang</label>
                  <div class="col-sm-6">
                     <input type="text" name="name" class="form-control">
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
                     <div id="dropzone" class="dropzone"></div>
                  </div>
               </div>
               <div id="product-image">
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container-add-product">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 container-body-add-proudct mb-30">
               <h3 class="header-container-add-product">Variant Product</h3>
               <div class="col-sm-6" style="margin-bottom: 15px;">
                  <div class="container-price">
                     <div class="body-price">
                        <select class="form-control mt-10 col-lg-8 mb-10" name="option[]" id="option" multiple="multiple">
                           @foreach($product_option as $key => $value)
                           <option value="{{ $value->id }}">{{ $value->name }}</option>
                           @endForeach
                        </select>
                        <div class="mt-10">
                        </div>
                        <select class="form-control mt-10 option-value-product col-lg-8 mt-20" data-id="0" name="value[]" id="option_value_0" multiple="multiple"></select>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container-add-product">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 container-body-add-proudct">
               <h3 class="header-container-add-product">Set Harga Barang <button type="button" style="cursor: pointer;" class="btn btn-primary" id="tambah-harga">Add price</button></h3>
               <div id="priceInputLoad" class="form-group row"  >
                  <div class="price-input col-sm-6" id="price-input-0">
                     <div class="container-price">
                        <div class="body-price">
                           <br/><br/>
                           <select class="form-control mt-10" name="price_type[]">
                              @foreach($price_type as $key => $value)
                              <option value="{{ $key }}">{{ $value }}</option>
                              @endForeach
                           </select>
                           <input type="number" placeholder="Lama Peminjaman" name="amount[]" class="form-control mt-10">
                           <input type="text" placeholder="Harga" name="price[]" class="form-control mt-10 format-nominal">
                        </div>
                     </div>
                  </div>
                  <div class="price-input col-sm-6" id="price-input-1">
                     <div class="container-price">
                        <div class="body-price">
                           <br/><br/>
                           <select class="form-control mt-10" name="price_type[]">
                              @foreach($price_type as $key => $value)
                              <option value="{{ $key }}">{{ $value }}</option>
                              @endForeach
                           </select>
                           <input type="number" placeholder="Lama Peminjaman" name="amount[]" class="form-control mt-10">
                           <input type="text" placeholder="Harga" name="price[]" class="form-control mt-10 format-nominal">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="control-label col-sm-2" for="min_order">Minimal Deposit</label>
                  <div class="col-sm-4">
                     <input type="text" class="form-control format-nominal" name="minimum_deposit" id="minimum_deposit" value="0">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container-add-product">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 container-body-add-proudct">
               <h3 class="header-container-add-product">Detail Produk Dan Term condition</h3>
               <div class="form-group row">
                  <label class="control-label col-sm-2" for="quantity">Jumlah Barang</label>
                  <div class="col-sm-6">
                     <input type="text" name="quantity" id="quantity" class="form-control">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="control-label col-sm-2" for="min_order">Berat Barang</label>
                  <div class="col-sm-6">
                     <input type="number" min="0" name="weight" id="weight" class="form-control">
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
               <div class="col-auto" style="float: right;">
                  <button type="submit" class="btn btn-primary mb-2">Simpan </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
@include('layout.copyright')
@endsection
@section('footer-script')
<script type="text/javascript">
   let category ;
   let price_type_input = '@foreach($price_type as $key => $value) <option value="{{ $key }}">{{ $value }}</option> @endForeach';
   let attr;
   let price_id = 2;
   let option_value_product;
   let parent_value, child_key,child_value;
   
   function addColor (opt) {
   	if (!opt.id) {
   		return opt.text;
   	}               
   	var color = $(opt.element).data('color');
   
   	if(!color){
   		return opt.text;
   	} else {
   		var $opt = $(
   		'<span class="userName" style="background : '+color+'; border : 1px solid">&nbsp&nbsp&nbsp&nbsp&nbsp</span>'
   		);
   		return $opt;
   	}
   };
   		
   $(function() {
   	$("#category").select2();
   	$("#category2").select2();
   	$("#catalogue").select2();
   	$("#option").select2();			
   	$(".option-value-product").select2({
            templateResult: addColor,
         			templateSelection: addColor
      });
   
      $('#option').on("change", function() {    		    			
     			var data = $(this).select2("val");
     			$(this).select2().val();
     			if(data.length > 0)
     			{
     				$.ajax({
   				type: "POST",
   				url: "{{ url('product/option/multiple') }}",
   				data : { "data": data, "_token": "{{ csrf_token() }}"},
   				dataType: 'json',
   				success: function(data){
   					$("#option_value_0").html("");
   					$.each( data, function( key, value ) {
   						if(value.product_option_id == 1)
   						{
   							var option = '<option data-color="'+value.value+'" value="'+value.product_option_id+'_'+value.id+'" style="background-color:'+value.value+'"><span style="background-color:'+value.value+'"></span></option>';
   						} else {
   							var option = '<option style="background-color: #ffffff" value="'+value.product_option_id+'_'+value.id+'">'+value.value+'</option>'
   						}
   
   						$("#option_value_0").append(option);
   					});
   				}
   			});	
     			}
   	}); 
   
   	$("#tambah-harga").click(function(){
   		let price_content = '<div class="price-input col-sm-6" id="price-input-'+price_id+'"> <div class="container-price"><div class="body-price"><a data-id="'+ price_id +'" class="btn btn-danger delete-price"> X </a><select class="form-control mt-10" name="price_type[]">'+ price_type_input +'</select><input type="number" name="amount[]" placeholder="Lama Peminjaman" class="form-control mt-10"><input type="text" placeholder="Harga" name="price[]" class="form-control mt-10 format-nominal"></div></div></div>';
   
   	  	$('#priceInputLoad').append(price_content);
   
   	  	$(".delete-price").click(function(){
   			var id = $(this).data('id');
   			$("#price-input-"+id).remove();
   		});
   
   		$(".format-nominal").maskMoney({thousands:'.', decimal:',', allowZero: true, precision: 0});
   		
      		price_id++;
   	});
   	
   	$(".delete-price").click(function(){
   		var id = $(this).data('id');
   		$("#price-input-"+id).remove();
   	});
   
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
   
   					container_catalog_category+= '<div class="col-sm-8 mt-10">';
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
      			   
          $('#price').maskMoney({thousands:'.', decimal:',', allowZero: true, precision: 0});
   
          $(".format-nominal").maskMoney({thousands:'.', decimal:',', allowZero: true, precision: 0});
   
          CKEDITOR.replace( 'description' );
   
         	var fade_out = function() {
   	  $(".alert_box").fadeOut().empty();
   	}
   
   	setTimeout(fade_out, 2000);
   });
</script>
@endsection