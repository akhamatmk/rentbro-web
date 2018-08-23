<style type="text/css">
	.top_menu_left{
		margin-left: 10px;
	}
</style>

@if(! isset($data->id))

<div class="top_bar_user">	
	<div><a href="{{ url('register') }}">Daftar</a></div>	
</div>
<div class="top_bar_user">	
	<div><a href="{{ url('login') }}">Masuk</a></div>
</div>
@else
<div class="top_bar_user">	
	@if(! isset($data->vendor))
		<div><a href="{{ url('vendor/create') }}">Buka Toko</a></div>
	@else
	
	@endIf
</div>

<div class="top_bar_menu">
	<ul class="standard_dropdown top_bar_dropdown">
		<li>
			<a href="#"><img src="{{ $data->image }}" width="50px" height="50px"><i class="fas fa-chevron-down"></i></a>
			<ul>
				<li style="border-bottom: 1px solid #e0e0e0 !important"><a><b>Selamat Datang {{ $data->name }}</b></a></li>
				<li class="top_menu_left"><a href="{{ url('account') }}">Account</a></li>
				<li class="top_menu_left"><a href="{{ url('logout') }}">Logout</a></li>
			</ul>
		</li>
	</ul>
</div>
@endIf