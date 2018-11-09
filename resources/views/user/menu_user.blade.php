<style type="text/css">
   .navbar-nav li .active{
      color : #ffae2e;
      font-weight: 600;
   }
</style>

<div class="col-md-2 side-bar mt-20">
   <div class="row header-sidebar">
      <div class="image-container col-md-4">
         @if(isset($user->image) OR $user->image != null OR $user->image != "")
            <img src="{{ $user->image->thumbnail }}" class="img-responsive" >
         @endIf
      </div>
      <div class="image-container col-md-8">
         <p><strong>{{ $user->username }}</strong><br/>
            <a class="user-page-brief__edit" href="/account">
               <svg width="12" height="12" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" style="margin-right: 4px;"><path d="M8.54 0L6.987 1.56l3.46 3.48L12 3.48M0 8.52l.073 3.428L3.46 12l6.21-6.18-3.46-3.48" fill="#9B9B9B" fill-rule="evenodd"></path></svg>Ubah Profil</a>
         </p>
      </div>
   </div>
   <hr>
   <div class="row side-menu">
      <nav class="navbar navbar-default" role="navigation">        
         <div class="side-menu-container">
            <ul class="nav navbar-nav">
               <li>
                  <a href="{{ url('account')  }}"><span class="glyphicon glyphicon-send"></span> 
                     <img width="22px" height="22px" class="image_menu" src="{{ asset('images/profile_svg.png') }}">
                     Account
                  </a>
               </li>
               @if (isset($menu) AND $menu == 'account')
                  <li><a href="{{ url('account')  }}" class="child_nav @if(isset($active) AND $active == 'profile') active @endIf"><span class="glyphicon glyphicon-send"></span> Profile</a></li>
                  <li><a href="{{ url('account/address')  }}" class="child_nav @if(isset($active) AND $active == 'address') active @endIf"><span class="glyphicon glyphicon-send"></span> Alamat</a></li>
                  <li><a href="{{ url('account/change_password')  }}" class="child_nav @if(isset($active) AND $active == 'change_password') active @endIf"><span class="glyphicon glyphicon-send"></span> Ubah Password</a></li>
               @endIf
               
               @if (isset($menu) AND $menu == 'vendor')
                  @if(isset($user->vendor) and count($user->vendor) > 0)
                     <li>
                        <a href="{{ url('vendor')  }}"><img width="22px" height="22px" class="image_menu" src="{{ asset('images/vendor_menu.png') }}">
                        <a class="@if(isset($active) AND $active == 'vendor') active @endIf"><span class="glyphicon glyphicon-send"></span> Vendor</a>
                     </li>
                     @foreach($user->vendor as $key => $value)
                        <li>
                           <a class="child_nav @if(isset($active) AND $active == 'vendor_'.$value->nickname) active @endIf" href="{{ url('vendor/'.$value->nickname.'/profile')  }}">
                              {{ $value->full_name }}
                           </a>
                        </li>
                     @endForeach
                  @else
                     <li><a href="{{ url('vendor')  }}"><img width="22px" height="22px" class="image_menu" src="{{ asset('images/vendor_menu.png') }}">Vendor</a></li>
                  @endIf
               @else
                  <li><a href="{{ url('vendor')  }}"><img width="22px" height="22px" class="image_menu" src="{{ asset('images/vendor_menu.png') }}">Vendor</a></li>
               @endIf
            </ul>
         </div>
         <!-- /.navbar-collapse -->
      </nav>
   </div>
</div>