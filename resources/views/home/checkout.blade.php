@extends('layouts.app')

@section('title' , '- Checkout')

@section('head')

    <script src="https://js.braintreegateway.com/web/3.56.0/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.56.0/js/hosted-fields.min.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js" data-version-4 log-level="warn"></script>

    <script src="https://khalti.com/static/khalti-checkout.js"></script>
    <!-- Load the PayPal Checkout component. -->
    <script src="https://js.braintreegateway.com/web/3.56.0/js/paypal-checkout.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <style type="text/css">
            /**
             * The CSS shown here will not be introduced in the Quickstart guide, but shows
             * how you can use CSS to style your Element's container.
             */
            .StripeElement {
              box-sizing: border-box;

              height: 40px;

              padding: 10px 12px;

              border: 1px solid transparent;
              border-radius: 4px;
              background-color: white;

              box-shadow: 0 1px 3px 0 #e6ebf1;
              -webkit-transition: box-shadow 150ms ease;
              transition: box-shadow 150ms ease;
            }

            .StripeElement--focus {
              box-shadow: 0 1px 3px 0 #cfd7df;
            }

            .StripeElement--invalid {
              border-color: #fa755a;
            }

            .StripeElement--webkit-autofill {
              background-color: #fefde5 !important;
            }
    </style>

@endsection

@section('content')
    <div class="">

    	@if(Auth::guard('customer')->user())
        	<cart-checkout  :auth="{{ Auth::guard('customer')->user()  }}" :products="{{ $products->toJson() }}" :cart="{{ $totalQuantity }}" sub="{{ $subTotal }}" dis="{{ $discount }}" afterdis="{{ $subAfterDis }}" tax="{{ $tax }}" grand="{{ $grandTotal }}" token="{{ $token }}"></cart-checkout>
      @else
			<cart-checkout :products="{{ $products->toJson() }}" :cart="{{ $totalQuantity }}" sub="{{ $subTotal }}" dis="{{ $discount }}" afterdis="{{ $subAfterDis }}" tax="{{ $tax }}" grand="{{ $grandTotal }}" token="{{ $token }}"></cart-checkout>
        @endif
            
    </div>


@endsection
@push('scripts')
	
@endpush
