<style type="text/css">
	.top_menu_left{
		margin-left: 10px;
	}

	.navbar-wrapper .navbar__link-icon, .navbar-wrapper .navbar__link-text {
    color: currentColor;
}


.icon-notification-2 {
    width: 1.4rem;
    height: 1.0rem;
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
			<a href="#">
			<svg class="icon-notification-2" viewBox="3 2.5 14 14" x="0" y="0"><path d="m17 15.6-.6-1.2-.6-1.2v-7.3c0-.2 0-.4-.1-.6-.3-1.2-1.4-2.2-2.7-2.2h-1c-.3-.7-1.1-1.2-2.1-1.2s-1.8.5-2.1 1.3h-.8c-1.5 0-2.8 1.2-2.8 2.7v7.2l-1.2 2.5-.2.4h14.4zm-12.2-.8.1-.2.5-1v-.1-7.6c0-.8.7-1.5 1.5-1.5h6.1c.8 0 1.5.7 1.5 1.5v7.5.1l.6 1.2h-10.3z"></path><path d="m10 18c1 0 1.9-.6 2.3-1.4h-4.6c.4.9 1.3 1.4 2.3 1.4z"></path></svg>
			Notifikasi</a>
		</li>
		<li>
			<a href="#">
				<svg class="shopee-svg-icon icon-help-center" height="16" viewBox="0 0 16 16" width="16"><g fill="none" fill-rule="evenodd" transform="translate(1)"><circle cx="7" cy="8" r="7" stroke="currentColor"></circle><path fill="currentColor" d="m6.871 3.992c-.814 0-1.452.231-1.914.704-.462.462-.693 1.089-.693 1.892h1.155c0-.484.099-.858.297-1.122.22-.319.583-.473 1.078-.473.396 0 .715.11.935.33.209.22.319.517.319.902 0 .286-.11.55-.308.803l-.187.209c-.682.605-1.1 1.056-1.243 1.364-.154.286-.22.638-.22 1.045v.187h1.177v-.187c0-.264.055-.506.176-.726.099-.198.253-.396.462-.572.517-.451.825-.737.924-.858.275-.352.418-.803.418-1.342 0-.66-.22-1.188-.66-1.573-.44-.396-1.012-.583-1.716-.583zm-.198 6.435c-.22 0-.418.066-.572.22-.154.143-.231.33-.231.561 0 .22.077.407.231.561s.352.231.572.231.418-.077.572-.22c.154-.154.242-.341.242-.572s-.077-.418-.231-.561c-.154-.154-.352-.22-.583-.22z"></path></g></svg>
				Bantuan
			</a>
		</li>
		<li>
			<a href="#"><img class="rentalbro-avatar__img" src="{{ $data->image->thumbnail }}">{{ $data->username }}</a>
			<ul>
				<li class="top_menu_left"><a href="{{ url('account') }}">Account</a></li>
				<li class="top_menu_left"><a href="{{ url('logout') }}">Logout</a></li>
			</ul>
		</li>
	</ul>
</div>
@endIf