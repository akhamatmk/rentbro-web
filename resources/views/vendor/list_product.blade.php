<style type="text/css">
	
/* remember to define visible focus styles! 
:focus{
    outline:?????;
} */

/* remember to highlight inserts somehow! */
ins{
    text-decoration:none;
}
del{
    text-decoration:line-through;
}

table{
    border-collapse:collapse;
    border-spacing:0;
}

/* Typography */

h1 {
	font-size: 28px;
	font-weight: 300;
	flex: 1;
}

h5 {
	font-weight: 500;
	line-height: 1.7em;
}

h6 {
	color: #666;
	font-size: 14px;
}

/* Product Layout */

.product-filter {
	display: flex;
	padding: 30px 0;
}

.sort {
	display: flex;
	align-self: flex-end;
}

.collection-sort {
 display: flex;
	flex-direction: column;
}

.collection-sort:first-child {
	padding-right: 20px;
}


.products {
	display: flex;
	flex-wrap: wrap;
}

.product-card {
	display: flex;
	flex-direction: column;
	
	padding: 2%;
	flex: 1 16%;
	
	background-color: #FFF;
	box-shadow: 0px 0px 1px 0px rgba(0,0,0,0.25);
}

.product-image img {
	width: 100%;
}

.product-info {
	margin-top: auto;
	padding-top: 20px;
	text-align: center;
}

@media ( max-width: 920px ) {
	
	.product-card {
		flex: 1 21%;
	}
	
	.products .product-card:first-child, 
	.products .product-card:nth-child(2) {
		flex: 2 46%;
	}
	
}

@media ( max-width: 600px ) {
	
	.product-card {
		flex: 1 46%;
	}
	
}

@media ( max-width: 480px ) {
	
	h1 {
		margin-bottom: 20px;
	}
	
	.product-filter {
		flex-direction: column;
	}
	
	.sort {
		align-self: flex-start;
	}
	
}
	</style>
	<h1>List Produt</h1>
	<div class="products">
		@foreach($product as $value)
			<div class="product-card">
				<div class="product-image">
					<img src="{{ $value->image->real }}">
				</div>
				<div class="product-info">
					<h5>{{ $value->name }}</h5>
					<h6>Rp. {{ number_format($value->price[0]->price) }}</h6>
				</div>
			</div>
		@endForeach		
		<div class="product-card">
		
		</div>

		<div class="product-card">
		
		</div>

		<div class="product-card">
		
		</div>

		<div class="product-card">
		
		</div>
		
	</div>