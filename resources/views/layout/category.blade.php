@foreach($category as $value)			
		@if(count($value->child) > 0)
			<li class="hassubs"><a href="{{ url('category/'.$value->alias) }}">{{ $value->name }} <i class="fas fa-chevron-right ml-auto"></i></a><ul>
			@foreach($value->child as $child)
				<li><a href="{{ url('category/'.$child->alias) }}">Menu Item<i class="fas fa-chevron-right"></i></a></li>				
			@endForeach
			</ul>
		@else
			<li><a href="{{ url('category/'.$value->alias) }}">{{ $value->name }} <i class="fas fa-chevron-right ml-auto"></i></a>
		@endIf
	</li>
@endForeach