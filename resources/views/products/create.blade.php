@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-row justify-start">
        	<div class="w-40">
            
	            @component('_partials.nav')
					
	            @endcomponent

	        </div>

	        	
			<add-product :categories="{{ $categories->toJson() }}" />
				
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(()=>{

        $('#searchForm').submit(function(e){
            e.preventDefault();
            console.log(this.children[0].value);
            // var param = this.
            $.ajax({
                type: 'POST',
                url : '/category/store',
                data : JSON.stringify(this.children[0].value, this.children[1].value)
            }).done((data)=>{

                console.log(data);
                // (data.products.data).forEach(function(s){
                //     $('#searchResults').html(`

                //        <a href="http://localhost:8000/products/${s.id}-${s.name}">${s.name}</a>
                //     `);
                // });
                
            });

        });

        $.ajax({
            type: 'GET',
            url : '/categories'
        }).done((data)=>{

            // console.log(data.products.data);
            (data.categories).forEach(function(s){
                $('#searchResults').append(`

                   <a href="http://localhost:8000/categories/${s.id}-${s.name}">${s.name}</a>
                `);
            });
            
        });
    });
</script>
@endsection