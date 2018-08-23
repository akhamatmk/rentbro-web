<!-- Top Bar -->
<div class="top_bar">
	<div class="container">
		<div class="row">
			<div class="col d-flex flex-row">
				<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('images/phone.png')}}" alt=""></div>+6282134916615</div>
				<div class="top_bar_contact_item">
					<div class="top_bar_icon">
						<img src="{{ asset('images/mail.png') }}" alt=""></div>
						<a href="#">admin@rentbro.com</a>
					</div>
				<div class="top_bar_content ml-auto">
					<div class="top_bar_user">
						<div class="top_bar_user">	
							<div><a href="{{ url('register') }}">Daftar</a></div>	
						</div>
						<div class="top_bar_user">	
							<div><a href="{{ url('login') }}">Masuk</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>

<script type="text/javascript">		
	ready(function(){
		$.ajax({
			type: "GET",
			url: "{{ url('user/menu') }}",
			dataType: 'json',
			success: function(data){
				if(data.html.length > 0)
					$(".top_bar_user").html(data.html);
			}
		});
	});		
</script>
