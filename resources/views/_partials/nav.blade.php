<ul class="m-0 flex flex-col justify-start items-left">
	<li class="">
		<a href="{{ route('administrator-dashboard') }}" class="">
			Dashboard
		</a>
	</li>
	<li class="">
		<a href="{{ route('products') }}" class="">
			Products
		</a>
		<ul class="m-0 flex flex-col justify-start items-left">
			<a href="{{ route('products.create') }}" class="">
				Add Product
			</a>
		</ul>
	</li>
	<li class="">
		<a href="{{ route('customers') }}" class="">
			Customers
		</a>
	</li>
	<li class="">
		<a href="{{ route('administrator-profile') }}" class="">
			Profile
		</a>
	</li>
</ul>