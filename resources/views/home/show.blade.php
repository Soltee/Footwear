@extends('layouts.app')

@section('title')
	Shop - {{ $product->slug }}
@endsection

@section('head')
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
    	
    	.swiper-button-next, .swiper-button-prev {
    		color: gray;
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
					  class="lozad focus-img  cursor-move grabbable featured w-full h-64 object-cover object-center rounded" data-src="/{{ $product->imageUrl }}" onerror="this.src='/img/placeholder.png'">
					{{-- </figure> --}}
					
					
				</div>

				@if($images_count > 1)
					<div class="my-8 swiper-container w-full relative">
					    <div class="swiper-wrapper">
					    	@forelse($images as $image)

				      			<div class="swiper-slide swiper-zoom-container relative">
						            <div class="">
						              <img class="lozad thumbnail w-24 h-24 cm:h-24 cm:w-24 rounded object-cover swiper-lazy cursor-pointer" data-src="/{{ $image->imageUrl }}" onerror="this.src='/img/placeholder.png'" />
						            </div>
						            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
					          	</div>
					       

					        @empty
					        	<div class="">

					        	</div>
					        @endforelse
						      
					    </div>

					</div>
				@endif
				
			</div>

            <div class="w-full md:w-1/2 md:pl-6 flex flex-col py-6 ">
                <h3 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h3>
                 <div class="flex items-center mt-4">
                    @for ($i = 1; $i <= $product->average_rating; $i++)
                            <svg class=" h-6 w-6 text-yellow-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                    @endfor

                </div>
                <h5 class="my-4 cm:my-0 text-xl font-bold text-gray-800">$ {{ $product->price }}</h5>
                <div>
			        <add-cart :product="{{ $product }}" /> 
			        
                </div>
            </div>
        </div> 


        <div 
        	 class="my-6">
	        <div clas="mb-4">
	        	<h3 
	        		
	        		class="text-md cursor-pointer font-semibold text-custom-light-black pr-4 mb-4" 
	        		>Details</h3>
	        	@if($product->description)
	        	<div
	        		class="w-full leading-relaxed">
	    			{{ $product->description }}
	    		</div>
	        	@endif
	        </div>

	        <div class="my-4">

	        	<h3 
	        		class="text-md cursor-pointer font-semibold text-custom-light-black pr-4" 
	        		>Reviews
	        	</h3>

    		<div
        		class="w-full leading-relaxed">
    			<!-- View Rating --->
		        @if($auth)
		        	<review :product="{{ $product }}" :auth="{{ $auth }}" /> 
		        @else
		        	<review :product="{{ $product }}"/> 
		        @endif
    		</div>
        </div>

        

        <div class="my-8 {{ $similar_count ? 'swiper-container2 ' : ''  }} w-full relative overflow-hidden">
        	<h3 class="font-semibold text-lg mb-4 text-gray-800">Similar Products</h3>
		    <div class="swiper-wrapper ">
		    	@forelse($similar as $image)

	      			<div class="swiper-slide relative bg-gray-400 rounded-lg w-full md:w-64 md:h-64 flex flex-col items-center">
	      				<div class="cartBtnParent relative" >
                          
	                        <a href="{{ url('images', $image->id . '-' . $image->slug)}}">   

	                            <img loading=""
	                            class=" w-full h-64 rounded-t-lg object-cover object-center" src="/{{ $image->imageUrl }}"
	                            onerror="this.src='/img/placeholder.png'">
	                        </a>

	                    </div>
			            <div class="mt-2 flex flex-col">
					      	<span class="mb-2">{{ $image->name }}
					      	</span>
					    </div>
					    <div class="flex items-center">
	                        @for ($i = 1; $i <= $product->average_rating; $i++)
	                                <svg class=" h-6 w-6 text-yellow-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
	                        @endfor

	                    </div>
		          	</div>
		       

		        @empty
		        @endforelse
			      
		    </div>
			   <!-- Add Pagination -->
		      <!-- <div class="swiper-pagination"></div> -->
		    <div class="swiper-button-next"></div>
		    <div class="swiper-button-prev"></div>
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
			    // lazy: true,
	      		grabCursor: true,
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

			var swiper2 = new Swiper('.swiper-container2', {
			    slidesPerView: 1,
			    spaceBetween: 10,
			      // init: false,
			    lazy: true,
	      		grabCursor: true,
	      		pagination: {
			        el: '.swiper-pagination',
			        clickable: true,
			    },
			    navigation: {
			        nextEl: '.swiper-button-next',
			        prevEl: '.swiper-button-prev',
			    },
			    breakpoints: {
			        500: {
			          slidesPerView: 1,
			          spaceBetween: 10,
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
