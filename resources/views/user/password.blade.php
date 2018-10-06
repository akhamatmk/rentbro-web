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
                        <div class="my-account-section__header-title">Password</div>
                        <div class="my-account-section__header-subtitle">
                           Untuk keamanan akun Anda, mohon untuk tidak menyebarkan password Anda ke orang lain.
                        </div>
                     </div>
                  </div>
                  <div class="row container_content mt-10">

                     @if(Session::has('message-success'))
                        <div class="col-md-12">
                           <div class="alert alert-success">
                              <strong>Success!</strong> Password Berhasil Diganti
                           </div>
                        </div>
                     @endIf

                     @if(Session::has('message-fail'))
                        <div class="col-md-12">
                           <div class="alert alert-danger">
                              Password Lama salah
                           </div>
                        </div>
                     @endIf
                     
                     <div class="col-md-6">
                        <form data-toggle="validator" role="form" action="{{ url('account/change/password') }}" method="post">
                           @csrf
                           <div class="form-group">
                              <label for="inputPassword" class="control-label">Password Lama</label>
                              <div class="form-inline row">
                                 <div class="form-group col-sm-8">
                                    <input type="password" data-required-error="Harus diisi"  class="form-control" id="old_password" name="old_password" placeholder="Password" required>
                                    <div class="help-block with-errors"></div>
                                 </div>
                              </div>
                           </div>

                           <div class="form-group">
                              <label for="inputPassword" class="control-label">Password Baru</label>
                              <div class="form-inline row">
                                 <div class="form-group col-sm-8">
                                    <input type="password" data-minlength="6" data-minlength-error="Minimal 6 character"  data-required-error="Harus diisi" name="password"  class="form-control" id="inputPassword" placeholder="Password" required>
                                    <div class="help-block with-errors"></div>
                                 </div>
                              </div>
                           </div>

                           <div class="form-group">
                              <label for="inputPassword" class="control-label">Ulangi Password baru</label>
                              <div class="form-inline row">
                                 <div class="form-group col-sm-8">
                                    <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Password Tidak sama" data-required-error="Harus diisi" placeholder="Confirm" required><br/>
                                    <div class="help-block with-errors"></div>
                                 </div>
                              </div>
                           </div>
                           
                           <div class="form-group">
                              <button type="submit" class="btn btn-primary">Submit</button>
                           </div>
                        
                        </form>
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
   $( document ).ready(function() {
      $('#myForm').validator();
   });
</script>
@endsection