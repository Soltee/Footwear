@extends('layouts.admin')

@section('content')
    <div class="container mx-auto pb-6">
        <div class="flex flex-row justify-start">
            <div class="relative hidden md:block w-48 px-3">
                <div class="fixed">
                    @include('_partials.nav')                   
                </div>
            </div>
            <div class="w-full md:flex-1 md:ml-48 md:px-6">
                <create-product :categories="{{ $categories->toJson() }}" />                
            </div>
	        	
				
        </div>
    </div>
@endsection

{{-- @section('scripts')
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
@endsection --}}