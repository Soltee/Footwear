@extends('layouts.app')

@section('extra')
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<style>

      	.zoomy {
            width: 420px;
            overflow: hidden;
        }

        .zoomy img {
            width: 100%;
            height: auto;
            backface-visibility: hidden;
        }
    

      	.swiper-slide {
	      text-align: center;
	      font-size: 18px;
	      background: #fff;

	      /* Center slide text vertically */
	      display: -webkit-box;
	      display: -ms-flexbox;
	      display: -webkit-flex;
	      display: flex;
	      -webkit-box-pack: center;
	      -ms-flex-pack: center;
	      -webkit-justify-content: center;
	      justify-content: center;
	      -webkit-box-align: center;
	      -ms-flex-align: center;
	      -webkit-align-items: center;
	      align-items: center;
	    }
    	
	</style>
@endsection

@section('content')
    <div class=" ">

    	<div class="relative w-full   flex flex-col md:flex-row  ">
             
		    <div class="w-full md:w-1/2 
			 ">
	
				<div class="relative imageDiv
					 ">
					{{-- <figure class="zoomy"> --}}
					<img id="featured" 
					  class="focus-img  cursor-move grabbable featured w-full h-64 object-cover object-center rounded" src="/storage/{{ $product->imageUrl }}">
					{{-- </figure> --}}
					
					
				</div>

				@if($images_count > 1)
					<div class="my-8 swiper-container w-full relative">
					    <div class="swiper-wrapper">
					    	@forelse($images as $image)

				      			<div class="swiper-slide swiper-zoom-container relative">
						            <div class="">
						              <img class="thumbnail w-24 h-24 cm:h-24 cm:w-24 rounded object-cover swiper-lazy cursor-pointer" src="/storage/{{ $image->imageUrl }}" />
						            </div>
						            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
					          	</div>
					       

					        @empty
					        	<div class="">

					        	</div>
					        @endforelse
						      
					    </div>

					    <div class="swiper-pagination"></div>
					</div>
				@endif
				
			</div>

            <div class="w-full md:w-1/2 md:pl-6 flex flex-col py-6 ">
                <h3 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h3>
                <h5 class="my-4 cm:my-0 text-xl font-bold text-gray-800">$ {{ $product->price }}</h5>
                <div>
			        <add-cart :product="{{ $product }}" /> 
			        
                </div>
            </div>
        </div> 


        <div class="my-4">
        	@if($product->description)
	        	<div class="">
	        		<h3 class="text-lg text-custom-light-black mb-4">Details</h3>
	        		<p class="w-full leading-relaxed">
	        			{{ $product->description }}
	        		</p>
	        	</div>
        	@endif

        </div>
          {{-- @if($category)
          <add-cart :product="{{ $product }}" :images="{{$images}}"  :category="{{ $category }}" :recommended="{{ $recommended }}"/> 
          @else
          <add-cart :product="{{ $product }}" :images="{{$images}}"  :recommended="{{ $recommended }}"/> 
          @endif --}}


	    <div class="my-8 swiper-container2 w-full relative">
		    <div class="swiper-wrapper">
		    	@forelse($paginate as $image)

	      			<div class="swiper-slide relative">
			            <div class="">
			              <img class="w-full md:h-64 md:w-64 rounded object-cover swiper-lazy" src="/storage/{{ $image->imageUrl }}" />
			            </div>
			            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
		          	</div>
		       

		        @empty
		        	<div class="">

		        	</div>
		        @endforelse
			      
		    </div>
		    <!-- Add Pagination -->
		    <div class="swiper-pagination"></div>
		</div>

          
    </div>
@endsection


@push('scripts')
	<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<script src="{{ asset('js/zommy.min.js') }}"></script>
	<script>
        document.addEventListener('DOMContentLoaded', function () {

        	initZoomy({});

			let thumbnails = document.getElementsByClassName('thumbnail')

			let activeImages = document.getElementsByClassName('active')

			for (var i=0; i < thumbnails.length; i++){

				thumbnails[i].addEventListener('click', function(){
					// console.log(activeImages)
					
					if (activeImages.length > 0){
						activeImages[0].classList.remove('active')
					}

					this.classList.add('active')
					let img = document.getElementById('featured');
					img.src = this.src;
				})
			}
	      	
			var swiper = new Swiper('.swiper-container', {
			    slidesPerView: 1,
			    spaceBetween: 10,
			      // init: false,
			    lazy: true,
	      		grabCursor: true,
			    pagination: {
			        el: '.swiper-pagination',
			        clickable: true,
			    },
			    breakpoints: {
			        300: {
			          slidesPerView: 1,
			          spaceBetween: 20,
			        },
			        400: {
			          slidesPerView: 3,
			          spaceBetween: 20,
			        },
			        500: {
			          slidesPerView: 4,
			          spaceBetween: 20,
			        }
			   	}
			});

			var swiper = new Swiper('.swiper-container2', {
			    slidesPerView: 1,
			    spaceBetween: 10,
			      // init: false,
			    lazy: true,
	      		grabCursor: true,
	      		pagination: {
			        el: '.swiper-pagination',
			        clickable: true,
			    },
			    breakpoints: {
			        500: {
			          slidesPerView: 1,
			          spaceBetween: 20,
			        },
			        640: {
			          slidesPerView: 2,
			          spaceBetween: 20,
			        },
			        768: {
			          slidesPerView: 4,
			          spaceBetween: 20,
			        },
			        1024: {
			          slidesPerView: 4,
			          spaceBetween: 20,
			        },
			   	}
			});


		});
		

	</script>
@endpush
