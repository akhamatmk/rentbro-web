@extends('layout.app')
@section('title', 'Profile')
@section('content')
<style type="text/css">
   .user-sider li a {
   padding: 10px 0 15px 18px;
   display: block;
   font-weight: bold;
   color: #000;
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
</style>
<div class="super_container">
<header class="header">
   @include('layout.top_header')
   @include('layout.header', ['noCategory' => "yes"])
</header>
<div style="background: #F8F8F8; min-height: 520px; margin-top: -10px">
   <div class="container">
      <div class="row" style="min-height: 200px;" >
          <div class="col-lg-2" >
             
          </div>
         <div class="col-lg-9 offset-md-3" style="min-height: 100px;  border: 1px solid #e0e0e0; background: white; margin-left: 10px;margin-bottom: 10px; margin-top: 10px">
            <div class="row" style="background: white">
               <div class="col-md-12">
                  <h2 style="text-align: center; margin-top: 10px">Edit Profile</h2>
                  
                  <form action="{{ url('validation') }}" method="post" id="form">
                     @csrf
                     <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-6">
                           <input type="text" class="form-control" id="name" required="required" name="name" placeholder="Name" >
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="birth" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-6">
                           <input type="text" class="form-control" id="birth_day" required="required" name="birth" placeholder="Birth Day" >
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="birth" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-6">
                           <input type="password" class="form-control" id="password" required="required" name="password" placeholder="Enter Your Password" >
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">No Telpon</label>
                        <div class="col-sm-6">
                           <input type="text" class="form-control" id="phone" required="required" name="phone" placeholder="Phone" >
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Older Image</label>
                        <div class="col-sm-10">
                        	<img src="{{ $user->image }}" width="100px" height="100px">
                        	<input type="hidden" name="older_image" value="{{ $user->image }}">
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">New profile</label>
                        <div class="col-sm-4">
                        	<div style="margin-left: 10px" id="dropzone-primary" class="dropzone"></div>                        
                        </div>
                     </div>

                     <div class="form-group row">
                        <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-4">
                           <input value="1" type="radio" name="gender" id="gender" @if($user->gender == 1) checked="checked" @endIf >Laki - Laki
                           <input value="2" style="margin-left: 20px" type="radio" name="gender" @if($user->gender == 2) checked="checked" @endIf >Perempuan
                        </div>
                     </div>

                     <div id="image">
							
						   </div>

                     <div class="form-group row">
                        <div class="col-sm-10">
                           <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                     </div>

                  </form>
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
   $(function() {

      $("#dropzone-primary").dropzone({ 
           url: "{{ URL('upload/image') }}", 
           maxFiles: 1,
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
            $("#image").append($("<input id='"+file.upload.uuid+"' value='"+response+"' type='hidden' name='new_image' >"));
           }
      });

      $("#form").validate();

      var picker = new Pikaday({
            field: document.getElementById('birth_day'),
            toString(date, format) {
                 
                 var day = date.getDate();
                 var month = date.getMonth() + 1;
                 var year = date.getFullYear();

                 if(month < 10)
                    month = "0"+month;

                 if(day < 10)
                    day = "0"+day;

                 return year+"-"+month+"-"+day;
             },
       });

     });
   </script>
@endsection